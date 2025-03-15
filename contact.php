<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - E-Shop</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
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


  <!-- Contact Us Section -->
  <div class="container mt-5">
    <h1 class="text-center mb-4">Contact Us</h1>

    <!-- Contact Info -->
    <div class="row">
      <div class="col-md-6">
        <h4>Our Contact Information</h4>
        <p><strong>Address:</strong> 123 E-Shop Street, Ahmedabad , Gujarat</p>
        <p><strong>Phone:</strong> +91 8200028072 </p>
        <p><strong>Email:</strong> support@eshop.com</p>
      </div>

      <div class="col-md-6">
        <h4>Get in Touch</h4>
        <form id="contactForm" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="error-message" class="text-danger mt-3 d-none">
          Please fill out all fields.
        </div>
      </div>
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
    <div class="social-icons mt-3">
      <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
      <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
    </div>
  </div>
</footer>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/scripts.js"></script>
</body>
</html>
