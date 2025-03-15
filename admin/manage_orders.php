<?php
session_start();
include '../config/db.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    echo "<script>alert('Access Denied! Please login as Admin.'); window.location='admin_login.php';</script>";
    exit();
}

// Fetch all orders
$result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");

// Handle Order Status Update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    echo "<script>alert('Updating Order ID: $order_id to $new_status');</script>"; // Debugging

    $update_query = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_status, $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order status updated!'); window.location='manage_orders.php';</script>";
    } else {
        echo "<script>alert('Error updating order: " . $conn->error . "');</script>";
    }
}


// Handle Order Deletion
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    $conn->query("DELETE FROM orders WHERE id=$order_id");
    echo "<script>alert('Order deleted!'); window.location='manage_orders.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <!--  Nav-Bar -->

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="manage_products.php">Manage Products</a></li>
                <li class="nav-item"><a class="nav-link active" href="manage_orders.php">Manage Orders</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>



    <div class="container mt-5">
        <h2 class="text-center">Manage Orders</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Payment Mode</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $result->fetch_assoc()): ?>

                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td>₹<?php echo $order['total_price']; ?></td>
                        <td><?php echo $order['payment_mode']; ?></td>
                        <td>
                        <form method="post" onsubmit="alert('Form submitted!');">

        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
        <select name="status" class="form-select">
            <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
            <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
            <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
        <button type="submit" name="update_status" class="btn btn-primary btn-sm mt-2">Update</button>
    </form>
</td>


                        <td>
                            <a href="manage_orders.php?delete=<?php echo $order['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>