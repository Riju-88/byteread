<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- favicon -->
  <?php include 'favicon.php'; ?>
  <link rel="stylesheet" href="css/output.css">

</head>

<body>

  <!-- <div class='alert alert-info'>
    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' class='stroke-info shrink-0 w-6 h-6'>
      <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>
    </svg>
    <span>12 unread messages. Tap to see.</span>
  </div> -->

  <!-- alert -->
  <?php require 'alert.php'; ?>
  
 <!-- daisyUI login -->
<div class="hero min-h-screen bg-base-200">
  <div class="hero-content flex-col lg:flex-row">

    <div class="card flex-shrink-0 w-full max-w-sm">

      <div class="card-body">
        <div class="text-center mb-4">
          <h1 class="text-5xl font-bold">Login now!</h1>
        </div>
        <div class="card shadow-2xl bg-base-100">
          <div class="card-body">
            <!-- Traditional Login Form -->
            <form action="login_process.php" method="post" class="flex-shrink-0 w-full max-w-sm shadow-2xl">
              <div class="form-control">
                <label for="email" class="label">
                  <span class="label-text">Email</span>
                </label>
                <input type="email" id="email" name="email" required placeholder="Email" class="input input-bordered">
              </div>
              <div class="form-control">
                <label for="password" class="label">
                  <span class="label-text">Password</span>
                </label>
                <input type="password" id="password" name="password" required placeholder="Password" class="input input-bordered">
              </div>
              <div class="form-control mt-6">
                <input type="submit" value="Login" class="btn btn-primary">
              </div>
            </form>
            <!-- End of Traditional Login Form -->

           <!-- Google Login Button -->
           <div class="mt-4 text-center">
                    <a href="redirect.php" class="btn btn-google">
                    <svg width="14" height="14" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="v0IDieWy"><title>icon / social / google</title><g fill="none" fill-rule="evenodd"><path d="M11.76 6.136c0-.425-.038-.834-.11-1.227H6V7.23h3.23a2.76 2.76 0 01-1.198 1.81v1.506H9.97c1.134-1.044 1.789-2.582 1.789-4.41z" fill="#4285F4"></path><path d="M6 12c1.62 0 2.978-.537 3.97-1.454L8.033 9.041c-.537.36-1.225.573-2.032.573-1.563 0-2.885-1.056-3.357-2.474H.638v1.555A5.998 5.998 0 006 12z" fill="#34A853"></path><path d="M2.643 7.14A3.607 3.607 0 012.455 6c0-.395.068-.78.188-1.14V3.305H.638a5.998 5.998 0 000 5.39L2.643 7.14z" fill="#FBBC05"></path><path d="M6 2.386c.88 0 1.672.303 2.294.898l1.72-1.721C8.976.595 7.618 0 6 0A5.998 5.998 0 00.638 3.305L2.643 4.86C3.115 3.442 4.437 2.386 6 2.386z" fill="#EA4335"></path><path d="M0 0h12v12H0z"></path></g></svg>
                      Sign in with Google</a>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  <div class="text-center  flex-col lg:flex-row bg-base-200">
    <h2 class="text-xl mb-4">Not a user? <a href="register.php" class="link link-primary">Register here</a></h2>
  </div>


</body>

</html>

<!-- 
    <div class="relative flex flex-col justify-center h-screen overflow-hidden">
        <div class="w-full p-6 m-auto bg-white rounded-md shadow-md ring-2 ring-gray-800/50 lg:max-w-lg">
            <h1 class="text-3xl font-semibold text-center text-gray-700">DaisyUI</h1>
            <form class="space-y-4">
                <div>
                    <label class="label">
                        <span class="text-base label-text">Email</span>
                    </label>
                    <input type="text" placeholder="Email Address" class="w-full input input-bordered" />
                </div>
                <div>
                    <label class="label">
                        <span class="text-base label-text">Password</span>
                    </label>
                    <input type="password" placeholder="Enter Password" class="w-full input input-bordered" />
                </div>
                <a href="#" class="text-xs text-gray-600 hover:underline hover:text-blue-600">Forget Password?</a>
                <div>
                    <button class="btn btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>
 -->
