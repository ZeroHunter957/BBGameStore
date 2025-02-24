<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Game;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    //
    function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart.cart', ['cartItems' => $cartItems]);
    }

    function addToCart(Request $request)
    {
        $product = $request->developer
            ? Game::find($request->id)
            : Accessory::find($request->id);

        $name = $product->name ? $product->name : $product->title;
        if ($request->developer) {
            Cart::instance('cart')->add(
                $product->id,
                $name,
                $request->quantity,
                $product->price
            )->associate('App\Models\Game');
        } else {
            Cart::instance('cart')->add(
                $product->id,
                $name,
                $request->quantity,
                $product->price
            )->associate('App\Models\Accessory');
        }

        return redirect()->back()->with('message', 'Success! Item has been added successfully.');
    }


    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId, $request->quantity);
        return redirect()->route('cart.index');
    }

    public function removeCart(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }
    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}