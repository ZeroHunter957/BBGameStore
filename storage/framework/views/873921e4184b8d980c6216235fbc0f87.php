<?php $__env->startPush('styles'); ?>
    <style>
        .empty-cart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
            /* Căn giữa theo chiều dọc */
            text-align: center;
        }

        .empty-cart-container h2 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-cart-container h5 {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        .empty-cart-container .btn-warning {
            background-color: #FF9800;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .empty-cart-container .btn-warning:hover {
            background-color: #e68900;
            transform: scale(1.05);
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Cart </h3>
                    <span class="breadcrumb"><a href="/menu">Home</a> > Cart</span>
                </div>
            </div>
        </div>
    </div>

    <?php if($cartItems->Count() > 0): ?>
        <section class="cart-section section-b-space">
            <div class="container">
                <div class="row">
                    <div class="text-center col-md-12">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">total</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="../product/details.html">
                                                <img src="<?php echo e($item->model->image); ?>" class="blur-up lazyloaded"
                                                    alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="../product/details.html"><?php echo e($item->model->title?$item->model->title:$item->model->name); ?></a>
                                            <div class="mobile-cart-content row">
                                                <div class="col">
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <input type="text" name="quantity"
                                                                class="form-control input-number" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h2><?php echo e($item->price); ?></h2>
                                                </div>
                                                <div class="col">
                                                    <h2 class="td-color">
                                                        <a href="javascript:void(0)">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h2><?php echo e($item->price); ?>$</h2>
                                        </td>
                                        <td>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="number" name="quantity" data-rowid="<?php echo e($item->rowId); ?>"
                                                        onchange="updateQuantity(this)" class="form-control input-number"
                                                        value="<?php echo e($item->qty); ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h2 class="td-color"><?php echo e($item->subtotal()); ?>$</h2>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="removeItem('<?php echo e($item->rowId); ?>')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 col-12 mt-md-5">
                        <div class="row">
                            <div class="order-1 col-sm-7 col-5">
                                <div class="left-side-button text-end d-flex d-block justify-content-end">
                                    <a href="javascript:void(0)"
                                        class="text-decoration-underline theme-color d-block text-capitalize"
                                        onclick="clearCart()">clear
                                        all items</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-checkout-section">
                        <div class="row g-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="promo-section">
                                    <form action="<?php echo e(route('cart.applyCoupon')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-3">
                                            <label for="coupon_code" class="form-label">Coupon Code</label>
                                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter coupon code">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Apply Coupon</button>
                                    </form>

                                    <?php if(session('coupon')): ?>
                                        <div class="alert alert-success">
                                            Coupon applied successfully! Discount: <?php echo e(session('coupon.discount_percent')); ?>%
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="<?php echo e(route('menu.gameshop')); ?>" class="btn btn-secondary">Continue Shopping</a>
                                <form action="<?php echo e(route('cart.checkout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                </form>
                            </div>

                            <div class="col-lg-4">
                                <div class="cart-box">
                                    <div class="cart-box-details">
                                        <div class="total-details">
                                            <div class="top-details">
                                                <?php if(session('coupon')): ?>
                                                    <p>Subtotal: <?php echo e(Cart::instance('cart')->subtotal()); ?></p>
                                                    <p>Discount (<?php echo e(session('coupon.discount_percent')); ?>%): <?php echo e(session('coupon.discount_amount')); ?></p>
                                                    <p>Total: <?php echo e(session('coupon.total')); ?></p>
                                                <?php else: ?>
                                                    <p>Total: <?php echo e(Cart::instance('cart')->total()); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12 empty-cart-container">
                <h2>Your cart is empty !</h2>
                <h5 class="mt-3">Add Items to it now.</h5>
                <a href="<?php echo e(route('menu.gameshop')); ?>" class="mt-4 btn btn-warning">Shop now</a>
            </div>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('cart.update')); ?>" id="UpdateCartQty" method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
        <input type="hidden" id="rowId" name="rowId">
        <input type="hidden" id="quantity" name="quantity">
    </form>
    <form action="<?php echo e(route('cart.remove')); ?>" id="removeItem" method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('delete'); ?>
        <input type="hidden" id="rowId_D" name="rowId">
    </form>
    <form action="<?php echo e(route('cart.clear')); ?>" id="clearCart" method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('delete'); ?>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        function updateQuantity(qty) {
            $('#rowId').val($(qty).data('rowid'));
            $('#quantity').val($(qty).val());
            $('#UpdateCartQty').submit();
        }

        function removeItem(rowId) {
            $('#rowId_D').val(rowId);
            $('#removeItem').submit();
        }

        function clearCart() {
            $('#clearCart').submit();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/cart/cart.blade.php ENDPATH**/ ?>