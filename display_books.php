<?php
session_start();
if (!isset($_SESSION['user'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}
require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB
// Check if the user is logged in
// Verify if $_SESSION['user'] contains the expected structure

// Unserialize the user object
$user = unserialize($_SESSION['user']);

// Now you can access properties of $user, such as $user->_id
$user_id = $user->_id;


$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$titleNextSort = ($sortBy === 'name_asc') ? 'name_desc' : 'name_asc';
$authorNextSort = ($sortBy === 'author_asc') ? 'author_desc' : 'author_asc';
$genreNextSort = ($sortBy === 'genre_asc') ? 'genre_desc' : 'genre_asc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Books</title>
  <!-- #1820c0 -->

   <!-- favicon -->
   <?php include 'favicon.php'; ?>
  <link rel="stylesheet" href="css/output.css">

</head>

<body>


  <!-- Navigation -->
  <?php include 'navbar.php'; ?>

  <!--  -->
  <?php
 
  require 'display_books_process.php'; // Include the logic file
  ?>

 <!-- alert -->
 <?php require 'alert.php'; ?>

  <div class="overflow-x-auto">
    <table class="table table-sm">
      <thead>
        <tr class="bg-base-200">
          <th class="text-lg text-gray-300">Cover</th>
          <th class="text-lg text-gray-300"><a href='display_books.php?sort=<?php echo $titleNextSort; ?>'
              class="link">Title</a></th>
          <th class="text-lg text-gray-300"><a href='display_books.php?sort=<?php echo $authorNextSort; ?>'
              class="link">Author</a></th>
          <th class="text-lg text-gray-300"><a href='display_books.php?sort=<?php echo $genreNextSort; ?>'
              class="link">Genre</a></th>
          <th class="text-lg text-gray-300">Add to Library</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Fetch the sorting option from the URL query parameter
        $sortBy = $_GET['sort'] ?? null;

        // Fetch books based on the sorting option
        $books = getAllbooks($sortBy); // Pass $sortBy as an argument
        
        // Check if there are books to display
        if (!empty($books)) {
          foreach ($books as $book) {
            echo "<tr class='hover:bg-blue-800'>";

            if ($book->cover_image_url != null) {
              echo "<td>
                      <div class='avatar'>
                      <div class='w-16 rounded'>
                        <img src='{$book->cover_image_url}' alt='{$book->title}'>
                      </div>
                      </div>
                    </td>";
            } else {
              echo "<td>---</td>";
            }
            echo "<td class='font-bold'>{$book->title}</td>";
            echo "<td>{$book->author}</td>";
            echo "<td>{$book->genre}</td>";
            echo "<td><a href='add_to_lib.php?user_id={$user_id}&book_id={$book->_id}'><button class='btn btn-primary'>Add to Library</button></a></td>";
            // to be implemented "add to fav"
            // to be implemented "wishlist/owned"
            echo "</td>";
          }
        } else {
          echo "<p>No books found.</p>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Footer -->
  <?php include 'footer.php'; ?>
</body>

</html>