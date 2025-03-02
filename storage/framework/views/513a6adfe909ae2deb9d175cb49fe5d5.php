<?php $__env->startSection('title', 'Game List'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <style>
            /* Toàn bộ container */
.container {
    max-width: 100%;
    margin: 0 auto;
    padding: 30px;
}

/* Căn chỉnh dọc cho tiêu đề và nút */
.d-flex {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
    width: 100%;
}

/* Tiêu đề danh sách Game List */
h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    text-align: left;
    letter-spacing: 1px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

/* Nút "Create New Game" */
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
    margin-bottom: 20px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
    transform: translateY(-2px);
}

/* Bảng hiển thị danh sách Game */
.table-responsive {
    width: 100%;
    overflow-x: auto;
    padding: 20px;
}

/* Điều chỉnh bảng */
.table {
    width: 100%;
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

/* Nút "Set as Today's Pick" */
.btn-primary.btn-sm {
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    padding: 8px 20px;
    font-size: 14px;
    font-weight: bold;
}

.btn-primary.btn-sm:hover {
    background: linear-gradient(135deg, #218838, #1e7e34);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(40, 167, 69, 0.3);
}

/* Tạo ảnh thumbnail đẹp mắt và chỉnh kích thước */
.img-thumbnail {
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    width: 150px; /* Điều chỉnh chiều rộng ảnh */
    height: auto; /* Đảm bảo chiều cao tự động để tỷ lệ ảnh không bị biến dạng */
    object-fit: cover; /* Đảm bảo ảnh không bị méo hoặc kéo dài */
}

.img-thumbnail:hover {
    transform: scale(1.1); /* Tăng kích thước ảnh khi hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Điều chỉnh độ rộng cột hình ảnh trong bảng */
.table td img {
    max-width: 100%;
    width: 150px; /* Đặt kích thước ảnh */
    height: auto;
}

/* Điều chỉnh các cột và hàng của bảng */
.table td {
    vertical-align: middle;
    padding: 15px;
}

/* Chỉnh sửa các badge (ví dụ "Today's Pick") */
.badge.bg-success {
    background-color: #28a745;
    font-size: 14px;
    padding: 5px 10px;
    border-radius: 10px;
    color: white;
}

        </style>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Game List</h2>
            <a href="<?php echo e(route('game.create')); ?>" class="btn btn-primary">Create New Game</a>
        </div>

        <?php if(session('message')): ?>
            <div class="alert alert-info">
                <strong>Info!</strong> <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Developer</th>
                        <th>Platform</th>
                        <th>Release Date</th>
                        <th>File</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->title); ?></td>
                            <td><?php echo e($item->category->name); ?></td>
                            <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                            <td class="text-truncate" style="max-width: 200px;"><?php echo Str::limit(strip_tags($item->description), 50); ?></td>
                            <td><?php echo e($item->developer); ?></td>
                            <td><?php echo e($item->platform); ?></td>
                            <td><?php echo e($item->release_date); ?></td>
                            <td>
                                <a href="<?php echo e(asset($item->file)); ?>" class="btn btn-sm btn-success"
                                    target="_blank">Download</a>
                            </td>
                            <td>
                                <img src="<?php echo e(asset($item->image)); ?>" class="img-thumbnail" width="80" alt="Game Image">
                            </td>
                            <td>
                                <a href="<?php echo e(route('game.edit', $item->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                                <a href="<?php echo e(route('game.setTodaysPick', $item->id)); ?>" class="btn btn-primary btn-sm">
                                    Set as Today's Pick
                                </a>
                                <?php if($item->todays_pick): ?>
                                    <span class="badge bg-success">Today's Pick</span>
                                <?php endif; ?>
                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/game/index.blade.php ENDPATH**/ ?>