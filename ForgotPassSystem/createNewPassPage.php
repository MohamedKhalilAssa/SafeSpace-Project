<!-- Including the necessary files -->
<?php 
    require_once(dirname(__DIR__) . "/Headers/security_config.php");
?>

<!-- HTML Start -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeSpace</title>

    <!-- Stylesheets and icons -->
    <link rel="icon" href="../assets/lock-solid.svg">
    <link rel="stylesheet" href="../CSS/Reset.css">
    <link rel="stylesheet" href="../CSS/forgotPass.css"> 
</head>
<body>
    <section class="Content-Wrapper">  
       
        <section class="container">
           <?php
                if(!empty($_GET["selector"]) && !empty($_GET["validator"])){
                    if(ctype_xdigit($_GET["selector"]) && ctype_xdigit($_GET["validator"])){
                        ?>
                            <h1 class="title new">Create New Password</h1>        
                            <form id="form" action="UpdatePass.php" method="post" enctype="multipart/form-data">
                                <input type='hidden' name='selector' value="<?= $_GET["selector"] ?>">
                                <input type='hidden' name='validator' value="<?= $_GET["validator"] ?>">
                                <div class="inputs">   
                                    <div class="input-field">
                                        <img class="icons" src = "../assets/lock-solid.svg" alt="Lock icon">
                                        <input class='input password1' type="password" name= "password1" maxlength="16" minlength="5" placeholder="Password" >
                                        <img class="icons eyes1" src = "../assets/eye.svg" alt="eyes">
                                    </div>
                                    <div class="input-field signup-fields">
                                        <img class="icons" src = "../assets/lock-solid.svg" alt="Lock icon">
                                        <input class='input password2' type="password" name= "password2" maxlength="16" minlength="5" placeholder="Confirm Password" >
                                        <img class="icons eyes2" src = "../assets/eye.svg" alt="eyes">
                                    </div>
                                    <div class="buttons-field">
                                        <input class="btn active" type="submit" name="createNew" value="Change Password">
                                    </div>
                                    <div class="errors">
                                        <?php
                                            if(isset($_GET["error"])){
                                                if($_GET["error"] == "true"){
                                                    if(isset($_SESSION["createNewPassError"])){
                                                        foreach($_SESSION["createNewPassError"] as $error){
                                                            echo "<p class='error'> $error </p>";
                                                        }
                                                    }
                                                } else {
                                                    echo "<p class='success'>Email sent!</p>";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div> 
                            </form>


                        <?php
                    }
                }   else {
                    echo $_GET["selector"];
                    echo $_GET["validator"]; 
                    
                }
           ?>
           
        </section>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../JavaScript/newPass.js"></script>
    <!-- <script src="JavaScript/forgotPass.js"></script> -->
   
</body>
</html>