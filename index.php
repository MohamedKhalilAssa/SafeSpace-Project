<!-- Including the necessary files -->
<?php 
    require_once("Headers/security_config.php");
    require_once("MVC_Connection/SignupView.php");
    require_once("MVC_Connection/SigninView.php");
?>

<!-- HTML Start -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeSpace</title>

    <!-- Stylesheets and icons -->
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="CSS/LoginStyles.css"> 
</head>
<body>
    <section class="container">
        <h1 class="title">Sign in</h1>        
            <form id="form" action="MVC_Connection/Connection.php" method="post">
                <div class="inputs">
                    <div class='input-field signup-fields'>
                         <img class='icons' src = 'assets/user-icon.svg' alt='User Icon'>
                        <input id='name-input' class='input' type='text' name= 'Fullname' maxlength='50' placeholder='Fullname' >
                    </div>
                    <div class='input-field'>
                        <img class='icons' src = 'assets/email.svg' alt='User Icon'>
                        <input class='input' type='email' name= 'email'  placeholder='Email' >
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

    <script src="JavaScript/main.js"></script>
</body>
</html>