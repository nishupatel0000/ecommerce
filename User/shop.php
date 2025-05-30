<?php
// $loginRequired = false;
// if (!isset($_SESSION['user_id'])) {
//     $loginRequired = true;
//     // echo "Logged in user ID: $userId";
//     // header("location:admin_info.php");

// } else {
//     $user_id = $_SESSION['user_id'];
// }






$pageTitle = "Products - Shop the Latest Fashion & Deals";
include_once 'includes/header.php';
include_once '../common/config.php';
include_once 'includes/topbar.php';
include_once 'includes/navbar.php';



if (isset($_GET['category_id'])) {
    $category_name = $_GET['category_name'];
    $category_id = $_GET['category_id'];
} elseif (isset($_GET['men_cloth']) || isset($_GET['women_cloth']) || isset($_GET['baby_cloth'])) {
    // echo "hii";
    $men_cloth = isset($_GET['men_cloth']);
    $women_cloth = isset($_GET['women_cloth']);
    $baby_cloth = isset($_GET['baby_cloth']);
}




?>




<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <span class="breadcrumb-item active">Shop List</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <?php include_once 'includes/shop_sidebar.php' ?>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container" id="price_data">
                    <div class="row"> <!-- Row to hold all products -->
                        <?php
                        // $category_select = "SELECT * FROM product  JOIN categories  ON product.cat_id = categories.id WHERE categories.category_name = '$category_name'";
                        $category_select = "select * from product";

                        if (isset($_GET['category_id'])) {
                            $category_select .= " WHERE product.cat_id = " . (int)$_GET['category_id'];
                        }

                        if (isset($_GET['men_cloth'])) {
                            $category_id = (int)$_GET['men_cloth'];
                            $category_select .= " JOIN categories ON product.cat_id = categories.id WHERE product.gender = 'male' AND categories.id = $category_id";
                        }

                        if (isset($_GET['women_cloth'])) {
                            $category_id = (int)$_GET['women_cloth'];
                            $category_select .= " JOIN categories ON product.cat_id = categories.id WHERE product.gender = 'female' AND categories.id = $category_id";
                        }


                        if (isset($_GET['baby_cloth'])) {
                            $category_id = (int)$_GET['baby_cloth'];
                            $category_select .= " JOIN categories ON product.cat_id = categories.id WHERE product.gender = 'baby' AND categories.id = $category_id";
                        }




                        $result_select = mysqli_query($con_query, $category_select);
                        $row = mysqli_num_rows($result_select);
                      // display old  wishlist code  -- start 

                        $userWishlist = [];
                        if ($rows = mysqli_num_rows($result_select) > 0) {

                            while ($data = mysqli_fetch_assoc($result_select)) {
                                if (isset($_SESSION['user_id'])) {
                                    $user_id = $_SESSION['user_id'];
                                    $products_id = $data['product_id'];
                                    $select_wishlist = "select p.product_id,p.price,p.discount_price from product as p join wishlist w on p.product_id = w.product_id where w.user_id = '$user_id'";
                                    $result_wishlist = mysqli_query($con_query, $select_wishlist);
                                    // if($rows=mysqli_num_rows($result_wishlist)){
                                    while ($row = mysqli_fetch_assoc($result_wishlist)) {
                                        $userWishlist[] = $row['product_id'];
                                    }

                                    // }

                                }

                        ?>
                                <!-- Product Item -->
                                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <div id="wishlistToast" class="custom-toast"></div>
                                            <img class="img-fluid w-100" style="max-height: 280px; object-fit: cover;" src="../Admin/assets/img/product/<?php echo $data['image']; ?>" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="javascript:void(0)"><i class="fa fa-shopping-cart shopping-cart" data-product-id="<?php echo $data['product_id']; ?>"  data-price-id="<?php echo $data['price']; ?>"  data-discount-price="<?php echo $data['discount_price']; ?>"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="javascript:void(0)">
                                                    <?php
                                                    $isInWishlist = in_array($data['product_id'], $userWishlist);


                                                    ?>
                                                    <i class="fa-heart wishlist-icon <?php echo $isInWishlist ? 'fas text-danger' : 'far'; ?>" data-product-id="<?php echo $data['product_id']; ?>" data-price="<?php echo $data['price']; ?>"></i>
                                                </a>
                                                <!--  end here old wishlist value  -->
                                                <a class="btn btn-outline-dark btn-square" href="detail.php?id=<?php echo $data['product_id']; ?>"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href=""><?php echo $data['name']; ?></a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5><?php echo "₹" . $data['price']; ?></h5>
                                                <h6 class="text-muted ml-2"><del>4500</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small>(99)</small>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                        <?php

                            }
                        } else {
                            echo "No records available";
                        }


                        ?>
                        <div id="wishlistToast" class="custom-toast">Added to wishlist!</div>
                    </div> <!-- End of Row -->
                </div> <!-- End of Container -->



                <div class="col-12" id="pagination">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
<script>
    $(document).on("click", ".wishlist-icon", function() {
        var $icon = $(this);
        var product_id = $icon.data("product-id");
        const isAdding = !$icon.hasClass('fas');

        // Toggle class after checking
        $icon.toggleClass('fas text-danger far');

        $.ajax({
            url: "get_filter_data.php",
            type: "POST",
            dataType: "json",
            data: {
                action: isAdding ? "wishlist" : "remove",
                product_id: product_id,
            },
            success: function(data) {
                if (data.code == 200 || data.code == 404) {
              
                    showWishlistMessage(data.msg);
                } else {
                    document.getElementById("authModal").style.display = "flex";
                }
            }
        });
    });



    function showWishlistMessage(msg = "Added to wishlist!") {
        const toast = document.getElementById("wishlistToast");
        toast.innerText = msg;
        toast.style.display = "block";

        setTimeout(() => {
            toast.style.display = "none";
        }, 2500);
    }


    $(document).on("click", ".shopping-cart", function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var priceId = $(this).data('price-id');
        var discount_price = $(this).data('discount-price');


        $.ajax({
            url: 'get_filter_data.php',
            type: 'POST',
            dataType: "JSON",
            data: {
                action: "add_cart",
                product_id: productId,
                price_id:priceId,
                discount_price:discount_price
            },
            success: function(response) {
                if (response.code == 200) {
                    showWishlistMessage(response.msg);
                } else {
                    // alert(response.code);
                    showWishlistMessage(response.msg);
                }
            }
        });
    });
</script>
<!-- Footer Start -->
<?php
include_once 'includes/footer.php';

?>