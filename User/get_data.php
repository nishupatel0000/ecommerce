
<?php
include_once '../common/config.php';

if (isset($_POST['action']) == "range_display") {

    if (isset($_POST['checkbox_value']) && $_POST['checkbox_value'] != NULL) {

        $seleced_value = $_POST['checkbox_value'];

        $min = min(array_map(function ($range) {
            return (int)explode('-', $range)[0];
        }, $seleced_value));
        $max = max(array_map(function ($range) {

            return (int)explode('-', $range)[1];
        }, $seleced_value));



        $category_select = "select * from product WHERE price BETWEEN '$min' AND '$max'";
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
return true;
    }
}

?>
