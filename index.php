<!-- Including the necessary files -->
<?php 
    require_once("Headers/security_config.php");
    require_once("MVC_Connection/SignupView.php");
    require_once("MVC_Connection/SigninView.php");
    require_once(__DIR__ . "/Headers/checkLogInFirst.php") ;
    require_once("MVC_Connection/ImageErrorsView.php");
?>

<!-- HTML Start -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeSpace</title>

    <!-- Stylesheets and icons -->
    <link rel="icon" href="assets/lock-solid.svg">
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="CSS/LoginStyles.css"> 
</head>
<body>
    <section class="Content-Wrapper">  
        <aside class="side">
            <h1  class="welcome">Welcome to your <span class="orange">Safe</span> Space. <br> Where <span class="orange">confidentiality</span> is above all else.</h1>
            <div class="icons-container">
                <img class="users-icon" src="assets/people-nearby.svg" alt = "user1" >
                <img class="users-icon mail" src="assets/message-lock.svg" alt="secure mail">
                <img class="users-icon" src="assets/people-nearby.svg" alt = "user2" >
            </div>
        </aside>
        <section class="container">
            <header>
                <p class="text">
                     <span class="orange">Safe</span> Space
                </p>
              
            </header>
            <h1 class="title">Sign in</h1>        
                <form id="form" action="MVC_Connection/Connection.php" method="post" enctype="multipart/form-data">
                    <div class="inputs">
                         <div class='image-field '>
                             <label for="img" id="image-upload"><img class="plus-icon" src="assets/plus.svg"></label>   
                             <p id="img-para">Add image(png,jpg,jpeg...) </p> <?php imageErrors();?>
                            <input id='img' class='input' type='file' name= 'Image' >
                        </div>
                        <div class='input-field signup-fields'>
                             <img class='icons' src = 'assets/user-icon.svg' alt='User Icon'>
                            <input id='name-input' class='input' type='text' name= 'Fullname' maxlength='50' placeholder='Fullname' >
                        </div>
                        <div class='input-field'>
                            <img class='icons' src = 'assets/email.svg' alt='User Icon'>
                            <input id='email-input' class='input' type='email' name= 'email'  placeholder='Email' >
                        </div>

                        <div class="input-field">
                            <img class="icons" src = "assets/lock-solid.svg" alt="Lock icon">
                            <input class='input' type="password" name= "password1" maxlength="16" minlength="5" placeholder="Password" >
                        </div>
                        <div class="input-field signup-fields">
                            <img class="icons" src = "assets/lock-solid.svg" alt="Lock icon">
                            <input class='input' type="password" name= "password2" maxlength="16" minlength="5" placeholder="Confirm Password" >
                        </div>
                    </div>
                    <div class="buttons-field">
                        <input class="btn active n1" type="submit" name="SignIn" value="Sign in">
                        <input class="btn inactive n2" type="submit" name="SignUp" value="Sign Up">
                    </div>
                    <div class="errors">
                        <?php
                            errors_view();
                            SigninErrors_view();
                         ?>
                    </div>

                </form>
        </section>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/main.js"></script>
    <script src="https://unpkg.com/split-type"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" integrity="sha512-16esztaSRplJROstbIIdwX3N97V1+pZvV33ABoG1H2OyTttBxEGkTsoIVsiP1iaTtM8b3+hu2kB6pQ4Clr5yug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let myText= new SplitType('.welcome');
        gsap.from(myText.chars, {y: "200%", stagger:0.01});
        

           
    </script>
</body>
</html>