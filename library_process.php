<?php
// MongoDB connection function (similar to what you've used before)


require 'connection.php';

// Function to fetch all registered users
// function getAllLibbooks() {
//     if (isset($_SESSION['user'])) {
//         if ($_SERVER["REQUEST_METHOD"] == "GET") {
//             $userID = $_GET["user_id"];

//             $client = connectToMongoDB();
//             $db = $client->mongoTestdb; 
//             $collection = $db->book_library;

//             // Find all users
//             $cursor = $collection->find(['user_id' => $userID]);

//             $books = [];
            
//             foreach ($cursor as $document) {
//                 $bookID = $document['book_id']; // Get the book_id from the document
//                 $bookListCollection = $db->book_list;
//                 $book = $bookListCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($bookID)]);
                
//                 if ($book) {
//                     // Add the "favorite" field from the "book_library" document to the book
//                     $book['favorite'] = $document['favorite'];
//                     $books[] = $book;
//                 }
//             }

//             return $books;
//         }
//     }
// }

function getAllLibbooks($sortBy = null) {
    if (isset($_SESSION['user'])) {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $userID = $_GET["user_id"];

            $client = connectToMongoDB();
            $db = $client->mongoTestdb; 
            $collection = $db->book_library;
            $user_info_collection = $db->user_info;

            // check if user is valid
            if (!$user_info_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($userID)])) {
               session_start();
               session_unset();
               session_destroy();
               header("Location: login.php?error='Invalid User ID detected. Login again.'");
               exit;
            }
            // Find all users
            $cursor = $collection->find(['user_id' => $userID]);

            $books = [];
            
            foreach ($cursor as $document) {
                $bookID = $document['book_id']; // Get the book_id from the document
                $bookListCollection = $db->book_list;
                $book = $bookListCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($bookID)]);
                
                if ($book) {
                    // Add the "favorite" field from the "book_library" document to the book
                    $book['favorite'] = $document['favorite'];
                    $books[] = $book;
                }
            }

            // Apply sorting based on the $sortBy parameter
            if ($sortBy) {
                $sortFilter = [];
                if ($sortBy === 'name_asc') {
                    $sortFilter = ['title' => 1];
                } elseif ($sortBy === 'name_desc') {
                    $sortFilter = ['title' => -1];
                } elseif ($sortBy === 'author_asc') {
                    $sortFilter = ['author' => 1];
                } elseif ($sortBy === 'author_desc') {
                    $sortFilter = ['author' => -1];
                }elseif ($sortBy === 'genre_asc') {
                    $sortFilter = ['genre' => 1];
                } elseif ($sortBy === 'genre_desc') {
                    $sortFilter = ['genre' => -1];
                } elseif ($sortBy === 'favorite_asc') {
                    $sortFilter = ['favorite' => 1];
                } elseif ($sortBy === 'favorite_desc') {
                    $sortFilter = ['favorite' => -1];
                } elseif ($sortBy === 'time_desc') {
                    $sortFilter = ['_id' => -1];
                } else {
                    $sortFilter = ['_id' => -1];
                }

                // Sort the books array
                usort($books, function ($a, $b) use ($sortFilter) {
                    foreach ($sortFilter as $field => $order) {
                        $cmp = strcmp($a[$field], $b[$field]);
                        if ($cmp !== 0) {
                            return $order === 1 ? $cmp : -$cmp;
                        }
                    }
                    return 0;
                });
            }

            return $books;
        }
    }
}

?>
