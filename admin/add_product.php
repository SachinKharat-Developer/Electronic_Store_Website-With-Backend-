<?php
session_start();
include '../config/db.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    echo "<script>alert('Access Denied! Please login as Admin.'); window.location='admin_login.php';</script>";
    exit();
}

// Handle Product Addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image Upload Handling
    $image = $_FILES['image']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO products (name, price, image, description) VALUES ('$name', '$price', '$image', '$description')";
        if ($conn->query($sql)) {
            echo "<script>alert('Product Added Successfully!'); window.location='manage_products.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading image.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Add New Product</h2>
    <form method="post" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price (₹)</label>
            <input type="number" class="form-control" name="price" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file" class="form-control" name="image" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success w-100">Add Product</button>
    </form>
</div>

</body>
</html>
