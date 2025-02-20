<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->paginate(5);

        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('show', compact('blog'));
    }


    public function create()
    {
        return view('blogs.create');
    }

    public function updateStatus(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'status' => 'required|in:0,1,2',
        ]);

        if ($request->status == 2) {
            $blog->title = $blog->title_cache;
            $blog->content = $blog->content_cache;
            $blog->image = $blog->image_cache;

            $blog->title_cache = null;
            $blog->content_cache = null;
            $blog->image_cache = null;
        }

        $blog->status = $request->status;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog status updated successfully.');
    }



    public function store(Request $request)
    {
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
            ]);

            return response()->json(['message' => 'Blog created successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the blog.'], 500);
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
            ]);

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
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath,
            ]);

            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return response()->json(['error' => 'An error occurred while updating the blog.'], 500);
        }
    }




    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $blog->delete();

            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage());
            return redirect()->route('blogs.index')->with('error', 'An error occurred while deleting the blog.');
        }
    }
}
