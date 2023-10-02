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
    <title>Add New Book</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>
    <link href="../css/output.css" rel="stylesheet" type="text/css" />
  
</head>
<body>

   <!-- Navigation -->
   <?php include 'navbar.php'; ?>

<!-- alert -->
<?php require '../alert.php'; ?>

  
<div class="hero min-h-screen bg-base-200">
  <div class="hero-content flex-col lg:flex-row">
    <div class="text-center lg:text-left">
     
    </div>
    <div class="mt-4">
      
      <form action="add_book_process.php" method="post" enctype="multipart/form-data" class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        <div class="card-body">
          <h2 class="text-xl font-semibold mb-2 text-center">Add New Book</h2>
          <div class="form-control">
            <label for="book_name" class="block font-semibold">Book Name:</label>
            <input type="text" name="book_name" id="book_name" required placeholder="Book Name" class="input input-bordered w-full">
          </div>
          <div class="form-control">
            <label for="author" class="block font-semibold">Author:</label>
            <input type="text" name="author" id="author" required placeholder="Author" class="input input-bordered w-full">
          </div>
          <div class="form-control">
            <label for="genre" class="block font-semibold">Genre:</label>
            <input type="text" name="genre" id="genre" required placeholder="Genre" class="input input-bordered w-full">
          </div>
          <div class="form-control">
            <label for="pdf_file" class="block font-semibold">Upload PDF:</label>
            <input type="file" name="pdf_file" id="pdf_file" accept=".pdf" required class="file-input file-input-bordered file-input-primary w-full">
          </div>
          <div class="form-control">
            <label for="cover_image" class="block font-semibold">Upload Cover Image:</label>
            <input type="file" name="cover_image" id="cover_image" accept="image/*" required class="file-input file-input-bordered file-input-primary w-full">
          </div>
          <div class="form-control mt-6">
            <input type="submit" value="Add Book" class="btn btn-primary w-full">
          </div>
        </div>
      </form>
    </div>
   
  </div>
</div>


</body>
</html>
