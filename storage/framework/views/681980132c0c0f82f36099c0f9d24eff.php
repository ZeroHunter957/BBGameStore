<?php $__env->startSection('content'); ?>
    <div class="container">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macs/Documents/Zalo Received Files/BBGameStore-Bao 2/resources/views/order/index.blade.php ENDPATH**/ ?>