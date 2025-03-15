<?php
session_start();
include 'config/db.php';

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty!'); window.location='products.php';</script>";
    exit();
}

// Handle Order Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_mode = $_POST['payment_mode'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; // If user is not logged in, assign 0

    // Calculate total price
    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'];
    }

    // Insert order into the database
    $sql = "INSERT INTO orders (user_id, total_price, status) VALUES ('$user_id', '$total_price', 'Pending')";
    if ($conn->query($sql)) {
        $order_id = $conn->insert_id; // Get the last inserted order ID

        // Clear cart after successful order placement
        unset($_SESSION['cart']);

        echo "<script>alert('Order placed successfully!'); window.location='order-confirmation.php?order_id=$order_id';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - E-Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">E-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <form class="d-flex" action="search.php" method="GET">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search for products..." required>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link active" href="cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="my-orders.php">My Orders</a></li>

                    <!-- Login/Logout System -->
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a class="nav-link" href="logout.php">Logout (<?php echo $_SESSION['user_name']; ?>)</a>
                        <?php else: ?>
                            <a class="nav-link" href="login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Checkout Form -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Checkout</h2>

        <form method="post" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Payment Mode</label>
                <select class="form-control" name="payment_mode" required>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Paytm">Paytm</option>
                    <option value="Credit Card">Credit Card</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Place Order</button>
        </form>
    </div>

</body>

</html>