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
if (!isset($_GET['book'])) {
    // User is not logged in, redirect to the login page
    header("Location: manage_books.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>
    <link href="../css/output.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Navigation -->
   <?php include 'navbar.php'; ?>

    <!-- alert -->
 <?php require '../alert.php'; ?>

    <?php
    $encodedBook = $_GET['book'];
    
    // Unserialize the data
    $book = unserialize($encodedBook);
    
    ?>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row">
            
            <div class="mt-4">
                <h2 class="text-xl text-center font-semibold mb-2">Update Book</h2>
                <form action="update_process.php" method="post" enctype="multipart/form-data"
                    class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                    <div class="card-body">

                     <!-- book image -->

                        
                     <?php
                            // Check if the book has an image
                            if ($book->cover_image_url != null) {
                                // Display the user's image
                                echo '<div class="form-control"><img src="../' . $book->cover_image_url . '" alt="Cover Image" class="rounded-box h-24 w-24 mx-auto mb-4"></div>';
                            }
                            ?>
                            
                        <div class="form-control">
                            <label for="book_id" class="block font-semibold">Book ID:</label>

                            <input type="text" name="book_id" id="book_id" required placeholder="Book ID"
                                class="input input-bordered w-full" value=" <?php echo $book->_id; ?>" readonly>
                        </div>
                        <div class="form-control">
                            <label for="book_title" class="block font-semibold">Book Name:</label>

                            <input type="text" name="book_title" id="book_name" required placeholder="Book Name"
                                class="input input-bordered w-full" value=" <?php echo trim($book->title); ?>">
                        </div>
                        <div class="form-control">
                            <label for="author" class="block font-semibold">Author:</label>
                            <input type="text" name="author" id="author" required placeholder="Author"
                                class="input input-bordered w-full" value=" <?php echo trim($book->author); ?>">
                        </div>
                        <div class="form-control">
                            <label for="genre" class="block font-semibold">Genre:</label>
                            <input type="text" name="genre" id="genre" required placeholder="Genre"
                                class="input input-bordered w-full" value=" <?php echo trim($book->genre); ?>">
                        </div>
                        <div class="form-control">
                            <label for="pdf_file" class="block font-semibold">Upload PDF:</label>
                            <input type="file" name="pdf_file" id="pdf_file" accept=".pdf" 
                                class="file-input file-input-bordered file-input-primary w-full">
                        </div>
                        <div class="form-control">
                            <label for="cover_image" class="block font-semibold">Upload Cover Image:</label>
                            <input type="file" name="cover_image" id="cover_image" accept="image/*" 
                                class="file-input file-input-bordered file-input-primary w-full">
                        </div>
                        <div class="form-control mt-6">
                            <input type="submit" value="Update Book" class="btn btn-primary w-full">
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>


</body>

</html>