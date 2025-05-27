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
        } else {

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
        $result = [
            "code" => 200,
            "msg" => "Product Removed From  Wishlist!",
            "id" =>  $user_id
        ];
        echo json_encode($result);
        return true;
    } else {
        $result = [
            "code" => 404,
            "msg" => "Failed to delete",

        ];
        echo json_encode($result);
        return false;
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

    } else {

        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $price_id = $_POST['price_id'];
        $discount = $_POST['discount_price'];



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
            $insert_query = "INSERT INTO cart (user_id, product_id,price,quantity,discount_amount) VALUES ($user_id, $product_id,$price_id, 1,'$discount')";
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


if ($_POST['action'] == "delete_cart") {
    $id  = $_POST['id'];



    $del_cart = "delete from cart  where id = '$id'";
    $del_result = mysqli_query($con_query, $del_cart);

    if ($del_result) {
        $output =
            [
                'msg' => "Product  deleted from cart successfully",
            ];
        echo json_encode($output);
    }
}

if ($_POST['action'] == "qty_update") {
    $id = $_POST['quantity'];






    mysqli_query($con_query, "UPDATE cart SET quantity = quantity + 1 WHERE id = $id");
    $result = mysqli_query($con_query, "SELECT quantity FROM cart WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $new_qty_value = $row['quantity'];
    $discount = $_POST['discount'];
    $price = $_POST['price'];

    $total = $new_qty_value * ($price - $discount);

    if ($row) {
        $output =
            [
                "code" => 200,
                "msg"   => "value is updated",
                "quantity" => $row['quantity'],
                "total" => $total
            ];
        echo json_encode($output);
        return true;
    } else {
        echo json_encode(['code' => 400, 'msg' => "not updated"]);
    }
}


if ($_POST['action'] == "qty_decrease") {
    $id = $_POST['quantity']; // Cart ID
    $discount = $_POST['discount'];
    $price = $_POST['price'];

    // First, get current quantity
    $result = mysqli_query($con_query, "SELECT quantity FROM cart WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['quantity'];

    if ($current_qty > 1) {
        // Decrease quantity by 1
        mysqli_query($con_query, "UPDATE cart SET quantity = quantity - 1 WHERE id = $id");

        // Get updated quantity
        $result = mysqli_query($con_query, "SELECT quantity FROM cart WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
        $new_qty_value = $row['quantity'];

        $total = $new_qty_value * ($price - $discount);

        echo json_encode([
            "code" => 200,
            "msg" => "Quantity decreased",
            "quantity" => $new_qty_value,
            "total" => $total
        ]);
    } else {
        echo json_encode(["code" => 400, "msg" => "Minimum quantity reached"]);
    }
}












if ($_POST['action'] == "billing_insert") {

    $error = [];
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
        $created_at = date('Y-m-d H:i:s');
        $billing_type = 'billing';
        $shipping_type = 'shipping';
 $ship_to_different = isset($_POST['ship_to_different']) ? $_POST['ship_to_different'] : '0';

        // Billing Fields
        if (empty($_POST['first_name'])) {
            $error['first_name'] = ' * First name is required';
        } else {
            $first_name = $_POST['first_name'];
        }

        if (empty($_POST['last_name'])) {
            $error['last_name'] = ' * Last name is required';
        } else {
            $last_name = $_POST['last_name'];
        }

        if (empty($_POST['billing_email'])) {
            $error['billing_email'] = ' * Email is required';
        } else {
            $email = $_POST['billing_email'];
        }

        if (empty($_POST['mobile'])) {
            $error['mobile'] = ' * Mobile number is required';
        } else {
            $mobile = $_POST['mobile'];
        }

        if (empty($_POST['address1'])) {
            $error['address1'] = ' * Address Line 1 is required';
        } else {
            $address1 = $_POST['address1'];
        }

        if (empty($_POST['address2'])) {
            $error['address2'] = ' * Address Line 2 is required';
        } else {
            $address2 = $_POST['address2'];
        }

        if (empty($_POST['country'])) {
            $error['country'] = ' * Country is required';
        } else {
            $country = $_POST['country'];
        }

        if (empty($_POST['city'])) {
            $error['city'] = ' * City is required';
        } else {
            $city = $_POST['city'];
        }

        if (empty($_POST['state'])) {
            $error['state'] = ' * State is required';
        } else {
            $state = $_POST['state'];
        }

        if (empty($_POST['zip'])) {
            $error['zip'] = ' * ZIP code is required';
        } else {
            $zip = $_POST['zip'];
        }

        if (!empty($error)) {
            $allerror = ['errors' => $error];
            echo json_encode($allerror);
            return false;
        }

        // Insert Billing Address
        $insert_billing = "INSERT INTO addresses (user_id, type, first_name, last_name, email, mobile_no, address_line1, address_line2, country, city, state, zip_code, created_at)
        VALUES ('$user_id', '$billing_type', '$first_name', '$last_name', '$email', '$mobile', '$address1', '$address2', '$country', '$city', '$state', '$zip', '$created_at')";

        $result_billing = mysqli_query($con_query, $insert_billing);

        // Only if checkbox is checked: insert shipping address
        if ($ship_to_different == '1') {

            if (empty($_POST['shipping_first_name'])) {
                $error['shipping_first_name'] = ' * First name is required';
            } else {
                $shipping_first_name = $_POST['shipping_first_name'];
            }

            if (empty($_POST['shipping_last_name'])) {
                $error['shipping_last_name'] = ' * Last name is required';
            } else {
                $shipping_last_name = $_POST['shipping_last_name'];
            }

            if (empty($_POST['shipping_email'])) {
                $error['shipping_email'] = ' * Email is required';
            } else {
                $shipping_email = $_POST['shipping_email'];
            }

            if (empty($_POST['shipping_mobile'])) {
                $error['shipping_mobile'] = ' * Mobile number is required';
            } else {
                $shipping_mobile = $_POST['shipping_mobile'];
            }

            if (empty($_POST['shipping_address1'])) {
                $error['shipping_address1'] = ' * Address Line 1 is required';
            } else {
                $shipping_address1 = $_POST['shipping_address1'];
            }

            if (empty($_POST['shipping_address2'])) {
                $error['shipping_address2'] = ' * Address Line 2 is required';
            } else {
                $shipping_address2 = $_POST['shipping_address2'];
            }

            if (empty($_POST['shipping_country'])) {
                $error['shipping_country'] = ' * Country is required';
            } else {
                $shipping_country = $_POST['shipping_country'];
            }

            if (empty($_POST['shipping_city'])) {
                $error['shipping_city'] = ' * City is required';
            } else {
                $shipping_city = $_POST['shipping_city'];
            }

            if (empty($_POST['shipping_state'])) {
                $error['shipping_state'] = ' * State is required';
            } else {
                $shipping_state = $_POST['shipping_state'];
            }

            if (empty($_POST['shipping_zip'])) {
                $error['shipping_zip'] = ' * ZIP code is required';
            } else {
                $shipping_zip = $_POST['shipping_zip'];
            }

            if (!empty($error)) {
                $allerror = ['errors' => $error];
                echo json_encode($allerror);
                return false;
            }

            $insert_shipping = "INSERT INTO addresses (user_id, type, first_name, last_name, email, mobile_no, address_line1, address_line2, country, city, state, zip_code, created_at)
            VALUES ('$user_id', '$shipping_type', '$shipping_first_name', '$shipping_last_name', '$shipping_email', '$shipping_mobile', '$shipping_address1', '$shipping_address2', '$shipping_country', '$shipping_city', '$shipping_state', '$shipping_zip', '$created_at')";

            mysqli_query($con_query, $insert_shipping);
        }

        $data = [
            "status" => 200,
            "msg" => "Address saved successfully"
        ];
        echo json_encode($data);
        return false;
    }
}
