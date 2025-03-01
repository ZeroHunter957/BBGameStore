<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Accessory;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    /**
     * Display the wishlist items.
     */
    public function index()
    {
        $userId = session('accountLogin');

        if (!$userId) {
            return redirect()->route('account.login')->with('error', 'You must be logged in to view your wishlist.');
        }

        $wishlistItems = Wishlist::where('user_id', $userId)->with('wishable')->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Add an item to the wishlist.
     */
    public function addToWishlist(Request $request)
    {
        $userId = session('accountLogin');

        if (!$userId) {
            return response()->json(['error' => 'You must be logged in to add items to your wishlist.'], 401);
        }

        $validated = $request->validate([
            'id' => 'required|integer',
            'type' => 'required|string|in:game,accessory',
        ]);

        $product = $validated['type'] === 'game' ? Game::find($validated['id']) : Accessory::find($validated['id']);

        if (!$product) {
            return response()->json(['error' => 'Item not found.'], 404);
        }

        $wishlistItem = Wishlist::firstOrCreate([
            'user_id' => $userId,
            'wishable_id' => $product->id,
            'wishable_type' => get_class($product),
        ]);

        return response()->json(['message' => 'Added to wishlist!', 'wishlistItem' => $wishlistItem]);
    }

    /**
     * Remove an item from the wishlist.
     */
    public function removeFromWishlist(Request $request)
    {
        $userId = session('accountLogin');

        if (!$userId) {
            return response()->json(['error' => 'You must be logged in to manage your wishlist.'], 401);
        }

        $validated = $request->validate([
            'id' => 'required|integer',
            'type' => 'required|string|in:game,accessory',
        ]);

        Wishlist::where([
            'user_id' => $userId,
            'wishable_id' => $validated['id'],
            'wishable_type' => $validated['type'] === 'game' ? Game::class : Accessory::class,
        ])->delete();

        return response()->json(['message' => 'Removed from wishlist.']);
    }

    /**
     * Clear all wishlist items for the user.
     */
    public function clearWishlist()
    {
        $userId = session('accountLogin');

        if (!$userId) {
            return redirect()->route('account.login')->with('error', 'You must be logged in to clear your wishlist.');
        }

        Wishlist::where('user_id', $userId)->delete();

        return response()->json(['message' => 'Wishlist cleared.']);
    }
}