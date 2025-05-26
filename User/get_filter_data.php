<?php
session_start();
include_once '../common/config.php';


if (isset($_POST['action']) && $_POST['action'] === "filter_display") {
    $query = "SELECT p.* FROM product AS p
              LEFT JOIN colors AS c ON p.color_id = c.color_id
              WHERE 1=1";


    if (!empty($_POST['prices'])) {
        $ranges = $_POST['prices'];

        $priceConditions = [];
        foreach ($ranges as $range) {
            // var_dump($ranges);
            // die();

            $value = explode("-", $range);



            if (empty($value[1])) {
                $priceConditions[] = "(p.price > $value[0] )";
            } else {
                // if(is$max)
                $priceConditions[] = "(p.price BETWEEN $value[0] AND $value[1])";
            }
        }
        $query .= " AND (" . implode(" OR ", $priceConditions) . ")";
    }


    if (!empty($_POST['colors'])) {
        $colors = array_map(function ($color) use ($con_query) {
            return "'" . mysqli_real_escape_string($con_query, $color) . "'";
        }, $_POST['colors']);
        $query .= " AND c.color_name IN (" . implode(",", $colors) . ")";
    }


    if (!empty($_POST['genders'])) {
        $genders = array_map(function ($g) use ($con_query) {
            return "'" . mysqli_real_escape_string($con_query, $g) . "'";
        }, $_POST['genders']);
        $query .= " AND p.gender IN (" . implode(",", $genders) . ")";
    }


    $result = mysqli_query($con_query, $query);
    $products = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        echo json_encode(['code' => 200, 'data' => $products]);
    } else {
        echo json_encode(['code' => 204, 'data' => []]);
    }
}




if (isset($_POST['action']) && $_POST['action'] == "color_filter") {


    if (isset($_POST['colors']) && $_POST['colors'] != NULL) {

        $selected_colors = $_POST['colors'];

        $escaped_colors = array_map(function ($color) use ($con_query) {
            return "'" . mysqli_real_escape_string($con_query, $color) . "'";
        }, $selected_colors);

        $color_list = implode(",", $escaped_colors);


        // $category_select = "SELECT * FROM product WHERE color  IN ($str_selected_value)";
        $category_select =  "SELECT c.color_name,p.* from colors As c JOIN product AS p on p.color_id = c.color_id where color_name In ($color_list)";
    } else {
        $category_select = "SELECT * FROM product";
    }

    $result_select = mysqli_query($con_query, $category_select);

    if ($result_select && mysqli_num_rows($result_select) > 0) {
        while ($result = mysqli_fetch_assoc($result_select)) {
            $row[] = $result;
        }

        $data = [
            'code' => 200,
            'msg'  => "Data displayed successfully!",
            'data' => $row,
        ];
    } else {
        $data = [
            'code' => 204,
            'msg'  => "No data found.",
            'data' => [],
        ];
    }

    echo json_encode($data);
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == "gender_range") {
    $category_select = "SELECT * FROM product";

    if (isset($_POST['checkbox_gender_value']) && $_POST['checkbox_gender_value'] != NULL) {
        $selected_value = $_POST['checkbox_gender_value'];
        $escaped_gender = array_map(function ($gender) use ($con_query) {
            return "'" . mysqli_real_escape_string($con_query, $gender) . "'";
        },   $selected_value);

        $gender_list = implode(",", $escaped_gender);




        $category_select .= " WHERE  gender In  ($gender_list)";
    }

    $result_select = mysqli_query($con_query, $category_select);
    if ($result_select && mysqli_num_rows($result_select) > 0) {
        while ($result = mysqli_fetch_assoc($result_select)) {
            $row[] = $result;
        }

        $output = [
            'code' => 200,
            'msg'  => "Data displayed successfully!",
            'data' => $row,
        ];
    } else {
        $output = [
            'code' => 204,
            'msg'  => "No data found.",
            'data' => [],
        ];
    }

    echo json_encode($output);
    exit;
}


if ($_POST['action'] == "user_register") {


    if (empty($_POST['name'])) {
        $error['name'] = ' * name is required';
    } else {

        $name = $_POST['name'];
    }


    if (empty($_POST['email'])) {
        $error['email'] = ' * email is required';
    } else {

        $email = $_POST['email'];
    }


    if (empty($_POST['mobile_number'])) {
        $error['mobile_number'] = ' * mobile number is required';
    } else {

        $mobile_number = $_POST['mobile_number'];
    }

    if (empty($_POST['password'])) {
        $error['password'] = ' * password is required';
    } else {

        $password = md5($_POST['password']);
    }



    if (empty($_FILES['image']['name'])) {
        $error['image'] = " * Image is empty";
    } else {



        $fileTmpPath = $_FILES['image']['tmp_name'];
        $originalName = $_FILES['image']['name'];
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


        $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);


        $newFileName = $randomName . '.' . $fileExt;

        $uploadDir = '../Admin/assets/img/user/';

        $destPath = $uploadDir . $newFileName;


        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
    }

    if (empty($_POST['device_type'])) {
        $error['device_type'] = ' * device type  is required';
    } else {

        $device_type = $_POST['device_type'];
    }

    if (empty($_POST['device_token'])) {
        $error['device_token'] = ' * device token  is required';
    } else {

        $device_token = $_POST['device_token'];
    }

    if (!empty($error)) {
        $allerror = [

            'errors' => $error

        ];
        echo json_encode($allerror);
        return false;
    } else {

        $insert_category = "insert into user(name,mobile,email,password,image,device_type,device_token)values('$name','$mobile_number', '$email','$password','$newFileName','$device_type','$device_token')";
        $result_category = mysqli_query($con_query, $insert_category);


        if ($result_category) {

            move_uploaded_file($fileTmpPath, $destPath);

            $data = [
                "status" => 200,
                "msg" => " Category saved successfully",
            ];
            echo json_encode($data);
            return true;
        }
    }
}



if ($_POST['action'] == "user_login") {


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
    $sel_data = "select * from user where email= '$email'";

    // die();
    $res = mysqli_query($con_query, $sel_data);
    if (mysqli_num_rows($res) > 0) {


        $data = mysqli_fetch_assoc($res);

        $old_email = $data['email'];
        $old_password =  $data['password'];
        $_SESSION['email'] = $data['email'];


        if ($email == $old_email &&  $password == $old_password) {

            // if ($email == $old_email && $password == $old_password) {

            $_SESSION['user_id'] = $data['id'];
            $_SESSION['name'] = $data['name'];


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


if ($_POST['action'] == "wishlist") {

    if (!isset($_SESSION['user_id'])) {

        $err = [
            "code" => 403,
            "err" => "user is not logged in"
        ];
        echo json_encode($err);
        return false;
        //     // header("location:admin_info.php");

    } else {

        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];

 $cart  = "select * from wishlist where user_id = '$user_id' and  product_id= '$product_id '";

        $cart_result = mysqli_query($con_query, $cart);
        $cart_data = mysqli_fetch_assoc($cart_result);

        if ($output = mysqli_num_rows($cart_result) > 0) {
            
            if ($output) {
             
                $result = [
                    "code" => 404,
                    "msg" => "Already added to wishlist!",

                ];
                echo json_encode($result);
                return false;
            }
            // Already in cart — no action
        } 
        else{

        $insert_wishlist = "insert into wishlist(user_id,product_id)values('$user_id','$product_id')";
        $result_wishlist = mysqli_query($con_query, $insert_wishlist);
        if ($result_wishlist) {


            $result = [
                "code" => 200,
                "msg" => "Added to wishlist!",
                "id" =>  $user_id
            ];
            echo json_encode($result);
            return true;
        } else {
            echo json_encode("insert error");
            return false;
        }
    }
    }
} else if ($_POST['action'] == "remove") {

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $query = "DELETE FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
    if (mysqli_query($con_query, $query)) {
        echo json_encode(['status' => 'removed']);
    } else {
        echo json_encode(['error' => 'Delete failed']);
    }
} else if ($_POST['action'] == "add_cart") {


    if (!isset($_SESSION['user_id'])) {

        $err = [
            "code" => 403,
            "err" => "user is not logged in"
        ];
        echo json_encode($err);
        return false;
        //     // header("location:admin_info.php");

    }

    else{

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

        $cart  = "select * from cart where user_id = '$user_id' and  product_id= '$product_id '";

        $cart_result = mysqli_query($con_query, $cart);
        $cart_data = mysqli_fetch_assoc($cart_result);

        if ($output = mysqli_num_rows($cart_result) > 0) {
            
            if ($output) {
             
                $result = [
                    "code" => 404,
                    "msg" => "Already added to cart!",

                ];
                echo json_encode($result);
                return false;
            }
            // Already in cart — no action
        } else {
            $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
            $insert_query =  mysqli_query($con_query, $insert_query);
            if ($insert_query) {
                $result = [
                    "code" => 200,
                    "msg" => "Added to cart!",
                    "id" =>  $user_id
                ];
                echo json_encode($result);
                return true;
            }
        }
    }
}
