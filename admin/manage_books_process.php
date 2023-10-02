<?php
// MongoDB connection function 
require '../connection.php';

// Function to fetch all registered users
function getAllbooks($sortBy = null) {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 
    $collection = $db->book_list;

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
