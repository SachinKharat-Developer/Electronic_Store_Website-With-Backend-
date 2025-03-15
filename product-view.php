<?php
session_start();
include 'config/db.php';

// Check if the product ID is set in the URL
if (!isset($_GET['id'])) {
    echo "<script>alert('Product not found!'); window.location='products.php';</script>";
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");

// If product not found, redirect to products page
if ($result->num_rows == 0) {
    echo "<script>alert('Product not found!'); window.location='products.php';</script>";
    exit();
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - E-Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
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
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
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

<!-- Product Details Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="images/<?php echo $product['image']; ?>" class="img-fluid rounded shadow" alt="Product Image">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold"><?php echo $product['name']; ?></h2>
            <h4 class="text-primary">₹<?php echo $product['price']; ?></h4>
            <p class="text-secondary"><?php echo $product['description']; ?></p>

            <!-- Add to Cart Button -->
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <button type="submit" class="btn btn-success">🛒 Add to Cart</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
