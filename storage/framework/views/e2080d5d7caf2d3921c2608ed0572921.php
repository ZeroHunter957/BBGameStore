<?php $__env->startSection('title', 'list page'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mt-3">
        <style>
            /* Căn chỉnh toàn bộ container */
.container {
    max-width: 100%;
    margin: 0 auto;
    padding: 30px;
}

/* Căn chỉnh dọc cho tiêu đề và nút */
.d-flex {
    display: flex;
    flex-direction: column; /* Đảm bảo các phần tử nằm trên các dòng riêng biệt */
    align-items: flex-start;
    gap: 15px; /* Khoảng cách giữa tiêu đề và nút */
    width: 100%;
}

/* Tiêu đề của Accessory Categories List */
h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0;
    text-align: left;
    letter-spacing: 1px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

/* Nút "Create a new Accessory Category" */
.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
    display: inline-block;
    margin-bottom: 20px; /* Khoảng cách dưới nút */
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
    transform: translateY(-2px);
}

/* Bảng hiển thị danh sách Accessory Categories */
.table-responsive {
    width: 100%;
    overflow-x: auto;
    padding: 20px;
}

/* Điều chỉnh chiều rộng bảng */
.table {
    width: 100%; /* Đảm bảo bảng chiếm toàn bộ chiều ngang */
    min-width: 800px; /* Đặt chiều rộng tối thiểu cho bảng */
    border-collapse: collapse;
    font-size: 16px;
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.table:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Làm đẹp tiêu đề bảng */
.table-dark th {
    background: linear-gradient(90deg, #1f2d3d, #343a40);
    color: #ffffff;
    text-transform: uppercase;
    font-weight: bold;
    padding: 12px 15px;
    text-align: center;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Làm đẹp các hàng trong bảng */
.table tbody tr {
    transition: all 0.3s ease-in-out;
}

.table tbody tr:hover {
    background-color: #f5f5f5 !important;
    transform: scale(1.02);
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

/* Chỉnh sửa nút bấm trong bảng */
.btn-sm {
    padding: 8px 14px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 50px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

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

.btn-danger {
    background: linear-gradient(135deg, #f44336, #d32f2f);
    color: white;
    box-shadow: 0 4px 8px rgba(211, 47, 47, 0.2);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #e53935, #c62828);
    box-shadow: 0 6px 12px rgba(211, 47, 47, 0.3);
    transform: translateY(-2px);
}

/* Cảnh báo thông báo */
.alert-info {
    background-color: #d9edf7;
    color: #31708f;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.1);
}

        </style>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h2>Accessory Categories List</h2>
            <a href="<?php echo e(route('accessorycategory.create')); ?>" class="btn btn-primary">Create a new Accessory Category</a>
        </div>
        <?php if(session('message')): ?>
            <div class="alert alert-info">
                <strong>Info!</strong> <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table text-center align-middle table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Actions</th> <!-- Thêm cột Actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $accessorycategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <a href="<?php echo e(route('accessorycategory.edit', $item->id)); ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="<?php echo e(route('accessorycategory.destroy', $item->id)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/accessorycategory/index.blade.php ENDPATH**/ ?>