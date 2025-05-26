for checkbox select 
   $(".custom-control-input").on("change", function(e) {
             e.preventDefault();
             let selectedValues = [];



             if ($('#price-all').is(':checked')) {

                 $('input[name="price_range[]"]').prop('checked', true);

                 selectedValues.push('all');
             } else {
                 $('input[name="price_range[]"]').prop('checked', false);
                 $('input[name="price_range[]"]:checked').each(function() {
                     selectedValues.push($(this).val());
                 });
             }




             <!-- for displaying after select  -->

             <?php
require_once '../common/config.php';

if ($_POST['checkbox_value'] == NULL) {


    $seleced_value = $_POST['checkbox_value'];
    print_r($seleced_value) . "<br>";


    $min = min(array_map(function ($range) {
        return (int)explode('-', $range)[0];
    }, $seleced_value));


    $max = max(array_map(function ($range) {

        return (int)explode('-', $range)[1];
    }, $seleced_value));



    $select_query = "SELECT * FROM product WHERE price BETWEEN '$min' AND '$max'";

    $result_query = mysqli_query($con_query, $select_query);
    if ($row = mysqli_num_rows($result_query)) {
        while (($data = mysqli_fetch_assoc($result_query))) {

            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
    }
} 

else {
    echo "not set";
}


//  wisglist backend 
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
        $check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $check_result = mysqli_query($con_query, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            
            
            $result = [
                "code" => 409, 
                "msg" => "Already in wishlist!",
            ];
            echo json_encode($result);
            return false;
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
} else {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $query = "DELETE FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
    if (mysqli_query($con_query, $query)) {
        echo json_encode(['status' => 'removed']);
    } else {
        echo json_encode(['error' => 'Delete failed']);
    }
}