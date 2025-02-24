<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thanh toán</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    body{
        background-color: #0CEF7;
    }
</style>
<body>
    <div class="container mt-5 text-center">
        @if ($status == 'success')
            <h1 class="text-success">✅Payment successful!</h1>
            <p>{{ $message }}</p>
            <p><strong>Order code:</strong> {{ $order_id }}</p>
            <p><strong>Amount:</strong> {{ number_format($amount) }} VNĐ</p>
            <a href="" class="btn btn-success mt-3">View invoice</a>
            <a href="http://127.0.0.1:8000/" class="btn btn-success mt-3">Continue shopping</a>
        @else
            <h1 class="text-danger">❌Payment failed!</h1>
            <p>{{ $message }}</p>
            <p><strong>Order code:</strong> {{ $order_id }}</p>
            <p><strong>Amount:</strong> {{ number_format($amount) }} VNĐ</p>
            <a href="/" class="btn btn-primary mt-3">Retry</a>
            <a href="http://127.0.0.1:8000/" class="btn btn-success mt-3">Continue shopping</a>
        @endif
    </div>
</body>

</html>
