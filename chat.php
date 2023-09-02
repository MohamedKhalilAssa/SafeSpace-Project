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
    <link rel="stylesheet" href="CSS/chat.css"> 
    <link rel="stylesheet" href="CSS/notificationBell.css">
    
</head>
<body>
    
    <?php require_once("Headers/header.php"); ?> 

    <div class='notification-bell'>
    </div>
    <section class="container">
        <div class="friends">
           
            

            
        </div>
        <div class="chat-container">
            <div class="user2 onMessage">  
            </div>

            <div class="messages">
                
               
            </div>
            <div class="submitMessage">
                <!-- <input type='text' placeholder='Message...' name='message'> -->
                <textarea id="message-input" class="input" name="message"  maxlength="200" placeholder="Message..."></textarea>
                <span class="chars">0/200</span>
                <div class="icon-container">
                    <img class='sendIcon' src='assets/send-mail.svg' alt='send-button'>
                </div>
                
            </div> 
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/chat.js"></script>
    <script src="JavaScript/header.js"></script>
    <script src="JavaScript/checkNotifications.js"></script>
    <script>
        $(".links:nth-child(3)").addClass("active");
    </script>
</body>
</html>