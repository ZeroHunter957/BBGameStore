<?php $__env->startSection('content'); ?>
    <div class="main-banner"></div>
    <div class="section trending">
        <div class="container">
            <?php if(session('message')): ?>
                <div class="alert alert-info">
                    <strong>Info!</strong><?php echo e(session('message')); ?>

                </div>
            <?php endif; ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>OTP Verification</h4>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('account.verifyOTPRegister')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="otp">Enter the OTP sent to your email</label>
                                <input type="text" id="otp" name="otp" class="form-control"
                                    value="<?php echo e(old('otp')); ?>">
                                <?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                            <p>Didn't receive an OTP? <a href="<?php echo e(route('account.resendOTP')); ?>">Resend OTP</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macs/Documents/Zalo Received Files/BBGameStore-Bao 2/resources/views/account/otp_register.blade.php ENDPATH**/ ?>