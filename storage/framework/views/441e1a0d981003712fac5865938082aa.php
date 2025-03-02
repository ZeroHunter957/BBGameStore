<?php $__env->startSection('title', 'dashboard'); ?>
<!-- Thêm link CSS cho Flatpickr -->
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

<!-- Thêm link JS cho Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<?php $__env->startSection('content'); ?>
    <div class="wrapper">
        <style>
            /* Toàn bộ container */
.container-fluid {
    padding: 30px;
    background-color: #f4f7fc;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

/* Hiệu ứng hover cho container */
.container-fluid:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

/* Tiêu đề của trang */
h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3436;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 20px;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    animation: fadeInTitle 1s ease-out;
}

/* Hiệu ứng fade-in cho tiêu đề */
@keyframes fadeInTitle {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .card-header {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        padding: 15px;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 5px;
    }
    .bg-success {
        background-color: #28a745 !important;
    }
    .bg-danger {
        background-color: #dc3545 !important;
    }
    .bg-warning {
        background-color: #ffc107 !important;
        color: black;
    }

/* Thẻ card */
.card {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    margin-bottom: 20px;
    overflow: hidden;
}

/* Hiệu ứng hover cho thẻ card */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

/* Card header */
.chart {
    position: relative;
    height: 300px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Tùy chỉnh tiêu đề và card */
.card-header {
    background: linear-gradient(90deg, #6a78d1, #4e60b2);
    color: white;
    padding: 15px;
    font-size: 1.1rem;
    font-weight: 600;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}


/* Thẻ thống kê */
.card-body {
    padding: 20px;
}

/* Các chỉ số trong các thẻ thống kê */
.card-body h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
}

/* Thêm các hiệu ứng cho phần trăm thay đổi */
.card-body .text-success, .card-body .text-danger {
    font-size: 1rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

/* Các phần trăm khi hover */
.card-body .text-success:hover, .card-body .text-danger:hover {
    color: #007bff;
}

/* Nút */
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

/* Biểu đồ */


/* Bảng thống kê các dự án */
.table thead {
    background: linear-gradient(90deg, #6a78d1, #4e60b2);
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

/* Các ô bảng */
.table td, .table th {
    padding: 10px;
    vertical-align: middle;
}

/* Nút trong bảng */
.table .btn-sm {
    font-size: 14px;
    padding: 8px 15px;
    font-weight: bold;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Nút "Edit" */
.table .btn-warning {
    background: linear-gradient(135deg, #ffb900, #ff8c00);
    color: #212529;
    box-shadow: 0 4px 8px rgba(255, 140, 0, 0.2);
}

.table .btn-warning:hover {
    background: linear-gradient(135deg, #e0a800, #ff7100);
    box-shadow: 0 6px 12px rgba(255, 140, 0, 0.3);
    transform: translateY(-2px);
}

/* Nút "Delete" */
.table .btn-danger {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
}

.table .btn-danger:hover {
    background: linear-gradient(135deg, #c82333, #b21e2d);
    box-shadow: 0 6px 12px rgba(220, 53, 69, 0.3);
    transform: translateY(-2px);
}

/* Phần "Recent Movement" */
.card-body .chart-sm {
    position: relative;
    height: 350px;
    background-color: #f1f3f5;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Phần "Browser Usage" */
.card-body table {
    width: 100%;
}

.card-body table td {
    padding: 12px;
    font-size: 14px;
}

/* Phần "Browser Usage" */
.card-body .text-end {
    font-weight: 500;
    color: #007bff;
}

.card-body .text-end:hover {
    color: #0056b3;
}

/* Các phần khác */
.card-body .py-3 {
    padding-top: 15px;
    padding-bottom: 15px;

    /* ======= Tùy chỉnh giao diện card ======= */
.stat-card {
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.stat-card:hover {
    transform: translateY(-5px);
}

/* ======= Tùy chỉnh ô tròn chứa icon ======= */
.stat-icon {
    background-color: rgba(0, 123, 255, 0.1);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ======= Hiệu ứng động cho icon ======= */
.spinning-icon {
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.blinking-icon {
    animation: blink 1s infinite alternate;
}

@keyframes blink {
    0% { opacity: 1; }
    100% { opacity: 0.3; }
}

.shaking-icon {
    animation: shake 0.5s infinite alternate;
}

@keyframes shake {
    0% { transform: translateX(0px); }
    100% { transform: translateX(3px); }
}

.bouncing-icon {
    animation: bounce 1s infinite alternate;
}

@keyframes bounce {
    0% { transform: translateY(0px); }
    100% { transform: translateY(-5px); }
}
}

        </style>
        <div class="main">
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

                    <div class="row">
                        <div class="col-xl-6 col-xxl-5 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Sales -->
                                        <div class="card stat-card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h5 class="card-title">Sales</h5>
                                                        <h1 class="stat-number">2.382</h1>
                                                        <span class="stat-percentage text-danger"><i class="mdi mdi-arrow-down"></i> -3.65%</span>
                                                        <span class="text-muted">Since last week</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="stat-icon">
                                                            <i class="align-middle spinning-icon" data-feather="truck"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Visitors -->
                                        <div class="card stat-card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h5 class="card-title">Visitors</h5>
                                                        <h1 class="stat-number">14.212</h1>
                                                        <span class="stat-percentage text-success"><i class="mdi mdi-arrow-up"></i> 5.25%</span>
                                                        <span class="text-muted">Since last week</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="stat-icon">
                                                            <i class="align-middle blinking-icon" data-feather="users"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-6">
                                        <!-- Earnings -->
                                        <div class="card stat-card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h5 class="card-title">Earnings</h5>
                                                        <h1 class="stat-number">$21.300</h1>
                                                        <span class="stat-percentage text-success"><i class="mdi mdi-arrow-up"></i> 6.65%</span>
                                                        <span class="text-muted">Since last week</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="stat-icon">
                                                            <i class="align-middle bouncing-icon" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Orders -->
                                        <div class="card stat-card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h5 class="card-title">Orders</h5>
                                                        <h1 class="stat-number">64</h1>
                                                        <span class="stat-percentage text-danger"><i class="mdi mdi-arrow-down"></i> -2.25%</span>
                                                        <span class="text-muted">Since last week</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="stat-icon">
                                                            <i class="align-middle shaking-icon" data-feather="shopping-cart"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-7">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Recent Movement</h5>
                                </div>
                                <div class="card-body py-3">
                                    <!-- Thêm canvas cho biểu đồ -->
                                    <div class="chart chart-sm">
                                        <canvas id="recentMovementChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Browser Usage</h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="align-self-center w-100">
                                        <!-- Biểu đồ Pie Chart -->
                                        <div class="py-3">
                                            <div class="chart chart-xs">
                                                <canvas id="chartjs-dashboard-pie"></canvas>
                                            </div>
                                        </div>
                        
                                        <!-- Bảng số liệu -->
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Chrome</td>
                                                    <td class="text-end" id="chrome-count">4306</td>
                                                </tr>
                                                <tr>
                                                    <td>Firefox</td>
                                                    <td class="text-end" id="firefox-count">3801</td>
                                                </tr>
                                                <tr>
                                                    <td>IE</td>
                                                    <td class="text-end" id="ie-count">1689</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">🔥 Hot Deals Real-Time</h5>
                                </div>
                                <div class="card-body px-4">
                                    <ul id="gameDeals" class="list-group"></ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
                            <div class="card flex-fill">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Calendar</h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="align-self-center w-100">
                                        <div class="chart">
                                            <div id="datetimepicker-dashboard"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Order Information</h5>
                                </div>
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th class="d-none d-xl-table-cell">Order Date</th>
                                            <th class="d-none d-xl-table-cell">Delivery Date</th>
                                            <th>Status</th>
                                            <th class="d-none d-md-table-cell">Customer</th>
                                            <th class="d-none d-md-table-cell">Priority</th>
                                            <th class="d-none d-md-table-cell">Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1001</td>
                                            <td class="d-none d-xl-table-cell">01/01/2024</td>
                                            <td class="d-none d-xl-table-cell">05/01/2024</td>
                                            <td><span class="badge bg-success">Shipped</span></td>
                                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                            <td class="d-none d-md-table-cell">High</td>
                                            <td class="d-none d-md-table-cell">100%</td>
                                        </tr>
                                        <tr>
                                            <td>#1002</td>
                                            <td class="d-none d-xl-table-cell">15/02/2024</td>
                                            <td class="d-none d-xl-table-cell">20/02/2024</td>
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            <td class="d-none d-md-table-cell">William Harris</td>
                                            <td class="d-none d-md-table-cell">Medium</td>
                                            <td class="d-none d-md-table-cell">30%</td>
                                        </tr>
                                        <tr>
                                            <td>#1003</td>
                                            <td class="d-none d-xl-table-cell">10/03/2024</td>
                                            <td class="d-none d-xl-table-cell">15/03/2024</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                            <td class="d-none d-md-table-cell">Low</td>
                                            <td class="d-none d-md-table-cell">100%</td>
                                        </tr>
                                        <tr>
                                            <td>#1004</td>
                                            <td class="d-none d-xl-table-cell">05/04/2024</td>
                                            <td class="d-none d-xl-table-cell">10/04/2024</td>
                                            <td><span class="badge bg-warning">Processing</span></td>
                                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                            <td class="d-none d-md-table-cell">High</td>
                                            <td class="d-none d-md-table-cell">65%</td>
                                        </tr>
                                        <tr>
                                            <td>#1005</td>
                                            <td class="d-none d-xl-table-cell">01/05/2024</td>
                                            <td class="d-none d-xl-table-cell">06/05/2024</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td class="d-none d-md-table-cell">William Harris</td>
                                            <td class="d-none d-md-table-cell">Medium</td>
                                            <td class="d-none d-md-table-cell">100%</td>
                                        </tr>
                                        <tr>
                                            <td>#1006</td>
                                            <td class="d-none d-xl-table-cell">10/06/2024</td>
                                            <td class="d-none d-xl-table-cell">15/06/2024</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                            <td class="d-none d-md-table-cell">Low</td>
                                            <td class="d-none d-md-table-cell">100%</td>
                                        </tr>
                                        <tr>
                                            <td>#1007</td>
                                            <td class="d-none d-xl-table-cell">15/07/2024</td>
                                            <td class="d-none d-xl-table-cell">20/07/2024</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td class="d-none d-md-table-cell">Christina Mason</td>
                                            <td class="d-none d-md-table-cell">Medium</td>
                                            <td class="d-none d-md-table-cell">100%</td>
                                        </tr>
                                        <tr>
                                            <td>#1008</td>
                                            <td class="d-none d-xl-table-cell">20/08/2024</td>
                                            <td class="d-none d-xl-table-cell">25/08/2024</td>
                                            <td><span class="badge bg-warning">Processing</span></td>
                                            <td class="d-none d-md-table-cell">William Harris</td>
                                            <td class="d-none d-md-table-cell">High</td>
                                            <td class="d-none d-md-table-cell">45%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">📊 Monthly Sales</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script src="js/app.js"></script>

    <!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace();
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("chartjs-dashboard-bar").getContext("2d");

    // Hàm tạo dữ liệu ngẫu nhiên
    function generateRandomSales(base, variance) {
        return Array.from({ length: 12 }, () => Math.floor(base + Math.random() * variance));
    }

    var randomSalesData = generateRandomSales(3000, 7000); // Sinh dữ liệu từ 3000 - 10000

    var monthlySalesChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales ($)",
                data: randomSalesData, // Dữ liệu ngẫu nhiên
                backgroundColor: "#4285F4",
                borderColor: "#3367D6",
                borderWidth: 2,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: "rgba(0, 0, 0, 0.1)" }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
});

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var orderList = document.getElementById("orderList");
        
            function addOrder(user, game, price) {
                var item = document.createElement("li");
                item.className = "list-group-item";
                item.innerHTML = `<strong>${user}</strong> vừa mua <strong>${game}</strong> với giá <span style="color: green;">$${price}</span>`;
                orderList.prepend(item);
        
                // Chỉ hiển thị 5 đơn hàng gần nhất
                if (orderList.children.length > 5) {
                    orderList.removeChild(orderList.lastChild);
                }
            }
        
            // Fake đơn hàng để demo real-time
            setInterval(function() {
                var users = ["John", "Alice", "Mike", "Emma", "David"];
                var games = ["Cyberpunk 2077", "Elden Ring", "God of War", "GTA V", "The Witcher 3"];
                var prices = [19.99, 29.99, 39.99, 49.99, 59.99];
        
                var user = users[Math.floor(Math.random() * users.length)];
                var game = games[Math.floor(Math.random() * games.length)];
                var price = prices[Math.floor(Math.random() * prices.length)];
        
                addOrder(user, game, price);
            }, 5000); // Cập nhật mỗi 5 giây
        });
        </script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Lấy thẻ canvas
    var ctx = document.getElementById("chartjs-dashboard-pie").getContext("2d");

    // Hàm tạo dữ liệu ngẫu nhiên
    function generateRandomData(min, max) {
        return [
            Math.floor(Math.random() * (max - min) + min),
            Math.floor(Math.random() * (max - min) + min),
            Math.floor(Math.random() * (max - min) + min)
        ];
    }

    var randomData = generateRandomData(1000, 5000); // Sinh dữ liệu từ 1000 - 5000

    // Cập nhật số liệu trong bảng
    document.getElementById("chrome-count").textContent = randomData[0];
    document.getElementById("firefox-count").textContent = randomData[1];
    document.getElementById("ie-count").textContent = randomData[2];

    // Tạo biểu đồ Pie Chart
    new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Chrome", "Firefox", "IE"],
            datasets: [{
                data: randomData, // Dữ liệu ngẫu nhiên
                backgroundColor: ["#4285F4", "#FF5733", "#FFC107"], // Màu sắc Chrome, Firefox, IE
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom"
                }
            }
        }
    });
});

</script>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Sales ($)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: [
                            2115,
                            1562,
                            1584,
                            1892,
                            1587,
                            1923,
                            2566,
                            2448,
                            2805,
                            3438,
                            2917,
                            3327
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Chrome", "Firefox", "IE"],
                    datasets: [{
                        data: [4306, 3801, 1689],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("recentMovementChart").getContext("2d");

    // Hàm tạo dữ liệu ngẫu nhiên
    function generateRandomData(base, variance) {
        return Array.from({ length: 12 }, () => Math.floor(base + Math.random() * variance));
    }

    var randomData = generateRandomData(1500, 2000); // Sinh dữ liệu từ 1500 - 3500

    // Gradient màu nền cho biểu đồ
    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(56, 146, 252, 1)");
    gradient.addColorStop(1, "rgba(56, 146, 252, 0)");

    // Tạo biểu đồ line chart
    new Chart(ctx, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Recent Movement ($)",
                data: randomData, // Dữ liệu ngẫu nhiên
                fill: true,
                backgroundColor: gradient,
                borderColor: "#3794e8",
                borderWidth: 2,
                pointBackgroundColor: "#3794e8",
                pointRadius: 5,
                tension: 0.4,
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 500
                    },
                    grid: {
                        color: "#ddd",
                    }
                },
                x: {
                    grid: {
                        color: "#ddd",
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});

    </script>
    
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    var today = new Date(); // Lấy ngày hiện tại
    var defaultDate = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
    
    document.getElementById("datetimepicker-dashboard").flatpickr({
        inline: true,
        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        nextArrow: "<span title=\"Next month\">&raquo;</span>",
        defaultDate: defaultDate // Gán ngày hiện tại làm mặc định
    });
});

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\bbgame\BBgame\resources\views/menu/dashboard.blade.php ENDPATH**/ ?>