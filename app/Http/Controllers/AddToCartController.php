<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Cart;
use App\Models\Game;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AddToCartController extends Controller
{
    //

    public function index()
    {
        $cartItems = Cart::where('user_id', session('accountLogin'))->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->image = ($cartItem->product_type == 'game')
                ? Game::where('id', $cartItem->product_id)->value('image')
                : Accessory::where('id', $cartItem->product_id)->value('image');
        }
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;
        return view('cart.cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    function addToCart(Request $request)
    {
        $product = $request->developer
            ? Game::find($request->id)
            : Accessory::find($request->id);

        $name = $product->name ? $product->name : $product->title;

        if (session('accountLogin')) {
            $cartItem = Cart::where('user_id', session()->get('accountLogin'))
                ->where('product_id', $product->id)
                ->where('product_type', $request->developer ? 'game' : 'accessory')
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => session()->get('accountLogin'),
                    'product_id' => $product->id,
                    'product_type' => $request->developer ? 'game' : 'accessory',
                    'name' => $name,
                    'quantity' => $request->quantity,
                    'price' => $product->price,
                ]);
            }
        } else {
            return redirect()->back()->with('message', 'Please log in to add items to your cart.');
        }

        return redirect()->back()->with('message', 'Success! Item has been added successfully.');
    }

    public function updateCart(Request $request)
    {
        if ($request->quantity <= 0) {
            Cart::where('id', $request->rowId)
                ->where('user_id', session()->get('accountLogin'))
                ->delete();
            return redirect()->route('cart.index');
        } else {
            Cart::where('user_id', session()->get('accountLogin'))
                ->where('id', $request->rowId)
                ->update(['quantity' => $request->quantity]);

            return redirect()->route('cart.index');
        }
    }

    public function removeCart(Request $request)
    {
        Cart::where('id', $request->rowId)
            ->where('user_id', session()->get('accountLogin'))
            ->delete();

        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::where('user_id', session()->get('accountLogin'))->delete();
        return redirect()->route('cart.index');
    }
}
