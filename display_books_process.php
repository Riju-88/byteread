<?php

if (!isset($_SESSION['user'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}

require 'connection.php';

// Function to fetch all registered users
function getAllbooks($sortBy = null) {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; // Replace with your database name
    $collection = $db->book_list;

    $user_info_collection = $db->user_info;
    $user = unserialize($_SESSION['user']);

    // Now you can access properties of $user, such as $user->_id
    $user_id = $user->_id;
    // MongoDB connection function (similar to what you've used before)
    // check if user is valid
    if (!$user_info_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($user_id)])) {
      
       session_unset();
       session_destroy();
       header("Location: login.php?error='Invalid User ID detected. Login again.'");
       exit;
    }
    // Define the default filter (no filter)
    $filter = [];

    // Define the default sort filter (by date in descending order)
    $sortFilter = ['_id' => -1]; // Default sorting by insertion time

    // Check if a sorting option is specified
    if ($sortBy === 'name_asc') {
        // Sort by name in ascending order
        $sortFilter = ['title' => 1];
    } elseif ($sortBy === 'name_desc') {
        // Sort by name in descending order
        $sortFilter = ['title' => -1];
    }elseif ($sortBy === 'author_asc') {
        // Sort by author in ascending order
        $sortFilter = ['author' => 1];
    } elseif ($sortBy === 'author_desc') {
        // Sort by author in descending order
        $sortFilter = ['author' => -1];
    } elseif ($sortBy === 'genre_asc') {
        // Sort by author in ascending order
        $sortFilter = ['genre' => 1];
    } elseif ($sortBy === 'genre_desc') {
        // Sort by author in descending order
        $sortFilter = ['genre' => -1];
    } elseif ($sortBy === 'time_desc') {
        // Sort by insertion time in descending order
        $sortFilter = ['_id' => -1];
    }

    // Find all books with the specified filter and sort
    $books = $collection->find($filter, ['sort' => $sortFilter]);

    return $books;
}


?>
