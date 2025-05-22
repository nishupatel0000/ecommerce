<?php
require 'PHPMailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password •</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            border: 1px solid #dbdbdb;
            padding: 40px;
            width: 360px;
            text-align: center;
        }

        .container h2 {
            font-weight: normal;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #dbdbdb;
            border-radius: 4px;
            background-color: #fafafa;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            background-color: #0095f6;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-login {
            margin-top: 20px;
            display: block;
            text-decoration: none;
            color: #385185;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Trouble logging in?</h2>
        <p>Enter your email and we'll send you a link to get back into your account.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="email" name="email" placeholder="Email address" required>
            <button type="submit">Send Login Link</button>
        </form>
        <a href="index.php" class="back-login">Back to Login</a>
    </div>

</body>

</html>
<?php
// Load PHPMailer classes manually (core PHP way)


try {
    // SMTP configuration
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'ccba3e48b9b6b6';
    $phpmailer->Password = '****3b5c';

    // Sender and recipient
    $mail->setFrom('noreply@example.com', 'My Website');
    $mail->addAddress($_POST['email'], 'User');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Reset Your Password';
    $mail->Body    = 'Click this link to reset your password: <a href="https://yourwebsite.com/reset.php?token=abc123">Reset Password</a>';

    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
