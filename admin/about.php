<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['admin'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}

require '../vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// Unserialize the user object
$admin = unserialize($_SESSION['admin']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>
    <link rel="stylesheet" href="../css/output.css">
</head>
<body>

<!-- Navigation -->
<?php include 'navbar.php'; ?>

<!-- alert -->
<?php require '../alert.php'; ?>

  <!-- Hero Section -->
<div class="hero min-h-screen bg-base-200 flex items-center justify-center">
  <div class="hero-content text-center">
    <div class="max-w-screen-xl mx-auto bg-base-100 p-6 rounded-lg shadow-lg">
      <h1 class="text-5xl font-bold">About ByteRead</h1>
    
      <p class="py-4 text-left">
       ByteRead admin panel is a management panel for ByteRead web library. 

This panel does the overall management of ByteRead. It can do the task of adding new book to the database. Update or delete any book from the database. View or delete users etc. 

      </p>
      <p class="py-4 font-bold">
        Note: All the books distributed on this website is for educational purposes only. These books may also be available on other online sources for free.
      </p>
      <p class="py-4 font-bold">
        Source Code of this project can be found on my github page: <a href="https://github.com/byte-read/ByteRead">https://github.com/byte-read/ByteRead</a>
      </p>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>
</body>
</html>
