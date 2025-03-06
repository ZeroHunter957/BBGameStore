<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistEntries = Wishlist::where('account_id', session('accountLogin'))->get();
        $gameIds = $wishlistEntries->pluck('game_id');

        // Lấy thông tin game + category
        $wishlist = Game::with('category')->whereIn('id', $gameIds)->get();

        // Gán ngày mà user thêm vào wishlist từ bảng Wishlist
        $wishlist->map(function ($game) use ($wishlistEntries) {
            $libraryEntry = $wishlistEntries->firstWhere('game_id', $game->id);
            $game->added_to_wishlist_at = $libraryEntry ? $libraryEntry->created_at->format('Y-m-d') : null; // Lấy ngày từ bảng Wishlist
            return $game;
        });
        return view('cart.wishlist', compact('wishlist'));
    }


    public function addToWishlist($productId)
    {
        if (!session('accountLogin')) {
            return redirect()->route('login')->with('error', 'You need to log in to add to Wishlist.');
        }

        // Kiểm tra nếu sản phẩm đã tồn tại trong wishlist
        if (Wishlist::where('account_id', session('accountLogin'))->where('game_id', $productId)->exists()) {
            return redirect()->back()->with('message', 'Product is already in Wishlist.');
        }

        Wishlist::create([
            'account_id' => session('accountLogin'),
            'game_id' => $productId,
        ]);

        return redirect()->back()->with('message', 'Added to Wishlist.');
    }

    public function removeFromWishlist($id)
    {
        $accountId = session('accountLogin');

        Wishlist::where('account_id', $accountId)->where('game_id', $id)->delete();

        return redirect()->back()->with('success', 'Đã xóa khỏi wishlist!');
    }
}
