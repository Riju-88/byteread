<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['admin'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

require '../vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// Unserialize the user object
$admin = unserialize($_SESSION['admin']);

?>

<?php
if (!isset($_GET['user_data'])) {
    // User is not logged in, redirect to the login page
    header("Location: manage_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>
    <link href="../css/output.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Navigation -->
    <?php include 'navbar.php'; ?>

    <!-- alert -->
    <?php require '../alert.php'; ?>

    <?php
    $encodedUser = $_GET['user_data'];

    // Decode the URL-encoded data
    $decodedUser = urldecode($encodedUser);

    // Unserialize the data
    $user = unserialize($decodedUser);


    ?>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row">

            <div class="mt-4">
                <h2 class="text-xl text-center font-semibold mb-2">Delete User</h2>
                <form action="delete_user_process.php" method="post" enctype="multipart/form-data"
                    class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">

                    <div class="card-body">
                        <div class="form-control">
                            <?php
                            // Check if the user has an image
                            if ($user->image != null) {
                                // Display the user's image
                                echo '<img src="../' . $user->image . '" alt="User Image" class="rounded-box h-24 w-24 mx-auto mb-4">';
                            }
                            ?>
                        </div>
                        <div class="form-control">
                            <label for="user_id" class="block font-semibold">User ID:</label>

                            <input type="text" name="user_id" id="user_id" required placeholder="User ID"
                                class="input input-bordered w-full" value=" <?php echo $user->_id; ?>" readonly>
                        </div>
                        <div class="form-control">
                            <label for="username" class="block font-semibold">User Name:</label>

                            <input type="text" name="username" id="username" required placeholder="User Name"
                                class="input input-bordered w-full" value=" <?php echo trim($user->username); ?>"
                                readonly>
                        </div>
                        <div class="form-control">
                            <label for="email" class="block font-semibold">Email:</label>
                            <input type="text" name="email" id="email" required placeholder="Email"
                                class="input input-bordered w-full" value=" <?php echo trim($user->email); ?>" readonly>
                        </div>



                        <div class="form-control mt-6">
                            <input type="submit" value="Delete User" class="btn btn-error w-full">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


</body>

</html>