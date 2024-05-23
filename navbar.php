<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="fixed inset-x-0 top-0 z-30 mx-auto w-full max-w-screen border border-gray-100 bg-blue-600 py-5 px-8 shadow backdrop-blur-lg">
    <div class="px-4">
        <div class="flex items-center justify-between">
            <div class="flex shrink-0 md:gap-36">
                <div class="flex items-center justify-between gap-5 md:flex md:gap-40">
                    <div class="flex gap-10 md:items-center md:justify-center">
                        <a aria-current="page" class="inline-block rounded-lg px-2 py-1 text-white text-sm font-medium transition-all duration-200 hover:bg-gray-100 hover:text-gray-900" href="./home.php">Home</a>
                        <a class="inline-block rounded-lg px-2 py-1 text-white text-sm font-medium transition-all duration-200 hover:bg-gray-100 hover:text-gray-900" href="#">About Us</a>
                        <a class="inline-block rounded-lg px-2 py-1 text-white text-sm font-medium transition-all duration-200 hover:bg-gray-100 hover:text-gray-900" href="./Blog.php">Blog</a>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 md:gap-40">
                <div class="relative mx-auto text-gray-600">
                    <input class="border border-gray-300 h-10 w-96 px-5 pr-16 rounded-2xl text-sm placeholder-current focus:outline-none dark:bg-gray-500 dark:border-gray-50 dark:text-gray-200" type="search" name="search" placeholder="Search">
                    <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                        <svg class="text-gray-600 dark:text-gray-200 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 56.966 56.966" xml:space="preserve" width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23 s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92 c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17 s-17-7.626-17-17S14.61,6,23.984,6z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex gap-7">
                    <?php if(isset($_SESSION['nom_utilisateur'])): ?>
                        <p class="text-white">Welcome, <?php echo $_SESSION['nom_utilisateur']; ?></p>
                        <?php if (isset($_SESSION['id_role'])): ?>
                            <?php if ($_SESSION['id_role'] == 1): ?>
                                <a href="dashboard/dashboard.php" class="text-white">Dashboard</a>
                                <a href="logout.php" class="text-white">Logout</a>
                            <?php elseif ($_SESSION['id_role'] == 2): ?>
                                <a href="profile.php" class="text-white">Profile</a>
                                <a href="logout.php" class="text-white">Logout</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="login.php" class="text-white">Login</a>
                        <a href="register.php" class="text-white">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>
