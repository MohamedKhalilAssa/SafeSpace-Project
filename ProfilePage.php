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
    <link rel="stylesheet" href="CSS/profileStyles.css"> 
    <link rel="stylesheet" href="CSS/notificationBell.css">
    <link rel="stylesheet" href="CSS/posts.css">
</head>
<body>
    
    <?php require_once("Headers/header.php"); ?> 
    
    <div class='notification-bell'>
    </div>
    <section class="container">
        <div class="profile-container">
            <div class="image">
                <img src ="Uploads/<?=$_SESSION['imageName']?>" alt="avatar">
            </div>
            <div class="text-container">
                <h2 id="Name">
                <?=$_SESSION["Fullname"]?>
                </h2>
                <p class="email"><?=$_SESSION["email"]?></p>
            </div>
            <img class='settings' src='assets/settings.svg' alt='icon-settings'>  
            <div class="btn-container profileBTNS">
                <button class="btn logout" name="logout">LogOut</button>
                <button class="change btn"><a href='changeData.php'>Change Data</a> </button>
            </div>
        </div>

        <main class="posts">
            <div class="addPost">
                <img src='assets/plus.svg' alt='plus-icon'>
            </div>
            
        </main>
    </section>
    

    <!-- Posts Page -->
    

    <!-- Form for adding a new post -->
    <div class="form-container">
        <div class="overlay"></div>
        
        <form id='form' action="" method='post' enctype="multipart/form-data">
            <img src='assets/x.svg' alt='go-back icon' class='remove'>
            <div class='input-field '>
                <input id='title-input' class='input' type='text' name= 'Title' maxlength='100' placeholder='Title...' >
            </div>
            <div class='input-field desc-input-field '>
                <textarea id="desc-input" class="input" name="desc" rows="4" cols="50" maxlength="500" placeholder="Description..."></textarea>
                <span class="chars">0/500</span>
            </div>
            <div class='image-field '>
                <label for="img" id="image-upload"><img class="plus-icon" src="assets/plus.svg"></label>   
                <p id="img-para">Add image(png,jpg,jpeg...) </p> 
                <input id='img' class='input' type='file' name= 'Image' >
            </div>
            <div class="buttons-field">
                <input class="btn" type="submit" name="submit" value="Submit">
            </div>
            <div class="Errors">
            </div>
        </form>
       
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/AjaxHomepage.js"></script>
    <script src="JavaScript/header.js"></script>
    <script src="JavaScript/checkNotifications.js"></script>
    <script src="JavaScript/profilePosts.js"></script>
    <script>
        $(".links:first").addClass("active");
    </script>
</body>
</html>