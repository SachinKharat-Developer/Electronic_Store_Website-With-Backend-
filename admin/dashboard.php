<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    echo "<script>alert('Access Denied! Please login as Admin.'); window.location='admin_login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: #343a40;
            padding: 20px;
            color: white;
            transition: 0.3s ease-in-out;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 40px;
        }
        .card {
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        /* Responsive Sidebar */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                width: 250px;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s ease-in-out;
            }
            .sidebar.active {
                left: 0;
            }
            .content {
                margin-left: 0;
            }
            .menu-btn {
                position: fixed;
                top: 15px;
                left: 15px;
                background: #343a40;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                z-index: 1100;
            }
        }
    </style>
</head>
<body>

<!-- Mobile Menu Button -->
<button class="menu-btn d-md-none" onclick="toggleSidebar()">☰ Menu</button>

<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3>Admin Panel</h3>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="manage_products.php">🛒 Manage Products</a>
        <a href="manage_orders.php">📦 Manage Orders</a>
        <a href="logout.php" class="bg-danger text-white">🚪 Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1 class="text-center mb-4">Welcome to Admin Dashboard</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card p-4 shadow text-center">
                    <h3>🛍️ Manage Products</h3>
                    <p>Add, Edit, and Delete Products</p>
                    <a href="manage_products.php" class="btn btn-primary">Go to Products</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow text-center">
                    <h3>📦 Manage Orders</h3>
                    <p>View and Update Orders</p>
                    <a href="manage_orders.php" class="btn btn-primary">Go to Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
    }
</script>

</body>
</html>
