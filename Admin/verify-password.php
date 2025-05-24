<?php
session_start();
require_once '../common/config.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';


$mail = new PHPMailer(true);
if (isset($_POST['submit'])) {
    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
        $email = $_POST['email'];
  $select_email = "select * from admin where email = '$email'";
  $result_email = mysqli_query($con_query, $select_email);
        $data = mysqli_fetch_assoc($result_email);
        $old_email = $data['email'];
        if($old_email == $email){

  
        $expFormat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat);
        $key = md5(4836 . $email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $addKey;

        mysqli_query(
            $con_query,
            "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');"
        );
        $link = 'http://localhost/Eshopping/Admin/reset-password.php?key=' . $key . '&email=' . $email . '&action=reset';

        $output = '<p>Dear user,</p>';
        $output .= '<p>Please click on the following link to reset your password.</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="' . $link . '" target="_blank">' . $link . '</a></p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
        $output .= '<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';
        $output .= '<p>Thanks,</p>';
        $output .= '<p>Eshopping Team</p>';
        try {  
            // $mail->SMTPDebug = 2;                                       
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = 'PLAIN';
            $mail->Username   = 'ccba3e48b9b6b6';
            $mail->Password   = 'e5482d68693b5c';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('nisupatel8200@gmail.com', 'Nishant');
            $mail->addAddress($email);
            $mail->addAddress('receiver2@gfg.com', 'Name');

            $mail->isHTML(true);
            $mail->Subject = 'Password Recovery - Eshopping.com';
            $mail->Body    = $output;
            // $mail->AltBody = 'Please visit the following link to reset your password: https://www.allphptricks.com/forgot-password/reset-password.php?key=' . $key . '&email=' . $email . '&action=reset';
            if ($mail->send()) {

                $_SESSION['email'] = "<p style='color: green;'>Email sent successfully. Please check your inbox.</p>";
            }
            header("Location: forgot_password.php");
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    else{
        $_SESSION['email'] =  "<p style='color: red;'>Email is not exist. Please Enter valid Email </p>";

    }
    } else {
        $_SESSION['email'] =  "<p style='color: red;'>*Please Enter Email</p>";
    }
    header("Location: forgot_password.php");
    exit();
}
