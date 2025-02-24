<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn của tôi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>🧾 Danh sách hóa đơn</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã hóa đơn</th>
                    <th>Số tiền</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->order_code }}</td>
                    <td>{{ number_format($invoice->total_amount) }} VNĐ</td>
                    <td>{{ $invoice->payment_method }}</td>
                    <td>
                        @if($invoice->status == 'Đã thanh toán')
                            <span class="badge bg-success">Đã thanh toán</span>
                        @else
                            <span class="badge bg-warning">{{ $invoice->status }}</span>
                        @endif
                    </td>
                    <td>{{ $invoice->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
