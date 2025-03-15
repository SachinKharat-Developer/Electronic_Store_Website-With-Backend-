<?php
session_start();
include 'config/db.php';

// Check if search query is set
if (!isset($_GET['query'])) {
    echo "<script>alert('Please enter a search term!'); window.location='index.php';</script>";
    exit();
}

$search_term = $_GET['query'];
$search_term = "%{$search_term}%"; // For partial match search

// Search in the database
$query = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $search_term, $search_term);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
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
                <li class="nav-item"><a class="nav-link" href="products.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
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


<div class="container mt-5">
    <h2>Search Results for "<?php echo htmlspecialchars($_GET['query']); ?>"</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-3">
                    <div class="card shadow-sm mb-4">
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
    <?php else: ?>
        <h4 class="text-center text-danger">No products found!</h4>
    <?php endif; ?>
</div>

</body>
</html>
