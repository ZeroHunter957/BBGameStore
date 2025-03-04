<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        <h2>Edit Coupon</h2>
        <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Code -->
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $coupon->code }}" required>
            </div>

            <!-- Discount -->
            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount (%)</label>
                <input type="number" step="0.01" name="discount_percent" id="discount_percent" class="form-control" value="{{ $coupon->discount_percent }}" required min="0" max="100" oninput="validateDiscount(this)">
                <small id="discountError" class="text-danger"></small>
            </div>

            <!-- Valid From -->
            <div class="mb-3">
                <label for="valid_from" class="form-label">Valid From</label>
                <input type="date" name="valid_from" id="valid_from" class="form-control" value="{{ $coupon->valid_from }}" required>
            </div>

            <!-- Valid To -->
            <div class="mb-3">
                <label for="valid_to" class="form-label">Valid To</label>
                <input type="date" name="valid_to" id="valid_to" class="form-control" value="{{ $coupon->valid_to }}" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="is_active" class="form-label">Status</label>
                <select name="is_active" id="is_active" class="form-select">
                    <option value="1" {{ $coupon->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$coupon->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set mặc định ngày hôm nay cho Valid From
            let today = new Date().toISOString().split('T')[0];
            let validFrom = document.getElementById("valid_from");
            if (!validFrom.value) {
                validFrom.value = today;
            }
            validFrom.setAttribute("min", today);

            // Valid To chỉ cho phép chọn ngày từ hôm nay trở đi
            let validTo = document.getElementById("valid_to");
            validTo.setAttribute("min", today);

            // Kiểm tra discount ngay khi nhập
            function validateDiscount(input) {
                let value = parseFloat(input.value);
                let errorElement = document.getElementById('discountError');

                if (value < 0 || value > 100 || isNaN(value)) {
                    errorElement.textContent = "Discount must be between 0% and 100%.";
                    input.classList.add("is-invalid");
                } else {
                    errorElement.textContent = "";
                    input.classList.remove("is-invalid");
                }
            }

            // Gán sự kiện kiểm tra lỗi cho ô discount
            document.getElementById("discount_percent").addEventListener("input", function() {
                validateDiscount(this);
            });
        });
    </script>
</body>
</html>
