<?php $__env->startSection('title', 'Accessory List'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Accessory List</h2>
            <a href="<?php echo e(route('accessory.create')); ?>" class="btn btn-primary">Create New Accessory</a>
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
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $accessories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->category->name); ?></td>
                            <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                            <td>
                                <img src="<?php echo e(asset($item->image)); ?>" class="img-thumbnail" width="80"
                                    alt="Accessory Image">
                            </td>
                            <td>
                                <a href="<?php echo e(route('accessory.edit', $item->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macs/Documents/Zalo Received Files/BBGameStore-Bao 2/resources/views/accessory/index.blade.php ENDPATH**/ ?>