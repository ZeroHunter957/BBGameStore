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
        <h2>Create New Coupon</h2>
        <form action="{{ route('coupon.store') }}" method="POST">
            @csrf
            {{-- <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div> --}}
            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount (%)</label>
                <input type="number" step="0.01" name="discount_percent" id="discount_percent" class="form-control"
                       required min="0" max="100" oninput="validateDiscount(this)">
                <small id="discountError" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <label for="valid_from" class="form-label">Valid From</label>
                <input type="date" name="valid_from" id="valid_from" class="form-control" 
                       min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
            </div>
            
            <div class="mb-3">
                <label for="valid_to" class="form-label">Valid To</label>
                <input type="date" name="valid_to" id="valid_to" class="form-control" 
                       min="{{ date('Y-m-d') }}">
            </div>
            
            <div class="mb-3">
                <label for="is_active" class="form-label">Status</label>
                <select name="is_active" id="is_active" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <script>
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
    </script>
</body>
</html>
