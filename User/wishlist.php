<?php
$pageTitle = "Products - Shop the Latest Fashion & Deals";
include_once 'includes/header.php';
include_once '../common/config.php';
include_once 'includes/topbar.php';
include_once 'includes/navbar.php';

?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>

                <span class="breadcrumb-item active">Wishlist</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <?php
                        if (isset($_SESSION['user_id'])) {

                            $id = $_SESSION['user_id'];
                            $category_select = "select p.* from product as p join  wishlist w on p.product_id = w. product_id  where w.user_id = '$id'";
                            $result_select = mysqli_query($con_query, $category_select);
                            if (mysqli_num_rows($result_select) > 0) {

                        ?>
                                <th>Products</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Remove </th>


                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php

                                while ($data = mysqli_fetch_assoc($result_select)) {



                    ?>
                        <tr>
                            <td class="align-middle"><img src="../Admin/assets/img/product/<?php echo $data['image']; ?>" alt="" style="width: 50px;"> </td>
                            <td class="align-middle"><?php echo  $data['name']; ?></td>
                            <td class="align-middle"><?php echo "₹" . $data['price']; ?></td>
                            <td class="align-middle"><a href="#" class="btn btn-danger  ">
                                    <i class="fas fa-trash-alt"></i>
                                </a></td>






                        </tr>




                </tbody>
    <?php
                                }
                            } else {
                                echo '
    <div class="col-12 d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
        <img src="assets/images/empty_wishlist.png" alt="Empty Wishlist" style="width: 180px; margin-bottom: 20px;">
        <h4 class="text-muted">Your wishlist is empty!</h4>
        <p class="text-secondary">Add items that you like to your wishlist. Review them anytime and easily move them to the cart.</p>
        <a href="shop.php" class="btn btn-primary mt-3">Start Shopping</a>
    </div>';
                            }
                        }
    ?>
            </table>
        </div>

    </div>
</div>


<!-- Cart End -->


<!-- Footer Start -->
<?php
include_once 'includes/footer.php';
?>