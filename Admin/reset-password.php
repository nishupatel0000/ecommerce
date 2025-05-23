<?php

require_once '../common/config.php';
$error = "";
if (
    isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
    && ($_GET["action"] == "reset") && !isset($_POST["action"])
) {
    $key = $_GET["key"];
    $email = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");
    $query = mysqli_query(
        $con_query,
        "SELECT * FROM `password_reset_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "';"
    );
    $row = mysqli_num_rows($query);
    if ($row == NULL) {
        $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="http://localhost/Eshopping/Admin/forgot_password.php">
Click here</a> to reset password.</p>';
    } else {
        $row = mysqli_fetch_assoc($query);
        $expDate = $row['expDate'];
        if ($expDate >= $curDate) {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <title>Reset Password</title>
                <style>
                    body {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background-color: #f0f2f5;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                    }

                    .reset-container {
                        background-color: #fff;
                        padding: 40px 30px;
                        border-radius: 10px;
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                        width: 360px;
                    }

                    .reset-container h2 {
                        margin-bottom: 20px;
                        font-weight: 500;
                        text-align: center;
                        color: #333;
                    }

                    .reset-container label {
                        display: block;
                        margin: 10px 0 5px;
                        font-weight: 500;
                        color: #444;
                    }

                    .reset-container input[type="password"] {
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 6px;
                        font-size: 14px;
                    }

                    .reset-container input[type="submit"] {
                        width: 100%;
                        padding: 12px;
                        margin-top: 20px;
                        background-color: #007bff;
                        border: none;
                        color: white;
                        font-weight: bold;
                        border-radius: 6px;
                        cursor: pointer;
                        font-size: 15px;
                    }

                    .reset-container input[type="submit"]:hover {
                        background-color: #0056b3;
                    }

                    .note {
                        font-size: 12px;
                        color: #888;
                        text-align: center;
                        margin-top: 10px;
                    }

                    .toast {
                        visibility: hidden;
                        min-width: 300px;
                        background-color: #4BB543;
                        color: #fff;
                        text-align: center;
                        border-radius: 8px;
                        padding: 16px;
                        position: fixed;
                        z-index: 1;
                        left: 50%;
                        bottom: 30px;
                        transform: translateX(-50%);
                        font-size: 16px;
                        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
                        animation: fadein 0.5s, fadeout 0.5s 3s;
                    }

                    .toast.show {
                        visibility: visible;
                    }

                    @keyframes fadein {
                        from {
                            bottom: 0;
                            opacity: 0;
                        }

                        to {
                            bottom: 30px;
                            opacity: 1;
                        }
                    }

                    @keyframes fadeout {
                        from {
                            bottom: 30px;
                            opacity: 1;
                        }

                        to {
                            bottom: 0;
                            opacity: 0;
                        }
                    }
                </style>
            </head>

            <body>
                <div class="reset-container">
                    <h2>Reset Your Password</h2>
                    <form method="post" action="">
                        <input type="hidden" name="action" value="update" />
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" required>
                        <?php if (!empty($error)) : ?>
                            <div class="field-error" style="color: red; margin-top: 10px;">
                                <?=  $error; ?>
                            </div>
                        <?php endif; ?>

                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_new_password" required>

                        <input type="hidden" name="email" value="<?php echo $email; ?>" />
                        <input type="submit" value="Reset Password">
                    </form>
                    <div class="note">Make sure your new password is strong.</div>
                </div>
            </body>

            </html>
<?php
        } else {

            $error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
        }
    }
    if ($error != "") {
        echo "<div class='error'>" . $error . "</div><br />";
    }
} // isset email key validate end


if (
    isset($_POST["email"]) && isset($_POST["action"]) &&
    ($_POST["action"] == "update")
) {
    $error = "";
    $new_password =  mysqli_real_escape_string($con_query, $_POST["new_password"]);
    $confirm_new_password = mysqli_real_escape_string($con_query, $_POST["confirm_new_password"]);
    $email = $_POST["email"];
    $curDate = date("Y-m-d H:i:s");
    $select_password = "select * from admin where password = '$new_password'";
    $result_password = mysqli_query($con_query, $select_password);
    $data = mysqli_fetch_assoc($result_password);



    if ($new_password != $confirm_new_password) {
        $error .= " 
       Passwords do not match, both passwords should be the same.
            ";
    }
    if ($error != "") {
        echo "<div class='container mt-3'><div class='alert alert-danger'>$error</div></div>";
    } else {
        $new_password = md5($new_password);
        mysqli_query(
            $con_query,
            "UPDATE `admin` SET `password`='" . $new_password . "' 
WHERE `email`='" . $email . "';"
        );

        mysqli_query($con_query, "DELETE FROM `password_reset_temp` WHERE `email`='" . $email . "';");
        session_start();
        $_SESSION['toast'] = "Password has been reset successfully!";
        header("Location: http://localhost/Eshopping/Admin/index.php");
        exit();
    }
}


?>