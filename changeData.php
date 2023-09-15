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
    <link rel="stylesheet" href="CSS/changeData.css"> 
</head>
<body>
    <section class="Content-Wrapper">  
       
        <section class="container">
           <?php
                if(isset($_SESSION["LoggedIn"]) && $_SESSION["LoggedIn"]){
                        ?>
                        <div class="imageChange">
                            <h1 class="title new">Change Profile Picture</h1>    
                            <form id="form" action="changingData/changeImage.php" method="post" enctype="multipart/form-data">
                                <div class="inputs">
                                    <div class='image-field '>
                                        <label for="img" id="image-upload"><img class="plus-icon" src="assets/plus.svg"></label>   
                                        <p id="img-para">Add image(png,jpg,jpeg...) </p> 
                                        <input id='img' class='input' type='file' name= 'Image' >
                                        <div class="errors">
                                        <?php
                                            if(isset($_SESSION["ImageErrors"]) && !empty($_SESSION["ImageErrors"])){
                                                foreach($_SESSION["ImageErrors"] as $error){
                                                    echo "<p class='error'> $error </p>";
                                                }
                                                unset($_SESSION["ImageErrors"]);
                                            }
                                        ?>
                            </div>
                                    </div>
                                    <div class="buttons-field">
                                            <input class="btn active" type="submit" name="NameChange" value="Change Image">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="passwordChange"> 
                            <h1 class="title new">Change Password</h1>        
                            <form id="form" action="changingData/changePassword.php" method="post" enctype="multipart/form-data">
                                <div class="inputs">   
                                    <div class="input-field">
                                        <img class="icons" src = "assets/lock-solid.svg" alt="Lock icon">
                                        <input class='input password1' type="password" name= "password1" maxlength="16" minlength="5" placeholder="Actual Password" >
                                        <img class="icons eyes1" src = "assets/eye.svg" alt="eyes">
                                    </div>
                                    <div class="input-field signup-fields">
                                        <img class="icons" src = "assets/lock-solid.svg" alt="Lock icon">
                                        <input class='input password2' type="password" name= "password2" maxlength="16" minlength="5" placeholder="New Password" >
                                        <img class="icons eyes2" src = "assets/eye.svg" alt="eyes">
                                    </div>
                                    <div class="input-field signup-fields">
                                        <img class="icons" src = "assets/lock-solid.svg" alt="Lock icon">
                                        <input class='input password3' type="password" name= "password3" maxlength="16" minlength="5" placeholder="Confirm Password" >
                                        <img class="icons eyes3" src = "assets/eye.svg" alt="eyes">
                                    </div>
                                    <div class="buttons-field">
                                        <input class="btn active" type="submit" name="change" value="Change Password">
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <div class="nameChange">
                            <h1 class="title new">Change Name</h1>    
                            <form id="form" action="changingData/changeName.php" method="post" enctype="multipart/form-data">
                                <div class="inputs">
                                    <div class='input-field signup-fields'>
                                        <img class='icons' src = 'assets/user-icon.svg' alt='User Icon'>
                                        <input id='name-input' class='input' type='text' name= 'Fullname' maxlength='50' placeholder='Fullname' >
                                    </div>
                                    <div class="buttons-field">
                                            <input class="btn active" type="submit" name="NameChange" value="Change Name">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="errors">
                                <?php
                                    if(isset($_SESSION["ChangingErrors"]) && !empty($_SESSION["ChangingErrors"])){
                                        foreach($_SESSION["ChangingErrors"] as $error){
                                            echo "<p class='error'> $error </p>";
                                        }
                                        unset($_SESSION["ChangingErrors"]);
                                    }
                                ?>
                        </div>
                    <?php }
                else { 
                    header("Location: index.php?loggedIn=false");        
                } ?>           
        </section>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JavaScript/changeData.JS"></script>
    <!-- <script src="JavaScript/forgotPass.js"></script> -->
   
</body>
</html>