<?php $__env->startSection('content'); ?>
    <div class="container">
        <style>
            /* Toàn bộ container */
.container {
    max-width: 100%;
    margin: 0 auto;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

/* Hiệu ứng hover cho container */
.container:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

/* Tiêu đề Order List */
h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    text-align: left;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-out;
}

/* Hiệu ứng fade-in cho tiêu đề */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Bảng */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: fadeInTable 1s ease-out;
}

/* Hiệu ứng hover cho bảng */
.table:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Hiệu ứng fade-in cho bảng */
@keyframes fadeInTable {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Tiêu đề của bảng */
.table thead {
    background: linear-gradient(90deg, #1f2d3d, #343a40);
    color: white;
    font-weight: bold;
    text-align: center;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 15px;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
}

/* Căn chỉnh các cột trong bảng */
.table td, .table th {
    padding: 15px;
    text-align: center;
    vertical-align: middle;
}

/* Cột "Status" */
.table td:nth-child(3) {
    width: 150px;
    position: relative;
}

.form-select {
    font-size: 14px;
    border-radius: 5px;
    padding: 8px 12px;
    background-color: #f1f1f1;
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
    width: 120px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

/* Hiệu ứng hover cho dropdown */
.form-select:hover {
    border-color: #007bff;
    background-color: #e9ecef;
}

/* Thêm mũi tên cho dropdown */
.form-select:after {
    content: '\25BC';
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    font-size: 16px;
    color: #333;
}

/* Chỉnh sửa màu nền các hàng trong bảng */
.table tbody tr {
    transition: all 0.3s ease-in-out;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
    transform: scale(1.02);
}

/* Đặt màu nền cho các hàng lẻ và chẵn */
.table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table tbody tr:nth-child(even) {
    background-color: #ffffff;
}

/* Nút "Set as Today's Pick" */
.btn-sm {
    padding: 8px 15px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

/* Nút "Set as Today's Pick" */
.btn-success {
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    font-weight: 500;
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
}

.btn-success:hover {
    background: linear-gradient(135deg, #218838, #1e7e34);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(40, 167, 69, 0.3);
}

/* Nút "Edit" */
.btn-warning {
    background: linear-gradient(135deg, #ffb900, #ff8c00);
    color: #212529;
    box-shadow: 0 4px 8px rgba(255, 140, 0, 0.2);
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e0a800, #ff7100);
    box-shadow: 0 6px 12px rgba(255, 140, 0, 0.3);
    transform: translateY(-2px);
}

/* Cột "Games" */
.table td:nth-child(4) {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Chỉnh sửa chữ Pending */
.form-select {
    padding-left: 15px;
    background-color: #e9ecef; /* Nền dropdown sáng hơn */
}

/* Hiệu ứng đẹp cho các mũi tên */
.form-select:focus {
    border-color: #007bff;
    background-color: #f8f9fa;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
}

        </style>
        <h2>Order List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Games</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->user ? $order->user->fullname : 'Unknown User'); ?></td>
                        <td><?php echo e(ucfirst($order->status)); ?></td>
                        <td>
                            <?php $__currentLoopData = $order->games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($game->title); ?> (<?php echo e($game->pivot->quantity); ?>)<br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <!-- Dropdown to change status -->
                            <form action="<?php echo e(route('order.updateStatus', $order->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="reject" <?php echo e($order->status === 'reject' ? 'selected' : ''); ?>>Reject</option>
                                    <option value="done" <?php echo e($order->status === 'done' ? 'selected' : ''); ?>>Done</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/order/index.blade.php ENDPATH**/ ?>