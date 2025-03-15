<?php
session_start();
include 'config/db.php';

if (!isset($_GET['order_id'])) {
    echo "<script>alert('Invalid Order!'); window.location='index.php';</script>";
    exit();
}

$order_id = $_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container text-center mt-5">
    <h2 class="text-success">🎉 Order Placed Successfully!</h2>
    <p>Your Order ID: <strong>#<?php echo $order_id; ?></strong></p>
    <a href="products.php" class="btn btn-primary">Continue Shopping</a>
</div>

</body>
</html>
