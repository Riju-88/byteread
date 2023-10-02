<?php
require 'vendor/autoload.php';
session_start();
if (!isset($_SESSION['user'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}


require 'connection.php';
function updateFav()
{
    if (isset($_SESSION['user'])) {

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $userID = $_GET["user_id"];
            $bookID = $_GET["book_id"];

            $client = connectToMongoDB();
            $db = $client->mongoTestdb;
            $collection = $db->book_library;

            // Find all users
            $data = $collection->findOne(['user_id' => $userID, 'book_id' => $bookID]);

            if ($data) {
                // check fav value here
                // echo '<pre>';
                // print_r ($data->favorite);
                // echo '</pre>';
                // Update the user's information
                if ($data->favorite == 0) {
                    $result = $collection->updateOne(
                        ['_id' => $data->_id],
                        [
                            '$set' => [
                                'favorite' => 1,

                            ],
                        ]
                    );

                    if ($result->getModifiedCount() > 0) {
                        if (isset($_GET['redirect']) && $_GET['redirect'] == 'lib_grid') {
                            header("Location: display_library_grid.php?user_id=$userID&success='Book added to favorites.'");
                            exit;
                        }
                        header("Location: display_library.php?user_id=$userID&success='Book added to favorites.'");
                        exit;
                    }
                } elseif ($data->favorite == 1) {
                    $result = $collection->updateOne(
                        ['_id' => $data->_id],
                        [
                            '$set' => [
                                'favorite' => 0,

                            ],
                        ]
                    );

                    if ($result->getModifiedCount() > 0) {
                        if (isset($_GET['redirect']) && $_GET['redirect'] == 'lib_grid') {
                            header("Location: display_library_grid.php?user_id=$userID&success='Book removed from favorites.'");
                            exit;
                        }
                        header("Location: display_library.php?user_id=$userID&success='Book removed from favorites.'");
                        exit;
                    }

                } else {
                    header("Location: display_library.php?user_id=$userID&error='No changes were made.'");
                    exit;
                }
            } else {
                // User not found
                header("Location: display_library.php?user_id=$userID&error='Record not found.'");
                exit;
            }


        }
    }
}

updateFav();
?>