<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\AccessoryCategory;
use App\Models\Account;
use App\Models\Game;
use App\Models\GameCategory;
use App\Models\Menu;
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

        // Search both games and accessories
        $games = Game::where('title', 'LIKE', "%{$query}%")->get();
        $accessories = Accessory::where('name', 'LIKE', "%{$query}%")->get();

        // If request is AJAX (for autocomplete), return JSON
        if ($request->ajax()) {
            return response()->json([
                'games' => $games,
                'accessories' => $accessories
            ]);
        }

        // Otherwise, return a full search results page
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
        $game = Game::findOrFail($id); // Find the game by ID or return 404
        $relatedGames = Game::where('cat_id', $game->cat_id)
            ->where('id', '!=', $game->id) // Exclude the current game
            ->take(6)
            ->get();

        return view("menu.gamedetails", compact("game", "relatedGames"));
    }

    public function accessorydetails($id)
    {
        $accessory = Accessory::findOrFail($id); // Find the game by ID or return 404
        $relatedAccessories = Accessory::where('cat_id', $accessory->cat_id)
            ->where('id', '!=', $accessory->id) // Exclude the current accessory
            ->take(6)
            ->get();
        return view("menu.accessorydetails", compact("accessory", "relatedAccessories"));
    }
}