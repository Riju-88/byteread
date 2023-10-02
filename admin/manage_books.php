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
<?php
 
 $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$titleNextSort = ($sortBy === 'name_asc') ? 'name_desc' : 'name_asc';
$authorNextSort = ($sortBy === 'author_asc') ? 'author_desc' : 'author_asc';
$genreNextSort = ($sortBy === 'genre_asc') ? 'genre_desc' : 'genre_asc';

 require 'manage_books_process.php'; // Include the logic file
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>
    <link href="../css/output.css" rel="stylesheet" type="text/css" />

</head>
<body>
    
<!-- Navigation -->
<?php include 'navbar.php'; ?>

 <!-- alert -->
 <?php require '../alert.php'; ?>

  <div class="overflow-x-auto">
    <table class="table table-sm">
      <thead>
        <tr class="bg-base-200">
          <th class="text-lg text-gray-300">Cover</th>
          <th class="text-lg text-gray-300"><a href='manage_books.php?sort=<?php echo $titleNextSort; ?>'
              class="link">Title</a></th>
          <th class="text-lg text-gray-300"><a href='manage_books.php?sort=<?php echo $authorNextSort; ?>'
              class="link">Author</a></th>
          <th class="text-lg text-gray-300"><a href='manage_books.php?sort=<?php echo $genreNextSort; ?>'
              class="link">Genre</a></th>
          <th class="text-lg text-gray-300">Update</th>
          <th class="text-lg text-gray-300">Delete</th>
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
                        <img src='../{$book->cover_image_url}' alt='{$book->title}'>
                      </div>
                      </div>
                    </td>";
            } else {
              echo "<td>---</td>";
            }
            echo "<td>$book->title</td>";
            echo "<td>$book->author</td>";
            echo "<td>$book->genre</td>";
            $book_str = serialize($book);
            echo "<td><a class='btn btn-primary' href='update_book.php?book=$book_str'>Update</a></td>";
            // echo "<td><a class='btn btn-primary' href='print.php?book=$book_str'>Update</a></td>";

            echo "<td><a class='btn btn-error' href='delete_book.php?book=$book_str'>Delete</a></td>";
           
            echo "</td>";
          }
        } else {
          echo "<p>No books found.</p>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>