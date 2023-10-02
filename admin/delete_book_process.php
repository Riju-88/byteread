<?php
require '../vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// MongoDB connection function 
require '../connection.php';

function deleteBook()
{
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 
    $bookListCollection = $db->book_list;
    $bookLibraryCollection = $db->book_library;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $book_id = trim($_POST["book_id"]); // Trim to remove any leading/trailing whitespace

        $messages = [];

        // Get the book from the book_list collection
        $book = $bookListCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($book_id)]);

        if (!unlink("../".$book["cover_image_url"])) {
            $messages[] = "Image not deleted.";
        }
        else {
            $messages[] = "Image deleted.";
        }

        if (!unlink("../".$book["pdf_url"])) {
            $messages[] = "PDF not deleted.";
        }
        else {
            $messages[] = "PDF deleted.";
        }
        // Attempt to delete the book from the book_list collection
        $resultBookList = $bookListCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($book_id)]);
        // Attempt to delete all occurrences of the book from the book_library collection based on the "book_id" field
        $resultBookLibrary = $bookLibraryCollection->deleteMany(['book_id' => $book_id]);

        
        if ($resultBookList->getDeletedCount() > 0) {
            $messages[] = "Book deleted successfully.";
        }

        if ($resultBookLibrary->getDeletedCount() > 0) {
            $messages[] = "Book also removed from user library.";
        }

        if (!empty($messages)) {
            $successMessage = "success='" . implode(" ", $messages) . "'";
            header("Location: manage_books.php?$successMessage");
        } else {
            header("Location: manage_books.php?error='Could not delete book. Something went wrong.'");
        }
    }
}


deleteBook();
?>