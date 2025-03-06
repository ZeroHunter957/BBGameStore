<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_percent',
        'valid_from',
        'valid_to',
        'is_active',
    ];

    // Kiểm tra coupon có hợp lệ hay không
    public function isValid()
    {
        return $this->is_active &&
            (!$this->valid_from || now()->greaterThanOrEqualTo($this->valid_from)) &&
            (!$this->valid_to || now()->lessThanOrEqualTo($this->valid_to));
    }

    

public static function generateUniqueCode()
{
    do {
        $code = strtoupper(Str::random(8)); // Sinh mã 8 ký tự ngẫu nhiên
    } while (self::where('code', $code)->exists()); // Đảm bảo không trùng

    return $code;
}

public function getStatusAttribute()
{
    if ($this->valid_to && now()->greaterThan($this->valid_to)) {
        return 'Inactive'; // Nếu ngày hiện tại lớn hơn ngày hết hạn, chuyển trạng thái
    }
    return $this->is_active ? 'Active' : 'Inactive';
}



}
