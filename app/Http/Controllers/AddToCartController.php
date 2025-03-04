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
        $cartItems = Cart::where('account_id', session('accountLogin'))->get();

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

    public function addToCart(Request $request)
    {
        $isGame = $request->developer;
        $product = $isGame
            ? Game::find($request->id)
            : Accessory::find($request->id);

        if (!$product) {
            return redirect()->back()->with('message', 'Product does not exist.');
        }

        $name = $product->name ?? $product->title;

        if (session('accountLogin')) {
            $cartItem = Cart::where('account_id', session()->get('accountLogin'))
                ->where('product_id', $product->id)
                ->where('product_type', $isGame ? 'game' : 'accessory')
                ->first();

            if ($cartItem) {
                if ($isGame) {
                    return redirect()->back()->with('message', 'This game is already in your cart.');
                } else {
                    $cartItem->quantity += $request->quantity;
                    $cartItem->save();
                    return redirect()->back()->with('message', 'The product has been updated in the cart..');
                }
            } else {
                Cart::create([
                    'account_id' => session()->get('accountLogin'),
                    'product_id' => $product->id,
                    'product_type' => $isGame ? 'game' : 'accessory',
                    'name' => $name,
                    'quantity' => $isGame ? 1 : $request->quantity,
                    'price' => $product->price,
                ]);

                return redirect()->back()->with('message', 'Product has been added to cart.');
            }
        } else {
            return redirect()->back()->with('message', 'Please login to add to cart.');
        }
    }


    public function updateCart(Request $request)
    {
        if ($request->quantity <= 0) {
            Cart::where('account_id', session()->get('accountLogin'))
                ->where('id', $request->rowId)
                ->delete();
            return redirect()->route('cart.index');
        } else {
            Cart::where('account_id', session()->get('accountLogin'))
                ->where('id', $request->rowId)
                ->update(['quantity' => $request->quantity]);

            return redirect()->route('cart.index');
        }
    }

    public function removeCart(Request $request)
    {
        Cart::where('account_id', session()->get('accountLogin'))
            ->where('id', $request->rowId)
            ->delete();

        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::where('account_id', session()->get('accountLogin'))->delete();
        return redirect()->route('cart.index');
    }
}
