<?php $__env->startSection('title', 'Game List'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macs/Documents/Zalo Received Files/BBGameStore-Bao 2/resources/views/game/index.blade.php ENDPATH**/ ?>