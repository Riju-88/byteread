<?php
session_start();
if (!isset($_SESSION['user'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}
// Check if the user is logged in
// Verify if $_SESSION['user'] contains the expected structure
require 'vendor/autoload.php';
// Unserialize the user object
$user = unserialize($_SESSION['user']);

// Now you can access properties of $user, such as $user->_id
$user_id = $user->_id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/output.css">
</head>
<body>

<!-- Navigation -->
<?php include 'navbar.php'; ?>

<!-- alert -->
<?php require 'alert.php'; ?>

  <!-- Hero Section -->
<div class="hero min-h-screen bg-base-200 flex items-center justify-center">
  <div class="hero-content text-center">
    <div class="max-w-screen-xl mx-auto bg-base-100 p-6 rounded-lg shadow-lg">
      <h1 class="text-5xl font-bold">About ByteRead</h1>
    
      <p class="py-4 text-left">
       ByteRead is a web library created by me. I built this project as a way to both enhance my skills with MongoDB and provide a valuable tool for book enthusiasts like you.

This app simplifies the process of managing your book collection. You have the power to add, remove, or organize your books effortlessly. Feel free to mark your favorites for quick access. Plus, you can easily read books online or download them for offline reading. And if you ever prefer a physical copy, there is an option to quickly search it up on Amazon.

This project reflects my commitment to continuous learning, and I'm thrilled to share it with you. Your support and feedback are essential in making this web library app even better. Enjoy exploring your virtual bookshelf!
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
