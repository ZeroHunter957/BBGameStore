<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BannedWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class WelcomeController extends Controller
{
    public function index()
    {
        $latestBlogs = Blog::orderBy('created_at', 'desc')->take(4)->get();
        return view('welcome', compact('latestBlogs'));
    }

    public function shop(Request $request)
    {
        $search = $request->input('search');

        $latestBlogs = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('shop', compact('latestBlogs', 'search'));
    }

    public function detail($id)
    {
        $blog = Blog::findOrFail($id);

        $bannedWords = BannedWord::pluck('word')->toArray();

        $comments = $blog->comments()->orderBy('created_at', 'desc')->get();

        foreach ($comments as $comment) {
            $comment->replies = $comment->replies()->orderBy('created_at', 'desc')->get();
        }

        return view('detail', compact('blog', 'comments', 'bannedWords'));
    }


    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in']);
        }
        return view('shop.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in']);
        }
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'nullable',
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

            return response()->json(['message' => 'Blog created successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the blog.'], 500);
        }
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in']);
        }
        $blog = Blog::findOrFail($id);
        return view('shop.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in']);
        }
        try {

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
            }

            $blog = Blog::findOrFail($id);

            $imagePath = $blog->image;

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }

                $imagePath = $request->file('image')->store('img', 'public');
            }

            $blog->update([
                'title_cache' => $request->title,
                'content_cache' => $request->content,
                'image_cache' => $imagePath,
                'status' => 2
            ]);

            return redirect()->route('shop.index')->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return response()->json(['error' => 'An error occurred while updating the blog.'], 500);
        }
    }

}
