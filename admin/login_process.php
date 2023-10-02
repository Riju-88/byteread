<?php
require '../vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// MongoDB connection function 
require '../connection.php';

// Login function
function loginAdmin($email, $password) {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 
    $collection = $db->admin;

    // Find the user by email
    $user = $collection->findOne(['email' => $email]);

    if ($user && password_verify($password, $user->password)) {
        // Password is correct, user is authenticated
        
        // Start or resume the session after a successful login
        session_start();

        // Store user data in session
        $_SESSION['admin'] = serialize($user);

        return true;
    } else {
        // Invalid credentials
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (loginAdmin($email, $password)) {
        // Redirect to a success page or perform other actions
        $user = $_SESSION['admin']; // Get user data from session

        header("Location: index.php");
   
 // Debug session data
        exit;
    } else {
        header("Location: index.php?error='Invalid credentials. Please try again.'");
        // Display an error message or redirect to a login page with an error
        echo "Invalid credentials. Please try again.";
    }
}
?>
