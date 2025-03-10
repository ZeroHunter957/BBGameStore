<?php
namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    // Hiển thị danh sách coupon
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupon.index', compact('coupons'));
    }

    // Hiển thị form tạo mới coupon
    public function create()
    {
        return view('coupon.create');
    }

    // Lưu coupon mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'discount_percent' => 'required|numeric|min:0|max:100',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);
    
        Coupon::create([
            'code' => Coupon::generateUniqueCode(), // Tự động tạo mã
            'discount_percent' => $request->discount_percent,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to,
            'is_active' => $request->is_active ?? 1, // Mặc định là active
        ]);
    
        return redirect()->route('coupon.index')->with('message', 'Coupon created successfully!');
    }

    // Hiển thị form chỉnh sửa coupon
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupon.edit', compact('coupon'));
    }

    // Cập nhật coupon
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $id,
            'discount_percent' => 'required|numeric|min:0|max:100',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        return redirect()->route('coupon.index')->with('success', 'Update Success');
    }

    // Xóa coupon
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupon.index')->with('message', 'Coupon deleted successfully!');
    }

    // Chọn người nhận coupon
    public function selectRecipients($id)
{
    $coupon = Coupon::findOrFail($id);

    // Lấy danh sách user từ bảng accounts (loại bỏ admin)
    $users = Account::where('role', 'USER')->whereNotNull('email')->get();

    return view('coupon.select_recipients', compact('coupon', 'users'));
}



    // Gửi mã giảm giá
    public function send(Request $request, $id)
{
    $coupon = Coupon::findOrFail($id);
    
    // Lấy danh sách email từ request
    $emails = $request->input('emails');

    if (!$emails || count($emails) === 0) {
        return redirect()->back()->with('error', 'No recipients selected!');
    }

    foreach ($emails as $email) {
        Mail::raw("You have received a discount coupon: {$coupon->code}", function ($message) use ($email) {
            $message->to($email)
                    ->subject('Your Discount Coupon');
        });
    }

    return redirect()->back()->with('success', 'Coupon sent successfully!');
}

    // apply coupon
    public function applyCoupon(Request $request) {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return redirect()->back()->with('message', 'Invalid or expired coupon code.');
        }

        session(['coupon' => $coupon->id]);// truyen vao session roi lay qua payment
        
        return redirect()->back()->with('message', 'Coupon code has been applied.');
    }
}
