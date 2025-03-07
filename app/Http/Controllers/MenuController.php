<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\AccessoryCategory;
use App\Models\Account;
use App\Models\Feedback;
use App\Models\Game;
use App\Models\BannedWord;
use App\Models\GameCategory;
use App\Models\Library;
use App\Models\Menu;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function dashboard()
    {
        $games = Game::all();
        $gamecates = GameCategory::all();
        $accessories = Accessory::all();
        $accessorycates = AccessoryCategory::all();
        $account = Account::all();

        return view("menu.dashboard", compact("games", "gamecates"));
    }

    public function menu()
    {
        $games = Game::all();
        $gamecates = GameCategory::all();
        $accessories = Accessory::all();
        $accessorycates = AccessoryCategory::all();
        $todaysPick = Game::where('todays_pick', 1)->first();

        return view("menu.index", compact("games", "accessories", "gamecates", "todaysPick"));
    }

    public function search(Request $request)
    {
        $query = $request->input('searchKeyword');

        $games = Game::where('title', 'LIKE', "%{$query}%")->get();
        $accessories = Accessory::where('name', 'LIKE', "%{$query}%")->get();

        if ($request->ajax()) {
            return response()->json([
                'games' => $games,
                'accessories' => $accessories
            ]);
        }

        return view('menu.search-results', compact('games', 'accessories', 'query'));
    }


    public function contact()
    {
        return view("menu.contact");
    }

    public function gameshop()
    {
        $games = Game::all();
        $gamecates = GameCategory::all();
        return view("menu.gameshop", compact("games", "gamecates"));
    }

    public function accessoryshop()
    {
        $accessories = Accessory::all();
        $accessorycates = AccessoryCategory::all();
        return view("menu.accessoryshop", compact("accessories", "accessorycates"));
    }

    public function gamedetails($id)
    {
        $game = Game::findOrFail($id);

        $relatedGames = Game::where('cat_id', $game->cat_id)
            ->where('id', '!=', $game->id)
            ->take(6)
            ->get();

        $bannedWords = BannedWord::pluck('word')->toArray();

        $sortOption = request('sort', 'newest');

        $feedbacks = $game->feedbacks()
            ->with('account')
            ->withCount('likeFeedbacks');

        if ($sortOption == 'star_desc') {
            $feedbacks = $feedbacks->orderBy('star', 'desc')->orderBy('created_at', 'desc');
        } elseif ($sortOption == 'star_asc') {
            $feedbacks = $feedbacks->orderBy('star', 'asc')->orderBy('created_at', 'desc');
        } elseif ($sortOption == 'newest') {
            $feedbacks = $feedbacks->orderBy('created_at', 'desc');
        } elseif ($sortOption == 'oldest') {
            $feedbacks = $feedbacks->orderBy('created_at', 'asc');
        }

        $averageRating = $game->feedbacks()->avg('star');
        $totalFeedbacks = $game->feedbacks()->count();

        $starFeedbackCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $starFeedbackCounts[$i] = $game->feedbacks()->where('star', $i)->count();
        }

        $feedbacks = $feedbacks->paginate(5);

        $userId = session('accountLogin');
        $canFeedback = false;

        if ($userId) {
            $existingFeedback = Feedback::where('game_id', $game->id)
                ->where('account_id', $userId)
                ->first();

            $purchasedGame = Library::where('games_id', $game->id)
                ->where('accounts_id', $userId)
                ->exists();

            if (!$existingFeedback && $purchasedGame) {
                $canFeedback = true;
            } else {
                $canFeedback = false;
            }
        }
        $inLibrary = Library::where('accounts_id', $userId)
            ->where('games_id', $game->id)
            ->exists();
        return view('menu.gamedetails', compact(
            'game',
            'relatedGames',
            'feedbacks',
            'bannedWords',
            'averageRating',
            'totalFeedbacks',
            'canFeedback',
            'starFeedbackCounts',
            'inLibrary'
        ));
    }






    public function accessorydetails($id)
    {
        $accessory = Accessory::findOrFail($id);
        $relatedAccessories = Accessory::where('cat_id', $accessory->cat_id)
            ->where('id', '!=', $accessory->id)
            ->take(6)
            ->get();
        return view("menu.accessorydetails", compact("accessory", "relatedAccessories"));
    }
}
