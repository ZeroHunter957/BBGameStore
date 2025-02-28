<?php

namespace App\Http\Controllers;

use App\Models\BannedWord;
use App\Models\Feedback;
use App\Models\ReplyFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{

    public function index()
    {
        $feedbacks = Feedback::all();
        return view('feedbacks.index', compact('feedbacks'));
    }

    public function storeFeedback(Request $request, $game_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to post a feedback.']);
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
            return redirect()->route('menu.gamedetails', $game_id)
                ->withErrors(['feedback' => 'Your feedback contains a banned word: ' . $bannedWordFound]);
        }

        $now = now();

        $feedback = Feedback::create([
            'game_id' => $game_id,
            'content' => $request->content,
            'star' => $request->star,
            'user_id' => Auth::id(),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('menu.gamedetails', $game_id)
            ->with('success', 'Your feedback has been posted successfully!');
    }


    public function likeFeedback($feedbackId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to like a feedback.']);
        }

        $feedback = Feedback::findOrFail($feedbackId);

        $like = \App\Models\LikeFeedback::where('user_id', Auth::id())
            ->where('feedback_id', $feedback->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            \App\Models\LikeFeedback::create([
                'user_id' => Auth::id(),
                'feedback_id' => $feedback->id,
            ]);
        }

        return back();
    }


    public function likeReplyFeedback($replyId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to like a reply.']);
        }

        $reply = ReplyFeedback::findOrFail($replyId);

        $like = \App\Models\LikeFeedback::where('user_id', Auth::id())
            ->where('reply_feedback_id', $reply->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            \App\Models\LikeFeedback::create([
                'user_id' => Auth::id(),
                'reply_feedback_id' => $reply->id,
                'feedback_id' => $reply->feedback->id,
            ]);
        }

        return back();
    }

    public function replyFeedback(Request $request, $feedbackId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to reply.']);
        }

        $feedback = Feedback::findOrFail($feedbackId);

        $now = now();

        $reply = ReplyFeedback::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'feedback_id' => $feedbackId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return back();
    }


    public function destroy($feedbackId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a feedback.']);
        }

        $feedback = Feedback::findOrFail($feedbackId);

        if ($feedback->user_id !== Auth::id() && Auth::user()->role != 1) {
            return redirect()->route('menu.gamedetails', $feedback->game_id)
                ->withErrors(['feedback' => 'You are not authorized to delete this feedback.']);
        }

        \App\Models\LikeFeedback::where('feedback_id', $feedbackId)->delete();

        $feedback->replyFeedbacks()->delete();

        $feedback->delete();

        return redirect()->route('menu.gamedetails', $feedback->game_id)
            ->with('success', 'feedback deleted successfully!');
    }


    public function deleteByAdmin($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        \App\Models\LikeFeedback::where('feedback_id', $feedbackId)->delete();

        $feedback->replyFeedbacks()->delete();

        $feedback->delete();

        return redirect()->route('feedbacks.index', $feedback->game_id)
            ->with('success', 'feedback deleted successfully!');
    }





    public function deleteFeedback($feedbackId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a feedback.']);
        }

        $feedback = Feedback::findOrFail($feedbackId);

        if ($feedback->user_id !== Auth::id()) {
            return redirect()->route('menu.gamedetails', $feedback->game_id)
                ->withErrors(['feedback' => 'You are not authorized to delete this feedback.']);
        }

        $feedback->replyFeedbacks()->delete();
        $feedback->delete();

        return redirect()->route('menu.gamedetails', $feedback->game_id)
            ->with('success', 'feedback deleted successfully!');
    }

    public function deleteReplyFeedback($replyId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a reply.']);
        }

        $reply = ReplyFeedback::findOrFail($replyId);

        if ($reply->user_id !== Auth::id()) {
            return redirect()->route('menu.gamedetails', $reply->feedback->game_id)
                ->withErrors(['feedback' => 'You are not authorized to delete this reply.']);
        }

        $reply->delete();

        return redirect()->route('menu.gamedetails', $reply->feedback->game_id)
            ->with('success', 'Reply deleted successfully!');
    }

    public function deleteReplyFeedbackFromAdmin($replyId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete a reply.']);
        }

        $reply = ReplyFeedback::findOrFail($replyId);

        $reply->delete();

        return redirect()->route('menu.gamedetails', $reply->feedback->game_id)
            ->with('success', 'Reply deleted successfully!');
    }
}
