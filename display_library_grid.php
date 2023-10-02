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
    <title>User Library</title>

     <!-- favicon -->
  <?php include 'favicon.php'; ?>
    <link rel="stylesheet" href="css/output.css">

</head>

<body class="bg-gray-950">
    <!-- Navigation -->
    <?php include 'navbar.php'; ?>

    <!-- alert -->
    <?php require 'alert.php'; ?>

<div class="w-full mt-6 px-4 flex justify-end">

<div class="join join-vertical lg:join-horizontal px-2">
 <a href='display_library_grid.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $titleNextSort; ?>' class="btn join-item btn-primary btn-outline">Title</a>
    <a href='display_library_grid.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $authorNextSort; ?>' class="btn join-item btn-primary btn-outline">Author</a>
</div>

 <div class="join join-vertical lg:join-horizontal">
    <?php if (isset($favoriteNextSort)) { ?>
        <a href='display_library_grid.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $favoriteNextSort; ?>' class="btn join-item btn-primary btn-outline">Favorite</a>
    <?php } ?>
   
    <a href='display_library_grid.php?user_id=<?php echo $user_id; ?>&sort=<?php echo $genreNextSort; ?>' class="btn join-item btn-primary btn-outline">Genre</a>
</div>

</div>


    <!-- sort options -->



    <?php
    require 'library_process.php'; // Include the logic file
    
    // Fetch the sorting option from the URL query parameter
    $sortBy = $_GET['sort'] ?? null;

    // Fetch all books from the user's library
    $books = getAllLibbooks($sortBy);

    // Check if there are books to display
    if (!empty($books)) {
        echo '<div class="container mx-auto px-4 mt-6 sm:px-6 lg:px-8">';
        echo '<div class="flex flex-wrap -mx-4">';

        foreach ($books as $book) {
            echo '<div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">';
            echo '<div class="card card-compact bg-base-100 shadow-xl hover:scale-105 transition duration-500">';

            // Assuming $book is the document retrieved from the MongoDB collection
            echo '<figure class="px-10 pt-10">';

            if (isset($book->cover_image_url)) {
                echo "<img src='{$book->cover_image_url}' alt='Cover Image' class='rounded-xl' />";
            } else {
                echo 'N/A'; // Display "N/A" if cover_image_url doesn't exist
            }

            echo '</figure>';
            echo '<div class="card-body items-center text-center">';

            // favorite icon here
            echo "<td>";
            if ($book->favorite == 0) {
                echo "<div class='avatar h-10 w-10'>
              <a href='update_fav_library.php?user_id=" . $user_id . "&book_id=" . $book->_id . "&redirect=lib_grid' class='text-center'>
            <img src='images/site/not_fav.png' class='h-5 w-5' alt='Not Favorite'/>
            </a>
          </div>
          ";

            }
            if ($book->favorite == 1) {
                echo "<div class='avatar h-10 w-10'>
              <a href='update_fav_library.php?user_id=" . $user_id . "&book_id=" . $book->_id . "&redirect=lib_grid' class='text-center'>
              <img src='images/site/fav.png' class='h-5 w-5 text-center' alt='Favorite'/>
            </a>
          </div>
          ";
            }

            echo "</td>";

            // title here
            echo "<h2 class='text-xl font-bold'>{$book->title}</h2>";

            // author here
            echo "<h2 class='italic'>{$book->author}</h2>";

            // genre isolation logic here
            $genres = explode(',', $book->genre);

            echo '<div class="flex flex-wrap space-x-2 max-w-xs">';

            foreach ($genres as $genre) {
                echo "<span class='badge badge-outline badge-primary mb-2'>$genre</span>";
            }

            echo '</div>';

            if (isset($book->pdf_url)) {
                echo "<div class='card-actions'>";
                echo "<a href='{$book->pdf_url}' class='btn btn-primary' target='_blank'>View PDF</a>";
                echo "</div>";
            } else {
                echo "<div class='card-actions'>";
                echo "<button class='btn btn-primary disabled'>N/A</button>";
                echo "</div>"; // Display "N/A" if pdf_url doesn't exist
            }


            echo "</div>";

            echo '</div>'; // Close the card
            echo '</div>'; // Close the column
        }

        echo '</div>'; // Close the flex container
        echo '</div>'; // Close the container
    } else {
        echo "<p>No books found.</p>";
    }
    ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>