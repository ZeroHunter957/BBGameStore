<?php $__env->startSection('title', 'list page'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Game Shop</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > Games</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <!-- Price Sorting Buttons -->
        <ul class="trending-filter sorting-options">
            <li><a href="#" data-sort="default" class="is_active">Sort By Order</a></li>
            <li><a href="#" data-sort="price:asc">Price: Low to High</a></li>
            <li><a href="#" data-sort="price:desc">Price: High to Low</a></li>
        </ul>

        <div class="container">
            <!-- Category Filter Buttons -->
            <ul class="trending-filter">
                <li>
                    <a class="is_active" href="#" data-filter="all">Show All</a>
                </li>
                <?php $__currentLoopData = $gamecates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="#" data-filter=".<?php echo e(Str::slug($item->name)); ?>"><?php echo e($item->name); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <!-- Game Items Container -->
            <div id="game-container">
                <div class="row">
                    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6 mix <?php echo e(Str::slug($item->category->name)); ?>"
                            data-price="<?php echo e($item->price ?? 0); ?>">
                            <div class="item">
                                <div class="thumb">
                                    <a href="<?php echo e(route('menu.gamedetails', $item->id)); ?>">
                                        <img src="<?php echo e($item->image); ?>" alt="">
                                    </a>
                                    <span class="price" data-price="<?php echo e($item->price); ?>">$<?php echo e($item->price); ?></span>
                                </div>
                                <div class="down-content">
                                    <span class="category"><?php echo e($item->category->name); ?></span>
                                    <h4><?php echo e($item->title); ?></h4>
                                    <a href="<?php echo e(route('menu.gamedetails', $item->id)); ?>">
                                        <i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var mixer = mixitup("#game-container .row", {
                    selectors: {
                        target: ".mix"
                    },
                    animation: {
                        duration: 300
                    }
                });

                // Handle category filtering
                document.querySelectorAll(".trending-filter:not(.sorting-options) a").forEach(button => {
                    button.addEventListener("click", function(event) {
                        event.preventDefault();

                        // Remove 'is_active' from category buttons only
                        document.querySelector(".trending-filter:not(.sorting-options) .is_active")
                            ?.classList.remove("is_active");
                        this.classList.add("is_active");

                        let filterValue = this.getAttribute("data-filter");
                        mixer.filter(filterValue === "all" ? "all" : filterValue);
                    });
                });

                // Handle sorting buttons separately
                document.querySelectorAll(".sorting-options a").forEach(button => {
                    button.addEventListener("click", function(event) {
                        event.preventDefault();

                        // Remove 'is_active' from sorting buttons only
                        document.querySelector(".sorting-options .is_active")?.classList.remove(
                            "is_active");
                        this.classList.add("is_active");

                        let sortValue = this.getAttribute("data-sort");
                        if (sortValue === "price:asc") {
                            mixer.sort("price:asc");
                        } else if (sortValue === "price:desc") {
                            mixer.sort("price:desc");
                        } else {
                            mixer.sort("default");
                        }
                    });
                });
            });
        </script>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/menu/gameshop.blade.php ENDPATH**/ ?>