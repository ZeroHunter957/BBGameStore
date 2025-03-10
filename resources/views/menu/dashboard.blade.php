@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="wrapper">
        <div class="container-fluid p-4 bg-light rounded shadow-sm">
            <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

            <div class="row">
                <!-- Total User Accounts -->
                <div class="col-md-6">
                    <div class="card p-3 shadow-sm">
                        <h5 class="card-title">Total Users</h5>
                        <h1 class="stat-number">{{ $totalUsers }}</h1>
                        <span class="text-success">+{{ $recentUsers }} new accounts this month</span>
                    </div>
                </div>

                <!-- Games Bought Recently -->
                <div class="col-md-6">
                    <div class="card p-3 shadow-sm">
                        <h5 class="card-title">Recent Purchases</h5>
                        <h1 class="stat-number">{{ $recentPurchases }}</h1>
                        <span class="text-success">Games bought in the last 7 days</span>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <!-- Total Revenue -->
                <div class="col-md-6">
                    <div class="card p-3 shadow-sm">
                        <h5 class="card-title">Total Revenue</h5>
                        <h1 class="stat-number">{{ number_format($totalRevenue, 0) }}₫</h1>
                        <span class="text-muted">All-time revenue from sales</span>
                    </div>
                </div>

                <!-- Monthly Revenue -->
                <div class="col-md-6">
                    <div class="card p-3 shadow-sm">
                        <h5 class="card-title">Revenue This Month</h5>
                        <h1 class="stat-number">{{ number_format($currentMonthRevenue, 0) }}₫</h1>
                        <span class="text-success">Revenue generated in {{ date('F') }}</span>
                    </div>
                </div>
            </div>

            <!-- Monthly Sales Chart -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">📊 Monthly Sales</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Chart -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">💰 Monthly Revenue</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Number of Games in Each Category -->
            <div class="row mt-3">
                @foreach ($gamecates as $category => $count)
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm">
                            <h5 class="card-title">{{ $category }}</h5>
                            <h1 class="stat-number">{{ $count }}</h1>
                            <span class="text-muted">Total games in this category</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Chart.js for Monthly Sales & Revenue -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sales Chart
            var salesCtx = document.getElementById("salesChart").getContext("2d");
            new Chart(salesCtx, {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Sales",
                        data: {!! $salesData !!}, // Inject PHP data as JSON
                        backgroundColor: "#4285F4"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Revenue Chart
            var revenueCtx = document.getElementById("revenueChart").getContext("2d");
            new Chart(revenueCtx, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Revenue (VND)",
                        data: {!! $revenueData !!}, // Inject PHP data as JSON
                        backgroundColor: "rgba(52, 168, 83, 0.5)",
                        borderColor: "#34A853",
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('vi-VN').format(value) + "₫";
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
