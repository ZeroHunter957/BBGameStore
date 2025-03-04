<?php

namespace App\Http\Controllers;
use App\Models\Coupon;

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

    function addToCart(Request $request)
    {
        $product = $request->developer
            ? Game::find($request->id)
            : Accessory::find($request->id);

        $name = $product->name ? $product->name : $product->title;

        if (session('accountLogin')) {
            $cartItem = Cart::where('account_id', session()->get('accountLogin'))
                ->where('product_id', $product->id)
                ->where('product_type', $request->developer ? 'game' : 'accessory')
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'account_id' => session()->get('accountLogin'),
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
    public function applyCoupon(Request $request)
{
    $request->validate(['coupon_code' => 'required|string']);

    // Tìm coupon trong database
    $coupon = Coupon::where('code', $request->coupon_code)->first();

    // Kiểm tra xem coupon có tồn tại và còn hiệu lực không
    if (!$coupon || !$coupon->isValid()) {
        return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
    }

    // Tính tổng giá trị đơn hàng hiện tại
    $cartItems = Cart::where('account_id', session('accountLogin'))->get();
    $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->price);

    // Tính tiền giảm giá
    $discount = ($subtotal * $coupon->discount_percent) / 100;
    $total = $subtotal - $discount;

    // Lưu mã giảm giá vào session
    session([
        'coupon' => [
            'code' => $coupon->code,
            'discount_percent' => $coupon->discount_percent,
            'discount_amount' => $discount,
            'total' => $total,
        ]
    ]);

    return redirect()->back()->with('success', 'Mã giảm giá đã được áp dụng thành công!');
}

}
