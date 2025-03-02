<?php $__env->startSection('title', 'list page'); ?>

<?php $__env->startSection('content'); ?>

    
    

    <div class="main-banner"></div>
    <div class="section trending">
        <div class="container">
            <?php if(session('message')): ?>
                <div class="alert alert-info">
                    <strong>Info!</strong><?php echo e(session('message')); ?>

                </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Login form</h2>
            </div>
            <form action="<?php echo e(route('account.checkLogin')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="mb-3 mt-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/account/login.blade.php ENDPATH**/ ?>