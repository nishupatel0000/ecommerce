<?php
require_once '../common/config.php';

if (isset($_POST['filters'])) {
    // Get the selected filters
    $filters = $_POST['filters']; // An array of selected filters (price, color, gender)

    // Example of building the SQL query based on selected filters
    $query = "SELECT * FROM product";

    // Add conditions based on filters
    if (in_array("0-100", $filters)) {
        $query .= " AND price BETWEEN 0 AND 100";
    }
    if (in_array("color_red", $filters)) {
        $query .= " AND color = 'red'";
    }
    if (in_array("gender_men", $filters)) {
        $query .= " AND gender = 'men'";
    }

    // Execute the query
    $result = mysqli_query($con_query, $query);
    
    // Check if any products match
    if (mysqli_num_rows($result) > 0) {
        $productsHtml = '';

        // Loop through the products and generate HTML for them
        while ($row = mysqli_fetch_assoc($result)) {
            $productsHtml .= "<div class='product'>";
            $productsHtml .= "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "' />";
            $productsHtml .= "<p>" . $row['name'] . "</p>";
            $productsHtml .= "<p>$" . $row['price'] . "</p>";
            $productsHtml .= "</div>";
        }

        // Return the products in JSON format
        echo json_encode(['success' => true, 'productsHtml' => $productsHtml]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No products found']);
    }
}
?>
