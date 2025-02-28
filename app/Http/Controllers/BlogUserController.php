<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BannedWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'all');

        $latestBlogs = Blog::join('users as u', 'blogs.user_id', '=', 'u.id') // Perform INNER JOIN with users
            ->when($search, function ($query, $search) {
                return $query->where('blogs.title', 'like', "%{$search}%");
            })
            ->when($filter === 'my-blogs', function ($query) {
                return $query->where('blogs.user_id', Auth::id());
            })
            ->when(Auth::check(), function ($query) {
                return $query->where(function ($query) {
                    $query->where('blogs.status', 1)
                        ->orWhere('blogs.status', 2)
                        ->orWhere('blogs.user_id', Auth::id());  // Allow user to see their own blogs
                });
            }, function ($query) {
                return $query->where('blogs.status', 1)
                    ->orWhere('blogs.status', 2);  // If not authenticated, only show status 1
            })
            ->orderBy('blogs.created_at', 'desc')
            ->select('blogs.*', 'u.name as author_name')  // Optionally select additional fields from the user
            ->paginate(4);

        return view('menu.blogs', compact('latestBlogs', 'search', 'filter'));
    }



    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        $bannedWords = BannedWord::pluck('word')->toArray();

        $comments = $blog->comments()->orderBy('created_at', 'desc')->get();

        foreach ($comments as $comment) {
            $comment->replies = $comment->replies()->orderBy('created_at', 'desc')->get();
        }

        return view('menu.blogdetails', compact('blog', 'comments', 'bannedWords'));
    }


    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('account.login')->withErrors(['error' => 'You must be logged in']);
        }
        return view('blogusers.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in']);
        }
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('img', 'public');
            }

            Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath,
                'status' => 0,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->route('blogusers.index')->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the blog.'], 500);
        }
    }
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('account.login')->withErrors(['error' => 'You must be logged in']);
        }
        $blog = Blog::findOrFail($id);
        return view('blogusers.edit', compact('blog'));
    }

    public function update(Request $request, $id)
{
    if (!Auth::check()) {
        return redirect()->route('account.login')->withErrors(['error' => 'You must be logged in']);
    }
    try {
        // Log the entire request data (excluding file content for security)
        Log::info('Updating blog', [
            'request_data' => $request->except(['image']),  // Avoid logging the image file content itself
            'user_id' => Auth::id(),
            'blog_id' => $id,
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        $blog = Blog::findOrFail($id);

        $imagePath = $blog->image;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('img', 'public');
            // Log file upload information (excluding actual file data)
            Log::info('Uploaded new image', [
                'image_name' => $request->file('image')->getClientOriginalName(),
                'image_path' => $imagePath,
            ]);
        }

        // Log the update process
        Log::info('Updating blog record', [
            'blog_id' => $id,
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'status' => 2
        ]);

        // Update the blog record
        $blog->update([
            'title_cache' => $request->title,
            'content_cache' => $request->content,
            'image_cache' => $imagePath,
            'status' => 2
        ]);

        return redirect()->route('blogusers.index')->with('success', 'Blog updated successfully.');
    } catch (\Exception $e) {
        // Log the exception details
        Log::error('Error updating blog: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString(),
            'request_data' => $request->all(),  // Log full request data, excluding files
            'user_id' => Auth::id(),
            'blog_id' => $id,
        ]);

        return response()->json(['error' => 'An error occurred while updating the blog.'], 500);
    }
}

}
