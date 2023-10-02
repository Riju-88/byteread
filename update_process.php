<?php
require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB
// Check if the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}


// MongoDB connection function
require 'connection.php';

function createDirectoriesIfNotExist() {
    // Directory where PDFs and cover images should be stored in the parent directory
    $imageDirectory = '/images';


    if (!file_exists($imageDirectory)) {
        mkdir($imageDirectory, 0777, true);
    }
}
// Update function
function updateUser() {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 
    $collection = $db->user_info;

    $user_info_collection = $db->user_info;
    $user = unserialize($_SESSION['user']);

    
    $user_id = $user->_id;
   
    // check if user is valid
    if (!$user_info_collection->findOne(['_id' => new MongoDB\BSON\ObjectId($user_id)])) {
      
       session_unset();
       session_destroy();
       header("Location: login.php?error='Invalid User ID detected. Login again.'");
       exit;
    }

    $username = $_POST["username"];
    // $email = $_POST["email"];
    $password = $_POST["password"];
    $profileImage = $_FILES["profile_image"];
    
    // Find the user by id
    $user = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($user_id)]);

    createDirectoriesIfNotExist();
    if ($user) {
        // Update the user's information (username and password)
        $updateData = [
            '$set' => [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ],
        ];

        // Check if a new profile image has been uploaded
        if ($profileImage["error"] == UPLOAD_ERR_OK) {
            // Generate a unique identifier for the profile image file name
            $profileImageFileName = uniqid() . '_' . '.jpg'; // Unique identifier for the profile image file name
            $profileImageLocation = 'images/' . $profileImageFileName; // Absolute path to profile images

            // Move the uploaded profile image to a directory
            if (move_uploaded_file($profileImage['tmp_name'], $profileImageLocation)) {
                // Update the user document with the new profile image URL
                $updateData['$set']['image'] = 'images/' . $profileImageFileName;
            } else {
                header("Location: update.php?error='Profile image upload failed.'");
                exit;
            }
        }

        

        // Perform the update
        $result = $collection->updateOne(['_id' => $user->_id], $updateData);

        if ($result->getModifiedCount() > 0) {
           
            session_start();
            session_destroy();
            session_start();

            // Retrieve the updated user data
            $updated_user = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($user_id)]);

            // Store user data in session after serializing it
            $_SESSION['user'] = serialize($updated_user);

            header("Location: login.php?success='Profile updated successfully!'");
        } else {
            header("Location: update.php?error='No changes were made.'");
            exit;
        }
    } else {
        // User not found
        header("Location: update.php?error='User not found. Update failed.'");
        exit;
    }
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

   updateUser();
   
}
?>
