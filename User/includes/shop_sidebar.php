 <?php
    $sql = "SELECT COUNT(*) as count_products,MIN(price) AS min_price, MAX(price) AS max_price FROM product";
    $result = $con_query->query($sql);
    $row = $result->fetch_assoc();

    $min_price = (int)$row['min_price'];
    $max_price = (int)$row['max_price'];
    $count = $row['count_products'];

    $range_count = 5; // Default 5 ranges
    $range_span = $max_price - $min_price;

    // Step 2: Calculate step size
    $step = ceil($range_span / $range_count);

    // Optional: round step to nearest 50 or 100 for cleaner UX
    function roundToNiceStep($value)
    {
        if ($value <= 100) return ceil($value / 50) * 50;
        return ceil($value / 100) * 100;
    }
    $step = roundToNiceStep($step);

    // Step 3: Build 5 ranges
    $ranges = [];
    $start = floor($min_price / $step) * $step;
    $last_range_max = $start + ($range_count - 1) * $step + $step - 1;

    for ($i = 0; $i < $range_count; $i++) {
        $from = $start + ($i * $step);
        $to = $from + $step - 1;
        $ranges[] = ['from' => $from, 'to' => $to];
    }


    $check_from = $ranges[$range_count - 1]['to'];
    $sql = "SELECT COUNT(*) AS more_count FROM product WHERE price > $check_from";
    $result = $con_query->query($sql);
    $row = $result->fetch_assoc();
    $more_count = (int)$row['more_count'];


    if ($more_count > 0 && $more_count <= 10) {
        $ranges[] = ['from' => $check_from + 1, 'to' => null]; // 6th range: "more"
    } elseif ($more_count > 10) {

        $step += 50;
        $ranges = [];
        for ($i = 0; $i < $range_count; $i++) {
            $from = $start + ($i * $step);
            $to = $from + $step - 1;
            $ranges[] = ['from' => $from, 'to' => $to];
        }

        $check_from = $ranges[$range_count - 1]['to'];
        $sql = "SELECT COUNT(*) AS more_count FROM product WHERE product_price > $check_from";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $more_count = (int)$row['more_count'];
        if ($more_count > 0 && $more_count <= 10) {
            $ranges[] = ['from' => $check_from + 1, 'to' => null];
        }
    }

    ?>
 <div class="col-lg-3 col-md-4">
     <p id="GFG_DOWN">
         <!-- Price Start -->
     <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
     <div class="bg-light p-4 mb-30">
         <form id="slider_form">
             <!-- All Prices Option -->
             <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                 <input type="checkbox" class="custom-control-input" id="price-all" name="price_range[]" value="all">
                 <label class="custom-control-label" for="price-all">All Prices</label>
                 <span class="badge border font-weight-normal">
                     <?php echo   $count ?>
                 </span>
             </div>

             <!-- Dynamically Generated Price Ranges -->
             <?php
                foreach ($ranges as $range) {
                    if ($range['to'] === null) {
                        $label = $range['from'] . "+";
                        $value = $range['from'] . "-more";
                        $sql = "SELECT COUNT(*) AS cnt FROM product WHERE price > {$range['from']}";
                    } else {
                        $label = "{$range['from']} - {$range['to']}";
                        $value = "{$range['from']}-{$range['to']}";
                        $sql = "SELECT COUNT(*) AS cnt FROM product WHERE price BETWEEN {$range['from']} AND {$range['to']}";
                    }

                    // Generate a unique ID for the checkbox
                    $id = "price_range_" . preg_replace('/[^a-zA-Z0-9]/', '_', $value);
                    $range_label = $label;
                    $result = $con_query->query($sql);

                    $row = $result->fetch_assoc();
                    $count = (int)$row['cnt'];

                    echo "
<div class=\"custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3\">
    <input type=\"checkbox\" class=\"custom-control-input\" id=\"price_all_$value\" name=\"price_range[]\" value=\"$value\">
    <label class=\"custom-control-label\" for=\"price_all_$value\">$range_label</label>
    <span class=\"badge border font-weight-normal\">$count</span>
</div>
";
                }
                ?>

     </div>
     <!-- Price End -->

     <!-- Color Start -->
     <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
     <div class="bg-light p-4 mb-30">
         <form>



             <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                 <input type="checkbox" class="custom-control-input" checked id="color-all">
                 <label class="custom-control-label" for="color-all">All Color</label>
                 <span class="badge border font-weight-normal">1000</span>
             </div>
             <?php
                $select_home = "SELECT color_name, COUNT(color_name) AS color_count FROM colors GROUP BY color_name";
                $result = mysqli_query($con_query, $select_home);
                while ($data = mysqli_fetch_assoc($result)) {
                    $color_name = $data['color_name'];
                    $color_count = $data['color_count'];
                    // Create a unique and safe ID
                    $id = "color_" . strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $color_name));
                ?>

                 <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                     <input type="checkbox" class="custom-control-input" id="<?php echo $id; ?>" value="<?php echo $color_name; ?>">
                     <label class="custom-control-label" for="<?php echo $id; ?>"><?php echo $color_name; ?></label>
                     <span class="badge border font-weight-normal"> <?php echo $color_count ?></span>

                 </div>
             <?php
                }
                ?>
         </form>
     </div>
     <!-- Color End -->

     <!-- Size Start -->



     <h5 class="section-title position-relative text-uppercase mb-3">
         <span class="bg-secondary pr-3">Filter by Gender</span>
     </h5>
     <div class="bg-light p-4 mb-30">
         <form>
             <?php
                $select_home = "SELECT DISTINCT gender FROM product";
                $result = mysqli_query($con_query, $select_home);
                while ($data = mysqli_fetch_assoc($result)) {
                    $gender = $data['gender'];
                    // Create a unique and safe ID
                    $id = "gender_" . strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $gender));
                ?>
                 <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                     <input type="checkbox" class="custom-control-input checkbox_buttons" id="<?php echo $id; ?>" name="gender[]" value="<?php echo $gender; ?>">
                     <label class="custom-control-label" for="<?php echo $id; ?>"><?php echo $gender; ?></label>
                     <span class="badge border font-weight-normal"></span>
                 </div>
             <?php
                }
                ?>
         </form>
     </div>

     <!-- Size End -->
 </div>

 <script>
     $(document).ready(function() {

         $(".custom-control-input").on("change", function(e) {
             e.preventDefault();
             let selectedValues = [];


             $('input[name="price_range[]"]:checked').each(function() {
                 selectedValues.push($(this).val());
                 if (selectedValues.length) {
                     if (selectedValues != "all") {




                     } else {
                         selectedValues = "";
                     }
                 } else {
                     $('#GFG_DOWN')
                         .text("Checkbox is not selected, Please select one!");
                 }
             });



             $.ajax({
                 url: "shop.php",
                 type: "POST",
                //  dataType: "json",
                 data: {
                     action: "range_display",
                     checkbox_value: selectedValues
                 },

                 success: function(data) {
                     alert("hello");
                    console.log(data);
                     if (data.code == 200) {
                         console.log("Success result:", data.data);
                     }
                 },
                 error: function(xhr, status, error) {
                    console.log("error");
                     console.error("AJAX error:", status, error);
                     console.log("Response text:", xhr.responseText); 
                 }

             })






         });

     });
 </script>