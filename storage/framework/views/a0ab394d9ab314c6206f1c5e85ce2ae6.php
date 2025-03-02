<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-3">
        <h2>Edit Coupon</h2>
        <form action="<?php echo e(route('coupon.update', $coupon->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" name="code" id="code" class="form-control" value="<?php echo e($coupon->code); ?>" required>
            </div>
            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount (%)</label>
                <input type="number" step="0.01" name="discount_percent" id="discount_percent" class="form-control" value="<?php echo e($coupon->discount_percent); ?>" required>
            </div>
            <div class="mb-3">
                <label for="valid_from" class="form-label">Valid From</label>
                <input type="date" name="valid_from" id="valid_from" class="form-control" value="<?php echo e($coupon->valid_from); ?>">
            </div>
            <div class="mb-3">
                <label for="valid_to" class="form-label">Valid To</label>
                <input type="date" name="valid_to" id="valid_to" class="form-control" value="<?php echo e($coupon->valid_to); ?>">
            </div>
            <div class="mb-3">
                <label for="is_active" class="form-label">Status</label>
                <select name="is_active" id="is_active" class="form-select">
                    <option value="1" <?php echo e($coupon->is_active ? 'selected' : ''); ?>>Active</option>
                    <option value="0" <?php echo e(!$coupon->is_active ? 'selected' : ''); ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/coupon/edit.blade.php ENDPATH**/ ?>