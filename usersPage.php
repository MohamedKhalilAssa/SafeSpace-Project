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
    <link rel="stylesheet" href="CSS/otherUsersStyles.css"> 
    <link rel="stylesheet" href="CSS/notificationBell.css">
    <link rel="stylesheet" href="CSS/posts.css">
</head>
<body>
    
    <?php require_once("Headers/header.php"); ?> 
    <div class='notification-bell'>
    </div>
    <section class="container">
        <div class="profile-container">
        

            <img class='settings' src='assets/settings.svg' alt='icon-settings'>  
            <div class="btn-container">
            </div>
        </div>
        <main class="posts">
                
        </main>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/usersPage.js"></script>
    <script src="JavaScript/header.js"></script>
    <script src="JavaScript/checkNotifications.js"></script>
    <script src="JavaScript/otherUsersPosts.js"></script>

    <script>
        $(".links:nth-child(2)").addClass("active");
    </script>
</body>
</html>