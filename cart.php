<?php
session_start();
include 'config/db.php';

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch product details from the database
    $result = $conn->query("SELECT * FROM products WHERE id=$product_id");
    $product = $result->fetch_assoc();

    if ($product) {
        $_SESSION['cart'][] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image']
        ];
        echo "<script>alert('Product added to cart!'); window.location='cart.php';</script>";
    }
}

// Handle Remove from Cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
            break;
        }
    }
    echo "<script>alert('Product removed from cart!'); window.location='cart.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - E-Shop</title>
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

    <!-- Cart Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Shopping Cart</h2>

        <?php if (!empty($_SESSION['cart'])): ?>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price (₹)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><img src="images/<?php echo $item['image']; ?>" width="80"></td>
                            <td><?php echo $item['name']; ?></td>
                            <td>₹<?php echo $item['price']; ?></td>
                            <td><a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <h4 class="text-center">Your cart is empty!</h4>
        <?php endif; ?>
    </div>

</body>

</html>