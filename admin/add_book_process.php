<?php
require '../vendor/autoload.php';

// Function to create directories if they don't exist
// Function to create directories if they don't exist in the parent directory of 'admin'
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


// MongoDB connection function
require '../connection.php';

// Function to add a book with PDF and cover image upload
function addBookWithPDFAndImage($bookName, $author, $genre, $pdfFile, $coverImage)
{
    createDirectoriesIfNotExist(); // Create directories if they don't exist

    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 

    // Check if the book already exists
    $collection = $db->book_list;
    $existingBook = $collection->findOne(['title' => $bookName]);

    if ($existingBook) {
        return "<h2>This book already exists.</h2><h2><a href='index.php'>Add a new book</a></h2><h2><a href='logout.php'>Logout</a></h2>";
    }

    // Insert the book data into the database
    $result = $collection->insertOne([
        'title' => $bookName,
        'author' => $author,
        'genre' => $genre,
    ]);

    if ($result->getInsertedCount() > 0) {
        // Determine the absolute path to the parent directory
        $parentDirectory = __DIR__ . '/../';

        // Generate unique identifiers for file names
        $pdfFileName = $result->getInsertedId() . '.pdf'; // Unique identifier for the PDF file name
        $pdfFileLocation = $parentDirectory . 'pdfs/' . $pdfFileName; // Absolute path to PDFs

        // Move the uploaded PDF to a directory
        if (move_uploaded_file($pdfFile['tmp_name'], $pdfFileLocation)) {
            // Generate a unique identifier for the cover image file name
            $coverImageFileName = $result->getInsertedId() . '.jpg'; // Unique identifier for the cover image file name
            $coverImageLocation = $parentDirectory . 'images/' . $coverImageFileName; // Absolute path to cover images

            // Move the uploaded cover image to a directory
            if (move_uploaded_file($coverImage['tmp_name'], $coverImageLocation)) {
                // Update the document with PDF and cover image URLs
                $collection->updateOne(
                    ['_id' => $result->getInsertedId()],
                    [
                        '$set' => [
                            'pdf_url' => 'pdfs/' . $pdfFileName,
                            // Relative path to PDF
                            'cover_image_url' => 'images/' . $coverImageFileName,
                            // Relative path to cover image
                        ]
                    ]
                );

                header("Location: add_book.php?success='Book added successfully!'");

            } else {
                header("Location: add_book.php?error='Could not add book. Something went wrong with the cover image upload.'");

            }
        } else {
            header("Location: add_book.php?error='Could not add book. Something went wrong with the PDF upload'");

        }
    } else {
        header("Location: add_book.php?error='Could not add book data to the database.'");

    }
}
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookName = $_POST["book_name"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $pdfFile = $_FILES["pdf_file"];
    $coverImage = $_FILES["cover_image"];

    addBookWithPDFAndImage($bookName, $author, $genre, $pdfFile, $coverImage);

}
?>