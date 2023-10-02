<?php
require '../vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// MongoDB connection function
require '../connection.php';
// Create directories if they don't exist
function createDirectoriesIfNotExist()
{
    // Directory where PDFs and cover images should be stored in the parent directory
    $pdfDirectory = dirname(__DIR__) . '/pdfs'; // Go up one level from 'admin'
    $imageDirectory = dirname(__DIR__) . '/images'; // Go up one level from 'admin'

    // Check if the directories exist, and create them if not
    if (!file_exists($pdfDirectory)) {
        mkdir($pdfDirectory, 0777, true);
    }

    if (!file_exists($imageDirectory)) {
        mkdir($imageDirectory, 0777, true);
    }
}
// Update function
function updateBook(){
    $client = connectToMongoDB();
    $db = $client->mongoTestdb;
    $collection = $db->book_list;

    $id = trim($_POST["book_id"]);
    $title = trim($_POST["book_title"]);
    $author = trim($_POST["author"]);
    $genre = trim($_POST["genre"]);
    $coverImage = $_FILES["cover_image"];
    $pdfFile = $_FILES["pdf_file"];

    createDirectoriesIfNotExist();

    // Find the book by id
    $book = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    if ($book) {
        // Update the user's information
        $result = $collection->updateOne(
            ['_id' => $book->_id],
            [
                '$set' => [
                    'title' => $title,
                    'author' => $author,
                    'genre' => $genre,
                ],
            ]
        );

        if ($result->getModifiedCount() > 0) {

            $info = []; // Initialize an array to store messages

            $info[] = "Book updated successfully!";

            // Determine the absolute path to the parent directory
            $parentDirectory = __DIR__ . '/../';

            if ($pdfFile["error"] == UPLOAD_ERR_OK) {
                // Generate unique identifiers for file names
                $pdfFileName = uniqid() . '_' . '.pdf'; // Unique identifier for the PDF file name
                $pdfFileLocation = $parentDirectory . 'pdfs/' . $pdfFileName; // Absolute path to PDFs

                // Move the uploaded PDF to a directory
                if (move_uploaded_file($pdfFile['tmp_name'], $pdfFileLocation)) {
                    $result = $collection->updateOne(
                        ['_id' => $book->_id],
                        [
                            '$set' => [
                                'pdf_url' => 'pdfs/' . $pdfFileName
                            ],
                        ]
                    );

                    if ($result->getModifiedCount() > 0) {
                        $info[] = "PDF updated successfully!";
                    } else {
                        $info[] = "PDF update failed.";
                    }
                }
            }
            // move cover image here
            if ($coverImage["error"] == UPLOAD_ERR_OK) {
                // Generate a unique identifier for the cover image file name
                $coverImageFileName = uniqid() . '_' . '.jpg'; // Unique identifier for the cover image file name
                $coverImageLocation = $parentDirectory . 'images/' . $coverImageFileName; // Absolute path to cover images

                // Move the uploaded cover image to a directory
                if (move_uploaded_file($coverImage['tmp_name'], $coverImageLocation)) {
                    // Update the document with PDF and cover image URLs
                    $collection->updateOne(
                        ['_id' => $book->_id],
                        [
                            '$set' => [
                                'cover_image_url' => 'images/' . $coverImageFileName,
                            ]
                        ]
                    );
                    if ($result->getModifiedCount() > 0) {
                        $info[] = "Cover image updated successfully!";
                    } else {
                        $info[] = "Cover image upload failed.";
                    }
                }
            }
            $updatedBook = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

            $serializedResult = serialize($updatedBook);



            // print_r($serializedResult);

            $infoMessage = implode(" ", $info); // Concatenate messages into a single string

            header("Location: update_book.php?success=$infoMessage&book=$serializedResult");

        } else {
            header("Location: manage_book.php?error='No changes were made.'");
        }
    } else {
        // Book not found
        header("Location: manage_book.php?error='Book not found. Update failed.'");
    }

}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    updateBook();

}
?>