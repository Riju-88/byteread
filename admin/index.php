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
  <title>ByteRead Admin</title>
     <!-- favicon -->
     <?php include 'favicon.php'; ?>
  <link href="../css/output.css" rel="stylesheet" type="text/css" />

</head>

<body class="bg-gray-900">

<!-- Navigation -->
<?php include 'navbar.php'; ?>

    <!-- alert -->
 <?php require '../alert.php'; ?>

  <div class="container mx-auto px-4 sm:px-6 lg:px-8 bg-gray-900">
    <div class="flex flex-wrap -mx-4">

      <!-- Repeat this block for each card -->
      
      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 my-8 mb-8">
        <div class="card card-compact bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          
          <figure class="bg-slate-50">
            
            <img src="../images/site/add_book.png" alt="Shoes"
              class="w-40 h-full" />
          </figure>
          
          <div class="card-body items-center text-center">
            
            <h2 class="card-title">Add new book</h2>
           
            <p class="text-white-300">Add a new book in the database</p>
            <div class="card-actions">
              <a class="btn btn-primary" href="add_book.php">Add Book</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Repeat this block for each card -->
      <div class="w-full sm:w-1/2 lg:w-1/4 my-8 px-4 mb-8">
        <div class="card card-compact bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure>
            <img src="../images/site/collection.jpeg" alt="Shoes"
              class="w-full h-32" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Manage Books</h2>
            <p>View, update or delete books from the database</p>
            <div class="card-actions">
              <a class="btn btn-primary" href="manage_books.php">Manage Books</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Repeat this block for each card -->
      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 my-8  mb-8">
        <div class="card bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure class="px-10 pt-10 bg-slate-50">
            <img src="../images/site/multiple-users.png" alt="Shoes"
              class="rounded-xl w-24 h-24" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Manage All Users</h2>
            <p>View or delete users from the database</p>
            <div class="card-actions">
              <a href="manage_users.php" class="btn btn-primary">Manage Users</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Repeat this block for each card -->
      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
        <div class="card bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure class="px-10 pt-10">
            <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes"
              class="rounded-xl" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Shoes!</h2>
            <p>If a dog chews shoes whose shoes does he choose?</p>
            <div class="card-actions">
              <button class="btn btn-primary">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Repeat this block for each card -->
      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
        <div class="card bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure class="px-10 pt-10">
            <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes"
              class="rounded-xl" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Shoes!</h2>
            <p>If a dog chews shoes whose shoes does he choose?</p>
            <div class="card-actions">
              <button class="btn btn-primary">Buy Now</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    </div>
  </div>













</body>

</html>