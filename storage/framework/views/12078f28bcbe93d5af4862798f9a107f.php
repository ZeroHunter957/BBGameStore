<?php $__env->startSection('title', 'list page'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mt-3">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macs/Documents/Zalo Received Files/BBGameStore-Bao 2/resources/views/accessorycategory/index.blade.php ENDPATH**/ ?>