<?php
session_start();
include 'config/db.php';

// Fetch all products from the database
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - E-Shop</title>
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
                    <form class="d-flex" action="search.php" method="GET">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search for products..." required>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="products.php">Products</a></li>
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

    <!-- Products Section -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Our Products</h1>
        <div class="row">
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <img src="images/<?php echo $product['image']; ?>" class="card-img-top img-fluid" alt="Product Image">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text">₹<?php echo $product['price']; ?></p>
                            <a href="product-view.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>

</html>