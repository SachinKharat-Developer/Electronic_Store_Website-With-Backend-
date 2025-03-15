<?php
session_start();
include('../config/db.php'); // Database connection
include('includes/header.php'); // Admin header

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php'); // Redirect if not logged in
    exit();
}

$query = "SELECT orders.*, users.name AS user_name FROM orders JOIN users ON orders.user_id = users.id ORDER BY orders.id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h2 class="mb-4">Orders Management</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td>₹<?php echo number_format($row['total_price'], 2); ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="view-order.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                        <a href="delete-order.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
