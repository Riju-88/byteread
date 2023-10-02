<?php
require '../vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// MongoDB connection function 
require '../connection.php';

function deleteUser()
{
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 
    $userInfoCollection = $db->user_info;
    $userLibraryCollection = $db->book_library;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = trim($_POST["user_id"]); // Trim to remove any leading/trailing whitespace

        $messages = [];

        // Get the book from the book_list collection
        $user = $userInfoCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($user_id)]);

        if (!unlink("../".$user["image"])) {
            $messages[] = "Image not deleted.";
        }
        else {
            $messages[] = "Image deleted.";
        }

        // Attempt to delete the book from the book_list collection
        $resultUserList = $userInfoCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($user_id)]);
        // Attempt to delete all occurrences of the book from the book_library collection based on the "book_id" field
        $resultUserLibrary = $userLibraryCollection->deleteMany(['user_id' => $user_id]);

        
        if ($resultUserList->getDeletedCount() > 0) {
            $messages[] = "User deleted successfully.";
        }

        if ($resultUserLibrary->getDeletedCount() > 0) {
            $messages[] = "User info also removed from user library.";
        }

        if (!empty($messages)) {
            $successMessage = "success='" . implode(" ", $messages) . "'";
            session_start();
    
            // Unserialize and check if the user ID matches the deleted user
            $user = unserialize($_SESSION['user']);
            if ($user->_id == $user_id) {
                unset($_SESSION['user']); // Unset the user's session data

                 // Regenerate a new session ID
                session_regenerate_id(true);
            }

            header("Location: manage_users.php?$successMessage");
        } else {
            header("Location: manage_users.php?error='Could not delete user. Something went wrong.'");
        }
    }
}


deleteUser();
?>