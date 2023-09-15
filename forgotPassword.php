<!-- Including the necessary files -->
<?php 
    require_once("Headers/security_config.php");
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
    <link rel="stylesheet" href="CSS/forgotPass.css"> 
</head>
<body>
    <section class="Content-Wrapper">  
       
        <section class="container">
           
            <h1 class="title titleMail">Reset Password</h1>        
                <form id="form" action="ForgotPassSystem/ResetPassword.php" method="post" enctype="multipart/form-data">
                    <div class="inputs">

                        <div class='input-field'>
                            <img class='icons' src = 'assets/email.svg' alt='User Icon'>
                            <input id='email-input' class='input' type='email' name= 'email'  placeholder='Email' >
                        </div>

                    </div>
                    <div class="buttons-field sendMail">
                        <input class="btn active" type="submit" name="forgotSubmit" value="Send to E-mail">
                    </div>
                    <div class="errors">
                        <?php
                            if(isset($_GET["status"])){
                                if($_GET["status"] == "success"){
                                    echo "<p class='success'>Email sent!</p>";
                                } else {
                                    if(isset($_SESSION["resetErrors"])){
                                         foreach($_SESSION["resetErrors"] as $error){
                                            echo "<p class='error'> $error </p>";
                                        }
                                        unset($_SESSION["resetErrors"]);
                                    }
                                }
                            }
                        ?>
                    </div>

                </form>
        </section>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/forgotPass.js"></script>
    <!-- <script src="JavaScript/forgotPass.js"></script> -->
   
</body>
</html>