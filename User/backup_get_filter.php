<?php
include_once '../common/config.php';

if (isset($_POST['action']) && $_POST['action'] == "range_display") {
    $category_select = "SELECT * FROM product";

    if (isset($_POST['checkbox_value']) && $_POST['checkbox_value'] != NULL) {
        $seleced_value = $_POST['checkbox_value'];

        $min = min(array_map(function ($range) {
            return (int)explode('-', $range)[0];
        }, $seleced_value));

        $max = max(array_map(function ($range) {
            return (int)explode('-', $range)[1];
        }, $seleced_value));

        $category_select .= " WHERE price BETWEEN '$min' AND '$max'";
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


if (isset($_POST['action']) && $_POST['action'] == "color_filter") {


    if (isset($_POST['colors']) && $_POST['colors'] != NULL) {

        $selected_colors = $_POST['colors'];

        $escaped_colors = array_map(function ($color) use ($con_query) {
            return "'" . mysqli_real_escape_string($con_query, $color) . "'";
        }, $selected_colors);

        $color_list = implode(",", $escaped_colors);


        // $category_select = "SELECT * FROM product WHERE color  IN ($str_selected_value)";
        $category_select =  "SELECT c.color_name,p.* from colors As c JOIN product AS p on p.color_id = c.color_id where color_name In ($color_list)";
    
        
    }
    else{
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
