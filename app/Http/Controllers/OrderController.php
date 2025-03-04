<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách tất cả các đơn hàng.
     */
    public function index()
    {
        $orders = Order::with('user', 'games')->get(); // Lấy thông tin user và games liên quan
        return view("order.index", compact("orders"));
    }

    /**
     * Hiển thị form tạo đơn hàng mới.
     */
    public function create()
    {
        $games = Game::all(); // Lấy danh sách tất cả các game
        return view("order.create", compact("games"));
    }

    /**
     * Lưu đơn hàng mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        $request->validate([
            "user_id" => "required|exists:users,id",
            "status" => "required|in:pending,processing,completed,cancelled",
            "game_ids" => "required|array",
            "quantities" => "required|array",
            "custom_titles" => "nullable|array",
        ]);
    
        try {
            // Tìm ID lớn nhất hiện tại
            $lastOrder = Order::orderBy('id', 'desc')->first();
            $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
    
            // Tạo đơn hàng mới với ID tùy chỉnh
            $order = new Order();
            $order->id = $nextId; // Đặt ID mới
            $order->user_id = $request->user_id;
            $order->status = $request->status;
            $order->save();
    
            foreach ($request->game_ids as $index => $gameId) {
                $quantity = $request->quantities[$index];
                $customTitle = $request->custom_titles[$index] ?? Game::find($gameId)->title; // Dùng tên game tùy chỉnh nếu có
    
                $order->games()->attach($gameId, [
                    'quantity' => $quantity,
                    'custom_title' => $customTitle
                ]);
            }
    
            return redirect()->route("order.index")->with("message", "Order created successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with("message", "An error occurred: " . $e->getMessage());
        }
    }
    


    /**
     * Hiển thị form chỉnh sửa đơn hàng.
     */
    public function edit($id)
    {
        $order = Order::with('games')->findOrFail($id); // Lấy đơn hàng và các game liên quan
        $games = Game::all(); // Lấy danh sách tất cả các game
        return view("order.edit", compact("order", "games"));
    }

    /**
     * Cập nhật đơn hàng trong cơ sở dữ liệu.
     */
    public function update(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            "user_id" => "required|exists:users,id",
            "status" => "required|in:pending,processing,completed,cancelled",
            "game_ids" => "required|array", // Danh sách ID của các game trong đơn hàng
            "quantities" => "required|array", // Số lượng tương ứng với mỗi game
        ]);

        try {
            $order = Order::findOrFail($id);
            $order->user_id = $request->user_id;
            $order->status = $request->status;
            $order->save();

            // Xóa các game cũ trong đơn hàng
            $order->games()->detach();

            // Gắn lại các game với số lượng mới
            foreach ($request->game_ids as $index => $gameId) {
                $quantity = $request->quantities[$index];
                $order->games()->attach($gameId, ['quantity' => $quantity]);
            }

            return redirect()->route("order.index")->with("message", "Order updated successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with("message", "An error occurred: " . $e->getMessage());
        }
    }

    /**
     * Xóa đơn hàng.
     */
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->games()->detach(); // Xóa các mối quan hệ với game
            $order->delete(); // Xóa đơn hàng
            return redirect()->route("order.index")->with("message", "Order deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with("message", "An error occurred: " . $e->getMessage());
        }
    }
    public function updateStatus(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'status' => 'required|in:pending,reject,done',
        ]);

        try {
            // Tìm đơn hàng
            $order = Order::findOrFail($id);

            // Cập nhật trạng thái
            $order->status = $request->status;
            $order->save();

            return redirect()->back()->with('success', 'Order status updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
