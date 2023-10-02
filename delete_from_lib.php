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
function deleteFromLib($userId, $bookId) {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; // Replace with your database name

   
    // $criteria = [
    //     '$and' => [
    //         ['user_id' => $userId],
    //         ['book_id' => $bookId]
    //     ]
    // ];
    $collection = $db->book_library;

    // Insert the new user into the database

        $result = $collection->deleteOne([
            'user_id' => $userId,
            'book_id' => $bookId,
            
            
        ]);
     
    
   

    if ($result->getDeletedCount() > 0) {

        header("Location: display_library.php?user_id=$userId&success='Book removed from library.'");

        
    } else {
        header("Location: display_library.php?user_id=$userId&error='Could not remove book from library.'");
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userId = $_GET["user_id"];
    $bookId = $_GET["book_id"];

    deleteFromLib($userId, $bookId);
}
?>
