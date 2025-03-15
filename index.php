<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Electro-Hub </title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


</head>

<body>
  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">E-Shop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
          <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="my-orders.php">My Orders</a></li>
          <!-- Add Login / Logout Link Here -->
          <li class="nav-item">
            <?php session_start(); ?>
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

  <!-- Carousel -->
  <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/slider-1.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">

        </div>
      </div>
      <div class="carousel-item">
        <img src="images/slider-2.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">

        </div>
      </div>
      <div class="carousel-item">
        <img src="images/slider-3.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">

        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Shop by Category -->
  <section class="container mt-5">
    <h2 class="text-center mb-4">Shop by Category</h2>
    <div class="row g-4">
      <!-- Category 1 -->
      <div class="col-md-4">
        <div class="card">
          <img src="images/Gaming.png" class="card-img-top" alt="Electronics" style="height: 200px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title">Gaming Consoles</h5>
            <a href="products.php" class="btn btn-primary">Shop now</a>
          </div>
        </div>
      </div>
      <!-- Category 2 -->
      <div class="col-md-4">
        <div class="card">
          <img src="images/Home-appliance.png" class="card-img-top" alt="Fashion"
            style="height: 200px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title">Home Appliances</h5>
            <a href="products.php" class="btn btn-primary">Shop Now</a>
          </div>
        </div>
      </div>
      <!-- Category 3 -->
      <div class="col-md-4">
        <div class="card">
          <img src="images/wearables.png" class="card-img-top" alt="Home Appliances"
            style="height: 200px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title">Wearable Technology</h5>
            <a href="products.php" class="btn btn-primary">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  include 'config/db.php';  // Include database connection
  $result = $conn->query("SELECT * FROM products LIMIT 8"); // Fetch only 8 products
  ?>

  <div class="container mt-5">
    <h1 class="text-center mb-4">Featured Products</h1>
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
    <div class="text-center">
      <a href="products.php" class="btn btn-outline-primary">View All Products</a>
    </div>
  </div>


  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-4">
    <div class="container">
      <p class="mb-2">&copy; 2025 <strong>E-Shop</strong>. All Rights Reserved.</p>
      <p class="mb-0">
        <a href="#" class="text-white text-decoration-underline me-3">Terms & Conditions</a>
        <a href="#" class="text-white text-decoration-underline">Privacy Policy</a>
      </p>

    </div>
  </footer>

  <!-- Scroll to Top Button -->
  <button id="scrollToTopBtn" class="btn btn-primary position-fixed bottom-3 end-3 d-none" title="Back to Top">
    &#8679;
  </button>

  <!-- JavaScript -->
  <script defer>
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // Show button when scrolling down
    window.addEventListener('scroll', () => {
      if (window.scrollY > 200) {
        scrollToTopBtn.classList.remove('d-none');
      } else {
        scrollToTopBtn.classList.add('d-none');
      }
    });

    // Smooth scroll to top
    scrollToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth',
      });
    });


    function updateCartCount() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const totalCount = cart.reduce((count, item) => count + item.quantity, 0);
      document.getElementById('cart-count').textContent = totalCount;
    }

    // Run this when the page loads
    document.addEventListener('DOMContentLoaded', updateCartCount);
  </script>




  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts.js" defer></script>

</body>

</html>