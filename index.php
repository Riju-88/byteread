<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}

require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB

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
  <title>ByteRead Home</title>
  <!-- favicon -->
  <?php include 'favicon.php'; ?>
  <link rel="stylesheet" href="css/output.css">
</head>

<body>
  <?php
  require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB
  ?>
  <!-- Navigation -->
  <?php include 'navbar.php'; ?>

  <!-- <div class='alert alert-info'>
        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='stroke-current shrink-0 w-6 h-6'>
            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>
        </svg>
        <span></span>
    </div> -->

  <!-- alert -->
  <?php require 'alert.php'; ?>

  <!-- hero section -->

  <div class="hero min-h-screen bg-opacity-50" style="background-image: url(images/site/bg.jpeg);">
    <div class="hero-overlay bg-opacity-80"></div>
    <div class="hero-content text-center text-neutral-content">
      <div class="max-w-screen-xl">
        <div class="flex flex-col items-center justify-center"><a href="index.php" ><img src="images/site/ByteRead.svg" alt="ByteRead Logo"
            class="h-20 mx-auto" /></a></div>
        <h1 class="mb-5 text-5xl font-bold">Welcome to ByteRead</h1>
        <p class="mb-5 text-2xl text-gray-100">ByteRead is a platform that caters to book lovers and literature
          enthusiasts, offering an online library curated to match individual reading preferences. It provides a
          convenient way to access a vast realm of stories right at your fingertips.</p>
        <a class="btn btn-primary" href="display_books.php">Explore Collection</a>
      </div>
    </div>
  </div>

  <div class="container mx-auto px-4 sm:px-6 lg:px-8 bg-gray-900">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 my-8  mb-8">
        <div class="card bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure>
            <img src="images/site/collection.jpeg" alt="ByteRead Book Collection" class="w-full h-48" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Build Your Collection</h2>
            <p>
              Explore a wide range of books across genres, from thrilling mysteries to heartwarming romances and
              everything in between. With ByteRead, you can easily add and remove books to your personal library,
              creating a curated collection that's uniquely yours.
            </p>
            <div class="card-actions">
              <a href="display_books.php" class="btn btn-primary">Explore Collection</a>
            </div>
          </div>
        </div>
      </div>

      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 my-8  mb-8">
        <div class="card bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure class="bg-slate-50">
            <img src="images/site/library.jpg" alt="Read Anywhere, Anytime" class="w-full" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Read Anywhere, Anytime</h2>
            <p>
              Dive into your favorite stories. Enjoy your favorite books without the need to wait for the perfect
              moment. ByteRead lets you read or download books from your library, so you can enjoy them on your PC,
              Android, or any other devices.

            </p>
            <div class="card-actions">
              <a href="display_library_grid.php?user_id=<?php echo $user_id; ?>" class="btn btn-primary">Go to
                Library</a>
            </div>
          </div>
        </div>
      </div>

      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 my-8  mb-8">
        <div class="card bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure class="bg-slate-50">
            <img src="images/site/manage_collection.jpeg" alt="Manage Collection" class="rounded-xl w-full h-48" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Manage Collection</h2>
            <p>Manage your library, add or remove books from your collection,
              manage favorites, search directly on Amazon for a physical copy.
            </p>
            <div class="card-actions">
              <a href='display_library.php?user_id=<?php echo $user_id; ?>' class="btn btn-primary">Add or Remove Books</a>
            </div>
          </div>
        </div>
      </div>
      <div class="w-full sm:w-1/2 lg:w-1/4 px-4 my-8  mb-8">
        <div class="card bg-base-100 shadow-xl hover:scale-105 transition duration-500">
          <figure class="bg-slate-50">
            <img src="images/site/about.jpeg" alt="Read Anywhere, Anytime" class="w-full" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">About ByteRead</h2>
            <p>
              Find more about ByteRead here.

            </p>
            <div class="card-actions">
              <a href="about.php" class="btn btn-primary">About</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>