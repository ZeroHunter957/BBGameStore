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
        <h2>Edit Game Category</h2>
        <form action="<?php echo e(route('gamecategory.update', $gamecategory->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $gamecategory->name)); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo e(route('gamecategory.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
<?php /**PATH /Users/macs/Documents/Zalo Received Files/BBGameStore-Bao 2/resources/views/gamecategory/edit.blade.php ENDPATH**/ ?>