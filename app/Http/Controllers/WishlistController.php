<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Game;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:games,id|exists:accessories,id',
        ]);

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to add items to your wishlist.');
        }

        $userId = Auth::id();
        $product = Game::find($request->id) ?? Accessory::find($request->id);

        if (!$product) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        // Prevent duplicate wishlist entries
        $exists = Wishlist::where('user_id', $userId)
            ->where('wishlistable_id', $product->id)
            ->where('wishlistable_type', get_class($product))
            ->exists();

        if ($exists) {
            return redirect()->back()->with('message', 'Item is already in your wishlist.');
        }

        Wishlist::create([
            'user_id' => $userId,
            'wishlistable_id' => $product->id,
            'wishlistable_type' => $product->getMorphClass(),
        ]);

        return redirect()->back()->with('message', 'Success! Item has been added to your wishlist.');
    }

    public function removeWishlist(Request $request)
    {
        Wishlist::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('message', 'Item removed from wishlist.');
    }

    public function clearWishlist()
    {
        Wishlist::where('user_id', Auth::id())->delete();

        return back()->with('message', 'Wishlist cleared.');
    }
}