<?php
session_start();
// echo json_encode("hello");
require_once '../common/config.php';
if ($_POST['action'] == "register") {


    if (empty($_POST['name'])) {
        $error['name'] = "* name is required";
    } else if (strlen($_POST['name']) < 6) {
        $error['name'] = "Nameshould be minimum 6 characters";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['email'])) {
        $error['email'] = "* Email is required";
    } else {
        $email = $_POST['email'];
    }
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/";

    if (empty($_POST['password'])) {
        $error['password'] = "* Password is required";
    } else if (!preg_match($pattern, $_POST['password'])) {
        $error['password'] = "* Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%^&*).";
    } else {
        $password = md5($_POST['password']);
    }

    if (!empty($error)) {
        $allerror = [
            "code" => 400,
            "error" => $error
        ];

        echo json_encode($allerror);
        return false;
    } else {
        $ins_query = "insert into admin(name,email,password)values('$name','$email','$password')";
        $result = mysqli_query($con_query, $ins_query);
        if ($result) {
            $output = [
                "code" => 200,
                "msg" => "Your insert has inserted successfully"
            ];
            echo json_encode($output);
            return true;
        } else {
            $txt = [
                "code" => 403,
                "msg" => "something went wrong"
            ];
            echo json_encode($txt);
            return false;
        }
    }
}
if ($_POST['action'] == "admin_login") {


    if (empty($_POST['email'])) {
        $error['email'] = "* Email is required";
    } else {
        $email = $_POST['email'];
    }
    if (empty($_POST['password'])) {
        $error['password'] = "* password is required";
    } else {
        $password = md5($_POST['password']);
         
     
    }

    if (!empty($error)) {
        $err = [
            'code' => 400,
            'error'  => $error
        ];
        echo json_encode(($err));
        return false;
    }
    $sel_data = "select * from admin where email= '$email'";
    $res = mysqli_query($con_query, $sel_data);
    if (mysqli_num_rows($res) > 0) {
        $data = mysqli_fetch_assoc($res);
        $old_email = $data['email'];
        $old_password =  $data['password'];
        $_SESSION['email'] = $data['email'];

        if ($email == $old_email &&  $password == $old_password) {
        // if ($email == $old_email && $password == $old_password) {

            $_SESSION['user_id'] = $data['id'];

            $result = [
                "code" => 200,
                "msg" => "User logged in successfully"
            ];

            echo json_encode($result);
            return true;
        }
    }

    $error['notfound'] = "* Email Id or Password not match";
    $allerror = [
        "code" => 400,
        "error" => $error
    ];

    echo json_encode($allerror);
    return false;
}
  