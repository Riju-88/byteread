<?php
session_start();
if (!isset($_SESSION['user'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB
// Check if the user is logged in
// Verify if $_SESSION['user'] contains the expected structure

// Unserialize the user object
$user = unserialize($_SESSION['user']);

// Now you can access properties of $user, such as $user->_id
$user_id = $user->_id;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Profile</title>
     <!-- favicon -->
  <?php include 'favicon.php'; ?>
    <link rel="stylesheet" href="css/output.css">

</head>

<body>

    <!-- Navigation -->
    <?php include 'navbar.php'; ?>

    <!-- alert -->
    <?php require 'alert.php'; ?>

    <div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row">
        <form action="delete_profile_process.php" method="POST"
            class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">
                <h2 class="text-2xl font-bold text-center">Delete Profile</h2>
                <p class="text-center text-warning">Enter your email address and password to confirm the deletion of your profile:</p>
                <div class="form-control">
                    <label for="user_id" class="label">
                        <span class="label-text">User ID:</span>
                    </label>
                    <input type="text" name="user_id" id="user_id" required placeholder="User ID"
                        class="input input-bordered" value="<?php echo $user->_id; ?>" readonly>
                </div>
                <div class="form-control">
                    <label for="email" class="label">
                        <span class="label-text">Email:</span>
                    </label>
                    <input type="email" id="email" name="email" required placeholder="Email"
                        class="input input-bordered">
                </div>
                <div class="form-control">
                    <label for="password" class="label">
                        <span class="label-text">Password:</span>
                    </label>
                    <input type="password" id="password" name="password" required placeholder="Password"
                        class="input input-bordered">
                </div>
                <div class="form-control mt-6">
                    <input type="submit" value="Confirm" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>