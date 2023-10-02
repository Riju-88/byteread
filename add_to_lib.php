<?php
require 'vendor/autoload.php';

session_start();
if (!isset($_SESSION['user'])) {
// User is not logged in, redirect to the login page
header("Location: login.php");
exit();
}

// MongoDB connection function
require 'connection.php';

// User registration function
function addToLib($userId, $bookId) {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; // Replace with your database name

   
    // Check if the email is already registered
    $criteria = [
        '$and' => [
            ['user_id' => $userId],
            ['book_id' => $bookId]
        ]
    ];
    $collection = $db->book_library;
    $existingbook = $collection->findOne($criteria);

  

    if ($existingbook) {
        header("Location: display_books.php?warning='Book already exists in your library.'");
        exit;
    }


    // Insert the new user into the database
    $result='';

    
   
        $result = $collection->insertOne([
            'user_id' => $userId,
            'book_id' => $bookId,
            'favorite' => 0,
            
        ]);
     
    
   

    if ($result->getInsertedCount() > 0) {
        header("Location: display_books.php?success='Book added to library!'");
      
    } else {
        header("Location: display_books.php?error='Could not add to library.'");
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userId = $_GET["user_id"];
    $bookId = $_GET["book_id"];

   addToLib($userId, $bookId);
   
}
?>
