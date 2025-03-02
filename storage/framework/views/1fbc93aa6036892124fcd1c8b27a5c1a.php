<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Lugx Gaming Shop HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!--
TemplateMo 589 lugx gaming
https://templatemo.com/tm-589-lugx-gaming
-->

    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

    <link href="adminkit/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<style>
    /* Main content */
.flex-wrapper {
    margin-left: 250px; /* Đảm bảo body không bị che khuất bởi sidebar */
    padding: 30px;
    background-color: #f4f7fc;
}

@media (max-width: 767px) {
    .flex-wrapper {
        margin-left: 0;
        padding: 20px;
    }
}

/* Phần header trong main content */
.main h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
}

/* Card Style */
.card {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.card:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

.card-header {
    background: linear-gradient(90deg, #6a78d1, #4e60b2);
    color: white;
    font-weight: 600;
    font-size: 1.2rem;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-body {
    padding: 20px;
}

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg, #007bff, #0062cc);
    color: white;
    font-weight: 500;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0062cc, #005bb5);
    box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
    transform: translateY(-2px);
}

/* Table Styles */
.table {
    width: 100%;
    margin-top: 30px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
}

.table th, .table td {
    padding: 15px;
    text-align: left;
}

.table thead {
    background: #4e60b2;
    color: white;
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* For the sidebar toggle button */
.sidebar-toggle {
    display: none;
}

@media (max-width: 767px) {
    .sidebar-toggle {
        display: block;
    }
}

/* Sidebar */
#sidebar {
    background-color: #2d3436; /* Màu nền tối */
    color: #ffffff;
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 30px;
    box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

#sidebar .sidebar-brand {
    font-size: 1.5rem;
    font-weight: bold;
    color: #ffffff;
    padding: 15px;
    display: flex;
    justify-content: center;
    text-decoration: none;
}

#sidebar .sidebar-nav {
    list-style: none;
    padding-left: 0;
    margin-top: 30px;
}

#sidebar .sidebar-item {
    padding: 8px 10px;
    border-bottom: 1px solid #444;
    transition: background-color 0.3s;
}

#sidebar .sidebar-item:hover {
    background-color: #4e60b2; /* Màu nền khi hover */
    cursor: pointer;
}

#sidebar .sidebar-item .sidebar-link {
    color: #ffffff;
    text-decoration: none;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
}

#sidebar .sidebar-item .sidebar-link i {
    margin-right: 15px;
}

/* Sidebar Header */
.sidebar-header {
    font-size: 1.2rem;
    font-weight: 600;
    color: #aaa;
    margin-left: 20px;
}

/* Màu cho các đường dẫn đã được chọn */
.sidebar-item.active {
    background-color: #3498db;
}

.sidebar-item.active .sidebar-link {
    color: white;
}

/* Thêm hiệu ứng cho logo và sidebar */
.sidebar-brand {
    font-size: 24px;
    text-align: center;
    margin-bottom: 30px;
}

@media (max-width: 767px) {
    #sidebar {
        width: 200px;
    }
}

</style>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="<?php echo e(route(name: 'menu.dashboard')); ?>">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Products and Categories
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('gamecategory.index')); ?>">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Game
                                Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route(name: 'game.index')); ?>">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Games</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route(name: 'accessorycategory.index')); ?>">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Accessory
                                Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route(name: 'accessory.index')); ?>">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Accessory</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route(name: 'order.index')); ?>">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Order</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route(name: 'coupon.index')); ?>">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Coupon</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link">
                            <i class="align-middle" ></i>
                            <span class="align-middle">Log out</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </nav>

        
        <div class="flex-wrapper">
            <div class="p-0 container-fluid">
                <div class="main">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/isotope.min.js"></script>
        <script src="assets/js/owl-carousel.js"></script>
        <script src="assets/js/counter.js"></script>
        <script src="assets/js/custom.js"></script>

</body>

</html>
<?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/layouts/admin.blade.php ENDPATH**/ ?>