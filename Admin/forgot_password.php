<?php
session_start();

$message = '';
if (isset($_SESSION['email'])) {
    $message = $_SESSION['email'];
    unset($_SESSION['email']);
}

// if(!isset($_SESSION['user_id'])){
//     header("location:index.php");
// }
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

        .message {
            margin-top: 12px;
            text-align: left;
            font-size:17px;
            color: #d93025;
            /* Optional: red for errors */
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Trouble logging in?</h2>
        <p>Enter your email and we'll send you a link to get back into your account.</p>
        <form action="verify-password.php" method="POST">
            <input type="email" name="email" placeholder="Email address">
            <div class="message">
                <?php echo $message; ?>
            </div>
            <button type="submit" name="submit">Send Login Link</button>
        </form>
        <a href="index.php" class="back-login">Back to Login</a>
    </div>

</body>

</html>
<?php
session_unset();
session_destroy();

?>