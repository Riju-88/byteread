<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <!-- favicon -->
  <?php include 'favicon.php'; ?>
    <link rel="stylesheet" href="css/output.css">

</head>

<body>
    <!-- Registration Form -->
   <!-- alert -->
   <?php require 'alert.php'; ?>
   
    <!-- <div class="w-full flex justify-center items-center min-h-screen">
        <div class="max-w-md w-full space-y-8">
            <h1 class="text-2xl font-semibold mb-4">Registration Form</h1>
            <form action="submit_registration.php" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="username" class="block font-semibold">Username:</label>
                    <input type="text" id="username" name="username" required
                        class="input input-bordered w-full max-w-xs">
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-semibold">Email:</label>
                    <input type="email" id="email" name="email" required class="input input-bordered w-full max-w-xs">
                </div>

                <div class="mb-4">
                    <label for="image" class="block font-semibold">Image:</label>
                    <input type="file" class="file-input file-input-bordered file-input-primary w-full max-w-xs"
                        name="image" id="image">
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-semibold">Password:</label>
                    <input type="password" id="password" name="password" required
                        class="input input-bordered w-full max-w-xs">
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="block font-semibold">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
                        class="input input-bordered w-full max-w-xs">
                </div>

                <input type="submit" value="Register" class="btn btn-primary mt-4">
            </form>
        </div>

        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-2">Already registered?</h2>
            <div class="join space-x-4">
                <a href="login.php" class="btn btn-primary join-item">Login</a>
                <a href="display_users.php" class="btn btn-primary join-item">Display Users</a>
                <a href="display_books.php" class="btn btn-primary join-item">Display Books</a>
                <a href="delete_profile.php" class="btn btn-primary join-item">Delete Account</a>
                <a href="logout.php" class="btn btn-primary join-item">Logout</a>
            </div>


        </div>


    </div> -->

   
    
    <div class="min-h-fit flex flex-col items-center justify-center bg-base-200">
    <div class="p-6 space-y-6 max-w-lg mx-auto">
        <h2 class="text-xl font-bold text-center mt-4 mb-4">Registration Form</h2>
        <form action="submit_registration.php" method="post" enctype="multipart/form-data"
            class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">

                <div class="space-y-4">
                    <label for="username" class="block font-semibold">Username:</label>
                    <input type="text" id="username" name="username" required class="input input-bordered w-full">
                </div>

                <div class="space-y-4">
                    <label for="email" class="block font-semibold">Email:</label>
                    <input type="email" id="email" name="email" required class="input input-bordered w-full">
                </div>

                <div class="space-y-4">
                    <label for="image" class="block font-semibold">Image:</label>
                    <input type="file" name="image" id="image"
                        class="file-input file-input-bordered file-input-primary w-full" accept="image/*">
                </div>

                <div class="space-y-4">
                    <label for="password" class="block font-semibold">Password:</label>
                    <input type="password" id="password" name="password" required class="input input-bordered w-full">
                </div>

                <div class="space-y-4">
                    <label for="confirm_password" class="block font-semibold">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
                        class="input input-bordered w-full">
                </div>

                <input type="submit" value="Register" class="btn btn-primary w-full">

                <!-- Google Login Button -->
                <div class="mt-4 text-center">
                    <a href="redirect.php" class="btn btn-google">
                    <svg width="14" height="14" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="v0IDieWy"><title>icon / social / google</title><g fill="none" fill-rule="evenodd"><path d="M11.76 6.136c0-.425-.038-.834-.11-1.227H6V7.23h3.23a2.76 2.76 0 01-1.198 1.81v1.506H9.97c1.134-1.044 1.789-2.582 1.789-4.41z" fill="#4285F4"></path><path d="M6 12c1.62 0 2.978-.537 3.97-1.454L8.033 9.041c-.537.36-1.225.573-2.032.573-1.563 0-2.885-1.056-3.357-2.474H.638v1.555A5.998 5.998 0 006 12z" fill="#34A853"></path><path d="M2.643 7.14A3.607 3.607 0 012.455 6c0-.395.068-.78.188-1.14V3.305H.638a5.998 5.998 0 000 5.39L2.643 7.14z" fill="#FBBC05"></path><path d="M6 2.386c.88 0 1.672.303 2.294.898l1.72-1.721C8.976.595 7.618 0 6 0A5.998 5.998 0 00.638 3.305L2.643 4.86C3.115 3.442 4.437 2.386 6 2.386z" fill="#EA4335"></path><path d="M0 0h12v12H0z"></path></g></svg>    
                    Sign in with Google</a>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="mt-4 mb-4 max-w-lg mx-auto text-center">
        <h2 class="text-xl font-semibold mb-2">Already registered?</h2>
        <div class="">
           <h2 class="text-xl mt-2 mb-4">Go to  <a href="login.php" class="link link-primary"> Login</a></h2>
           
        </div>
    </div>
</div>


</body>

</html>