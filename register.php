<?php include 'signUp.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <!-- font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register</title>
</head>
<body>
   <?php include 'navbar.php'; ?>

    <section class="flex justify-center items-center h-screen" id="signup">
        <div class=" flex items-center justify-center w-3/5   bg-cover bg-center md:rounded-xl" style="height:32rem; background-image: url('image/Capture.PNG');">
            <div class="flex items-center border border-black   rounded-s justify-center h-full w-full bg-blue-50 bg-opacity-50">
            <div class="text-center w-full ">
                <form class="max-w-md mx-auto" action="signUp.php" method= "POST">
                    <div class="register p-6 space-y-4 md:space-y-6  ">
                    <h1 class=" pt-10 w-80 text-xl ">Set up your<span class="text-blue-700">account</span></h1>
                   
                    <div class="input-group">
                
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-blue-600 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" >
                    </div>
                    <div class="input-group">
                
                        <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-blue-600 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Last" required="">
                    </div>
                    <div class="input-group">
                
                        <input type="number" name="mobil" id="mobile" class="bg-gray-50 border border-blue-600 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mobile number" required="">
                    </div>
                    <div class="input-group">
                
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-blue-600 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email Address" required="">
                    </div>
                    <div class="input-group">
                
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-blue-600 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password" required="">
                    </div>
                      
                    <div class="input-group">
                
                        <input type="Password" name="confirmation_password" id="confirmation_password" class="bg-gray-50 border border-blue-600 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Confirm Password" required="">
                    </div>
                      
                    <button type="submit" class="btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Sign Up" name="sign-button">Submit</button>

                   </div>
                  </form class="or">
                  
            </div>
        </div>
        </section>
  
    
        <?php include 'footer.php'; ?>
</body>
</html>
