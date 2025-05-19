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
