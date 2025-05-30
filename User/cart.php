<?php
$pageTitle = "Cart - Shop the Latest Fashion & Deals";
include_once 'includes/header.php';
include_once '../common/config.php';
include_once 'includes/topbar.php';
include_once 'includes/navbar.php';
$total = 0;
$subtotal = 0;
$shipping = 0;

?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>

                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <?php
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $category_select = "SELECT  p.*,c.* FROM product as p join  cart as c on p.product_id = c.product_id  WHERE c.user_id = '$id'";

            // $category_select = "SELECT * FROM  cart  WHERE cart.user_id = '$id'";

            $result_select = mysqli_query($con_query, $category_select);

            if (mysqli_num_rows($result_select) > 0) {
        ?>
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php
                            while ($data = mysqli_fetch_assoc($result_select)) {
                                $product_total = ($data['price'] - $data['discount_amount']) * $data['quantity'];
                                $subtotal += $product_total;
                            ?>


                                <tr>
                                    <td class="align-middle"><img src=".././Admin/assets/img/product/<?php echo $data['image']; ?>" alt="" style="width: 50px;"><?php echo  $data['name']; ?></td>
                                    <td class="align-middle"><?php echo "₹" . $data['price']; ?></td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" data-id="<?= $data['id'] ?>" data-price="<?= $data['price'] ?>"
                                                    data-qty="<?php echo $data['quantity']; ?>" data-discount="<?= $data['discount_amount'] ?>"><i class="fa fa-minus"></i></button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm bg-secondary border-0 text-center quantity-input"
                                                id="qty-<?= $data['id'] ?>"
                                                value="<?= $data['quantity'] ?? 1 ?>"

                                                readonly>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus" data-id="<?= $data['id'] ?>" data-price="<?= $data['price'] ?>"
                                                    data-qty="<?php echo $data['quantity']; ?>" data-discount="<?= $data['discount_amount'] ?>"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="align-middle" id="total-<?= $data['id'] ?>">

                                        <?php
                                        $discount_per_item = $data['discount_amount'];
                                        $quantity = $data['quantity'];
                                        $price = $data['price'];
                                        $total = ($data['price'] -   $discount_per_item)*   $quantity;
                                        echo  "₹" . $total;
                                        
                                $product_total = ($data['price'] - $data['discount_amount']) * $data['quantity'];

                                        ?>

                                    </td>

                                    <td class="align-middle"><button class="btn btn-sm btn-danger delete_cart" data-id="<?php echo $data['id']; ?>"><i class="fa fa-times"></i></button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4">
                    <!-- <form class="mb-30" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form> -->
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Cart Summary</span>
                    </h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                
                                <h6><?php
                                  echo  "₹".$subtotal;

                                ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">0</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5><?php echo "₹". $subtotal + $shipping ; ?></h5>
                            </div>
                          <a href="checkout.php"> <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button></a> 
                        </div>
                    </div>
                </div>

        <?php
            } else {
                echo '
                <div class="col-12 d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                    <img src="assets/images/empty_wishlist.png" alt="Empty Cart" style="width: 180px; margin-bottom: 20px;">
                    <h4 class="text-muted">Your cart is empty!</h4>
                    <p class="text-secondary">Add items that you like to your cart. Review them anytime and easily checkout.</p>
                    <a href="shop.php" class="btn btn-primary mt-3">Start Shopping</a>
                </div>';
            }
        }
        ?>
    </div>
</div>
<!-- Cart End -->

<script>
    $(document).ready(function() {
        $(".delete_cart").click(function(e) {
            e.preventDefault();
            const cart_id = $(this).data("id");
            Swal.fire({
                title: "Are you sure?",
                text: "Do You Want to delete this record? !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {


                    $.ajax({
                        url: "get_filter_data.php",
                        type: "POST",
                        data: {
                            "action": "delete_cart",
                            "id": cart_id
                        },
                        success: function(data) {
                            Swal.fire("Product removed from cart Successfully!", "", "success")
                                .then(() => {
                                    location.reload();
                                });
                        }
                    });
                }
            });

        })


    })
</script>


<script>
    $('.btn-plus').click(function() {
        let id = $(this).data('id');
        let price = $(this).data('price');
        let discount = $(this).data('discount');

        let input = $('#qty-' + id);
        let quantity = parseInt(input.val());

        if (quantity < 9) {


            $.ajax({
                url: 'get_filter_data.php',
                type: 'POST',
                dataType: "JSON",
                data: {
                    action: "qty_update",
                    quantity: id,
                    discount: discount,
                    price: price

                },
                success: function(response) {
                    if (response.code == 200) {

                        $("#qty").val(response.quantity);

                        $('#total-' + id).text('₹' + response.total);

                    } else {
                        // alert(response.code);
                        showWishlistMessage(response.msg);
                    }
                }
            });
        } else {
            $(this).prop('disabled', true);
        }

    });

    $('.btn-minus').click(function() {
        let id = $(this).data('id');
        let price = $(this).data('price');
        let discount = $(this).data('discount');

        let input = $('#qty-' + id);
        let quantity = parseInt(input.val());

        if (quantity > 1) {
            $.ajax({
                url: 'get_filter_data.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    action: 'qty_decrease',
                    quantity: id,
                    discount: discount,
                    price: price
                },
                success: function(response) {
                    if (response.code == 200) {
                        input.val(response.quantity); // Update quantity input
                        $('#total-' + id).text('₹' + response.total); // Update total

                        $('.btn-plus[data-id="' + id + '"]').prop('disabled', false);


                        if (response.quantity <= 1) {
                            $('.btn-minus[data-id="' + id + '"]').prop('disabled', true);
                        }
                    } else {
                        alert(response.msg);
                    }
                }
            });
        } else {
            $(this).prop('disabled', true); // Disable minus if at min quantity
        }
    });
</script>

<?php
include_once 'includes/footer.php';
?>