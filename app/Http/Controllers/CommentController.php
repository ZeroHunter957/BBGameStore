<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\BannedWord;
use App\Models\Blog;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function store(Request $request, $blog_id)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to post a comment.']);
        }

        $bannedWords = BannedWord::pluck('word')->toArray();
        $containsBannedWord = false;
        $bannedWordFound = null;

        foreach ($bannedWords as $bannedWord) {
            if (stripos($request->content, $bannedWord) !== false) {
                $containsBannedWord = true;
                $bannedWordFound = $bannedWord;
                break;
            }
        }

        if ($containsBannedWord) {
            return redirect()->route('blogusers.show', $blog_id)
                ->withErrors(['comment' => 'Your comment contains a banned word: ' . $bannedWordFound]);
        }

        $now = now();

        $comment = Comment::create([
            'blog_id' => $blog_id,
            'content' => $request->content,
            'account_id' => session('accountLogin'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('blogusers.show', $blog_id)
            ->with('success', 'Your comment has been posted successfully!');
    }


    public function like($commentId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to like a comment.']);
        }

        $comment = Comment::findOrFail($commentId);

        $like = \App\Models\Like::where('account_id', session('accountLogin'))
            ->where('comment_id', $comment->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            \App\Models\Like::create([
                'account_id' => session('accountLogin'),
                'comment_id' => $comment->id,
            ]);
        }

        return back();
    }


    public function likeReply($replyId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to like a reply.']);
        }

        $reply = Reply::findOrFail($replyId);

        $like = \App\Models\Like::where('account_id', session('accountLogin'))
            ->where('reply_id', $reply->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            \App\Models\Like::create([
                'account_id' => session('accountLogin'),
                'reply_id' => $reply->id,
            ]);
        }

        return back();
    }


    public function reply(Request $request, $commentId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to reply.']);
        }

        $parentComment = Comment::findOrFail($commentId);

        $now = now();

        $reply = Reply::create([
            'content' => $request->content,
            'account_id' => session('accountLogin'),
            'comment_id' => $commentId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return back();
    }

    public function destroy($commentId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a comment.']);
        }

        $comment = Comment::findOrFail($commentId);

        if ($comment->account_id !== session('accountLogin') && session()->get('role') != 'ADMIN') {
            return redirect()->route('blogusers.show', $comment->blog_id)
                ->withErrors(['comment' => 'You are not authorized to delete this comment.']);
        }

        \App\Models\Like::where('comment_id', $commentId)->delete();

        $comment->replies()->delete();

        $comment->delete();

        return redirect()->route('blogusers.show', $comment->blog_id)
            ->with('success', 'Comment deleted successfully!');
    }


    public function deleteByAdmin($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        \App\Models\Like::where('comment_id', $commentId)->delete();

        $comment->replies()->delete();

        $comment->delete();

        return redirect()->route('comments.index', $comment->blog_id)
            ->with('success', 'Comment deleted successfully!');
    }





    public function delete($commentId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a comment.']);
        }

        $comment = Comment::findOrFail($commentId);

        if ($comment->account_id !== session('accountLogin')) {
            return redirect()->route('blogusers.show', $comment->blog_id)
                ->withErrors(['comment' => 'You are not authorized to delete this comment.']);
        }

        $comment->replies()->delete();
        $comment->delete();

        return redirect()->route('blogusers.show', $comment->blog_id)
            ->with('success', 'Comment deleted successfully!');
    }

    public function deleteReply($replyId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a reply.']);
        }

        $reply = Reply::findOrFail($replyId);

        if ($reply->account_id !== session('accountLogin')) {
            return redirect()->route('blogusers.show', $reply->comment->blog_id)
                ->withErrors(['comment' => 'You are not authorized to delete this reply.']);
        }

        $reply->delete();

        return redirect()->route('blogusers.show', $reply->comment->blog_id)
            ->with('success', 'Reply deleted successfully!');
    }



   

    public function deleteReplyFromAdmin($replyId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a reply.']);
        }

        $reply = Reply::findOrFail($replyId);

        $reply->delete();

        return redirect()->route('blogusers.show', $reply->comment->blog_id)
            ->with('success', 'Reply deleted successfully!');
    }
}

