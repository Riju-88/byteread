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

$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$titleNextSort = ($sortBy === 'name_asc') ? 'name_desc' : 'name_asc';
$authorNextSort = ($sortBy === 'author_asc') ? 'author_desc' : 'author_asc';
$genreNextSort = ($sortBy === 'genre_asc') ? 'genre_desc' : 'genre_asc';
$favoriteNextSort = ($sortBy === 'favorite_asc') ? 'favorite_desc' : 'favorite_asc';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Books</title>

  <!-- favicon -->
  <?php include 'favicon.php'; ?>
  <link rel="stylesheet" href="css/output.css">

</head>

<body>
  <!-- Navigation -->
  <?php include 'navbar.php'; ?>

  <!-- alert -->
  <?php require 'alert.php'; ?>

  <div class="overflow-x-auto">
    <table class="table table-md">
      <thead>
        <tr class="bg-base-200">
          <th class="text-lg text-gray-300"><a
              href='display_library.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $favoriteNextSort; ?>'
              class="link">Favorite</a></th>
          <th class="text-lg text-gray-300">Cover</th>
          <th class="text-lg text-gray-300"><a
              href='display_library.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $titleNextSort; ?>'
              class="link">Title</a></th>
          <th class="text-lg text-gray-300"><a
              href='display_library.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $authorNextSort; ?>'
              class="link">Author</a></th>
          <th class="text-lg text-gray-300"><a
              href='display_library.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $genreNextSort; ?>'
              class="link">Genre</a></th>
          <th class="text-lg text-gray-300">Buy Online</th>
          <th class="text-lg text-gray-300">Remove from Library</th>
        </tr>
      </thead>
      <tbody>

        <?php
        require 'library_process.php'; // Include the logic file
        
        // Fetch the sorting option from the URL query parameter
        $sortBy = $_GET['sort'] ?? null;
        // Fetch all books from user's library
        $books = getAllLibbooks($sortBy);

        // Check if there are users to display
        if (!empty($books)) {


          foreach ($books as $book) {
            echo "<tr class='hover:bg-blue-800'>";

            // 
        
            // 
            // fav
            echo "<td>";
            if ($book->favorite == 0) {
              echo "<div class='avatar h-10 w-10'>
              <a href='update_fav_library.php?user_id=" . $user_id . "&book_id=" . $book->_id . "' class='text-center'>
            <img src='images/site/not_fav.png' class='h-5 w-5' alt='Not Favorite'/>
            </a>
          </div>
          ";

            }
            if ($book->favorite == 1) {
              echo "<div class='avatar h-10 w-10'>
              <a href='update_fav_library.php?user_id=" . $user_id . "&book_id=" . $book->_id . "' class='text-center'>
              <img src='images/site/fav.png' class='h-5 w-5 text-center' alt='Favorite'/>
            </a>
          </div>
          ";
            }

            echo "</td>";

            echo "<td>";
            echo "<div class='avatar'>";
            echo "<div class='w-16 rounded'>";
            // Assuming $book is the document retrieved from the MongoDB collection
            if (isset($book->cover_image_url)) {
              echo "<img src='{$book->cover_image_url}' alt='Cover Image'>";
            } else {
              echo "N/A"; // Display "N/A" if cover_image_url doesn't exist
            }
            echo "</div>";
            echo "</div>";
            echo "</td>";

            echo "<td class='font-bold'>{$book->title}</td>";
            echo "<td>{$book->author}</td>";
            echo "<td>{$book->genre}</td>";

            // if (isset($book->pdf_url)) {
            //   echo "<td><a href='{$book->pdf_url}' class='btn btn-primary' target='_blank'>View PDF</a></td>";
            // } else {
            //   echo "<td>N/A</td>"; // Display "N/A" if pdf_url doesn't exist
            // }
            // test buy links
            echo "<td><a href='https://www.amazon.com/s?k={$book->title}&nbsp;by&nbsp;{$book->author}' class='btn btn-primary' target='_blank'>Buy Online</a></td>";

            echo "<td><a href='delete_from_lib.php?user_id={$user_id}&book_id={$book->_id}' class='btn btn-error'>Remove</a></td>";

            echo "</>";
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