<?php
// MongoDB connection function 
require '../connection.php';

// Function to fetch all registered users
function getAllUsers($sortBy = null) {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 
    $collection = $db->user_info;

    // Define the default filter (no filter)
    $filter = [];

    // Define the default sort filter (by date in descending order)
    $sortFilter = ['_id' => -1]; // Default sorting by insertion time

    // Check if a sorting option is specified
    if ($sortBy === 'name_asc') {
        // Sort by name in ascending order
        $sortFilter = ['username' => 1];
    } elseif ($sortBy === 'name_desc') {
        // Sort by name in descending order
        $sortFilter = ['username' => -1];
    }elseif ($sortBy === 'email_asc') {
        // Sort by author in ascending order
        $sortFilter = ['email' => 1];
    } elseif ($sortBy === 'email_desc') {
        // Sort by author in descending order
        $sortFilter = ['email' => -1];
    } elseif ($sortBy === 'time_desc') {
        // Sort by insertion time in descending order
        $sortFilter = ['_id' => -1];
    } else {
        // Sort by insertion time in descending order
        $sortFilter = ['_id' => -1];
    }

    // Find all users with the specified filter and sort
    $users = $collection->find($filter, ['sort' => $sortFilter]);

    return $users;
}
?>
