<?php $__env->startSection('content'); ?>
    <div class="container mt-3">
        <h2>Coupon List</h2>
        <a href="<?php echo e(route('coupon.create')); ?>" class="mb-3 btn btn-primary">Create New Coupon</a>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Discount (%)</th>
                    <th>Valid From</th>
                    <th>Valid To</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($coupon->id); ?></td>
                        <td><?php echo e($coupon->code); ?></td>
                        <td><?php echo e($coupon->discount_percent); ?>%</td>
                        <td><?php echo e($coupon->valid_from ?? 'N/A'); ?></td>
                        <td><?php echo e($coupon->valid_to ?? 'N/A'); ?></td>
                        <td><?php echo e($coupon->is_active ? 'Active' : 'Inactive'); ?></td>
                        <td>
                            <a href="<?php echo e(route('coupon.edit', $coupon->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="<?php echo e(route('coupon.destroy', $coupon->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macs/Documents/Zalo Received Files/BBGameStore-Bao 2/resources/views/coupon/index.blade.php ENDPATH**/ ?>