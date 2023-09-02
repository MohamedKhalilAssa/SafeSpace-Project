<!-- //? Including the necessary headers  -->
<?php
    
    require_once("Headers/security_config.php");

    require_once("Headers/checkLogIn.php");
   
?>


<!-- //? HTML starts here  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe-Space</title>

    <!-- including stylesheets -->
    <link rel="icon" href="assets/lock-solid.svg">
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/AllUsers.css"> 
    <link rel="stylesheet" href="CSS/notificationBell.css">
    
</head>
<body>
    
    <?php require_once("Headers/header.php"); ?> 

    <div class='notification-bell'>
    </div>
    <section class="container">
        <div class="State-container online">
            <h1 class="State"><span class="orange">Online</span> Users</h1>
            <hr>
            <div class='users-container online-users'>
            
            </div>
        </div>
        <div class='State-container offline'>
            <h1 class='State'><span class='orange'>Offline</span> Users</h1>
            <hr>
            <div class='users-container offline-users'>
            
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/AllUsers.JS"></script>
    <script src="JavaScript/header.js"></script>
    <script src="JavaScript/checkNotifications.js"></script>
    <script>
        $(".links:nth-child(2)").addClass("active");
    </script>
</body>
</html>