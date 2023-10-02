<div class="navbar bg-base-100 sticky top-0 z-50">
  <div class="navbar-start">
    <div class="dropdown transition-0">
      <label tabindex="0" class="btn lg:hidden" id="menu-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </label>
      <ul tabindex="0"
        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 custom-menu-hidden">
      
        <li class="btn btn-outline btn-primary"><a href="add_book.php">Add Book</a></li>
        <li class="btn btn-outline btn-primary"><a href="manage_books.php">Manage Books</a></li>
          <li class="btn btn-outline btn-primary"><a
          href='manage_users.php'>Manage Users</a></li>
          <li class="btn btn-outline btn-primary"><a
          href='about.php'>About</a></li>
      </ul>
    </div>
    <a class="btn btn-ghost normal-case text-xl text-primary" href="index.php"><img src="../images/site/ByteRead.svg" alt="Logo" class="h-10" /></a>
    <!-- <a class="btn btn-ghost normal-case text-xl text-primary" href="index.php">ByteRead</a> -->
  </div>
  <div class="navbar-center hidden lg:flex">
    <!-- Modify your center-aligned menu items here -->
    <div class="hover join space-x-4">
      <a class="btn btn-outline btn-primary join-item" href='add_book.php'>Add Book</a>
      <a class="btn btn-outline btn-primary join-item" href="manage_books.php">Manage Books</a>
      <a class="btn btn-outline btn-primary join-item" href="manage_users.php">Manage Users</a>

      
      <a class="btn btn-outline btn-primary join-item"
          href='about.php'>About</a>
    </div>

  </div>
  <div class="navbar-end">
    <div class="flex gap-2">
      <!-- Modify your search bar here -->
      <!-- <div class="form-control">
        <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
      </div> -->
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar"  id="profile-toggle">
          <div class="w-10 rounded-full">
            <?php
            if (isset($admin->image)) {
             echo "<img src=".$admin->image." />";
            }
            else{
              echo "<img src='' />";
            }
            ?>
            
          </div>
        </label>
        <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52 profile-menu-hidden">

          <li class="btn btn-outline btn-primary"><a href="update.php" class="link ">Update Profile</a></li>
          <li class="btn btn-outline btn-primary"><a href="login.php" class="link ">Login</a></li>
          <li class="btn btn-outline btn-primary"><a href="logout.php" class="link ">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>



<script>

  document.addEventListener('DOMContentLoaded', (event) => {
    const toggleButton = document.getElementById('menu-toggle');
    const navbarMenu = document.querySelector('.custom-menu-hidden');
    let menuVisible = false;

    toggleButton.addEventListener('click', (event) => {
        if (menuVisible) {
            navbarMenu.classList.add('hidden');
        } else {
            navbarMenu.classList.remove('hidden');
        }
        menuVisible = !menuVisible;
        event.stopPropagation(); // Prevent the click event from propagating to the document
    });

    const profileButton = document.getElementById('profile-toggle');
    const profileMenu = document.querySelector('.profile-menu-hidden');
    let profileMenuVisible = false;

    profileButton.addEventListener('click', (event) => {
        if (profileMenuVisible) {
            profileMenu.classList.add('hidden');
        } else {
            profileMenu.classList.remove('hidden');
        }
        profileMenuVisible = !profileMenuVisible;
        event.stopPropagation(); // Prevent the click event from propagating to the document
    });

    document.addEventListener('click', (event) => {
        if (menuVisible && event.target !== toggleButton && !navbarMenu.contains(event.target)) {
            navbarMenu.classList.add('hidden');
            menuVisible = false;
        }
        if (profileMenuVisible && event.target !== profileButton && !profileMenu.contains(event.target)) {
            profileMenu.classList.add('hidden');
            profileMenuVisible = false;
        }
    });
});

</script>