<?php

// ? included files
require_once(dirname(__DIR__) . "/Headers/security_config.php");
require_once(dirname(__DIR__) . "/Headers/connectToDb.php");
// * phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once(dirname(__DIR__) . '/phpMailer/vendor/autoload.php') ;



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["forgotSubmit"])){
    if(isset($_POST["email"])){
        if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = $_SERVER["SERVER_NAME"] . "/SafePlace_Project/ForgotPassSystem/createNewPassPage.php?selector=" . $selector . "&validator=" . bin2hex($token);

            $expireDate = date("U") + 1800;

            $email = $_POST["email"];

            $sql = "SELECT * FROM users WHERE Email LIKE :email";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':email',$email);

            $statement->execute();
            $result = $statement->fetch();

            if($result){
                    // delete previous token
                $sql = "DELETE FROM resetpassword WHERE ResetEmail = ?;";
                $statement = $pdo->prepare($sql);

                $statement->execute([$email]);

                // insert new one 
                $hashedToken = password_hash($token,PASSWORD_DEFAULT);
                $sql = "INSERT INTO resetpassword(ResetEmail, Selector, Token, ExpireDate) VALUES (:Email, :Selector, :Token, :expiry);";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(':Email',$email);
                $statement->bindValue(':Selector',$selector);
                $statement->bindValue(':Token',$hashedToken);
                $statement->bindValue(':expiry',$expireDate);


                $statement->execute();

                // close statement
                $statement = null;

            
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';  
                    $mail->SMTPSecure = 'ssl';                   //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = '';                     //SMTP username to be filled
                    $mail->Password   = '';                               //SMTP password to be filled
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('no-reply@safespace.com', 'SafeSpace');
                    $mail->addAddress($email);     //Add a recipient

                    // $mail->addReplyTo('assaddiki.mohamed1@gmail.com', 'SafeSpace');
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = "Reset Your SafeSpace's Password";
                    $mail->Body    = "<p>We have received a password reset request! The link to pursue your request is down below.
                                        <br> if you didn't make this request you can Ignore this message.</p><br>
                                    <p> here is the link in question: <a href = '". $url ."' >Click here!</a> </p>";
                    $mail->AltBody = "We have received a password reset request! The link to pursue your request is down below.\n if you didn't make this request you can Ignore this message.
                                    here is the link in question: " . $url;
                
                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                header("Location: ../forgotPassword.php?status=success");
            } else {
                $_SESSION["resetErrors"]["EmailnotRegistred"] = "Email not registered";
                header("Location: ../forgotPassword.php?status=error");
                die();
            }

        } else{
            $_SESSION["resetErrors"]["Email"] = "Invalid Email!";
            header("Location: ../forgotPassword.php?status=error");
            die();
        }
    } else{
        $_SESSION["resetErrors"]["emptyField"] = "Email field is empty!";
        header("Location: ../forgotPassword.php?status=error");
        die();
    }
} else {
    header("Location: ../index.php");
    die();
}
