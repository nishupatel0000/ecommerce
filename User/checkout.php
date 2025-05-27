<?php
$pageTitle = "Cart - Shop the Latest Fashion & Deals";
include_once 'includes/header.php';
include_once '../common/config.php';
include_once 'includes/topbar.php';
include_once 'includes/navbar.php';
$subtotal = 0;

?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
    <form id="checkoutForm" name="checkoutForm">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Billing Address</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="first_name">First Name</label>
                            <input class="form-control" type="text" id="first_name" name="first_name" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="last_name">Last Name</label>
                            <input class="form-control" type="text" id="last_name" name="last_name" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="text" id="billing_email" name="billing_email" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="mobile">Mobile No</label>
                            <input class="form-control" type="text" id="mobile" name="mobile" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="address1">Address Line 1</label>
                            <input class="form-control" type="text" id="address1" name="address1" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="address2">Address Line 2</label>
                            <input class="form-control" type="text" id="address2" name="address2" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="country">Country</label>
                            <select class="custom-select" id="country" name="country">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                                <option>India</option>

                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="city">City</label>
                            <input class="form-control" type="text" id="city" name="city" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="state">State</label>
                            <input class="form-control" type="text" id="state" name="state" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="zip">ZIP Code</label>
                            <input class="form-control" type="text" id="zip" name="zip" placeholder="123">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount" name="newaccount">
                                <label class="custom-control-label" for="newaccount">Create an account</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="hidden" name="ship_to_different" id="ship_to_different" value="0">

                                <input type="checkbox" class="custom-control-input" id="shipto" name="shipto">
                                <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse mb-5" id="shipping-address">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Shipping Address</span>
                    </h5>
                    <div class="bg-light p-30">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="shipping_first_name">First Name</label>
                                <input class="form-control" type="text" id="shipping_first_name" name="shipping_first_name" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_last_name">Last Name</label>
                                <input class="form-control" type="text" id="shipping_last_name" name="shipping_last_name" placeholder="Doe">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_email">E-mail</label>
                                <input class="form-control" type="text" id="shipping_email" name="shipping_email" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_mobile">Mobile No</label>
                                <input class="form-control" type="text" id="shipping_mobile" name="shipping_mobile" placeholder="+123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_address1">Address Line 1</label>
                                <input class="form-control" type="text" id="shipping_address1" name="shipping_address1" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_address2">Address Line 2</label>
                                <input class="form-control" type="text" id="shipping_address2" name="shipping_address2" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_country">Country</label>
                                <select class="custom-select" id="shipping_country" name="shipping_country">
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_city">City</label>
                                <input class="form-control" type="text" id="shipping_city" name="shipping_city" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_state">State</label>
                                <input class="form-control" type="text" id="shipping_state" name="shipping_state" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="shipping_zip">ZIP Code</label>
                                <input class="form-control" type="text" id="shipping_zip" name="shipping_zip" placeholder="123">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Order Total</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        $id = $_SESSION['user_id'];
                        $subtotal = 0;

                        $category_select = "SELECT p.*,c.* FROM product as p 
                            JOIN cart as c ON p.product_id = c.product_id  
                            WHERE c.user_id = '$id'";
                        $result_select = mysqli_query($con_query, $category_select);

                        if (mysqli_num_rows($result_select) > 0) {
                    ?>
                            <div class="border-bottom">
                                <h6 class="mb-3">Products</h6>
                                <?php while ($data = mysqli_fetch_assoc($result_select)) {
                                    $product_total = ($data['price'] - $data['discount_amount']) * $data['quantity'];
                                    $subtotal += $product_total;
                                ?>
                                    <div class="d-flex justify-content-between">
                                        <p><?php echo $data['name']; ?></p>
                                        <p>₹<?php echo $product_total; ?></p>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="border-bottom pt-3 pb-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6>Subtotal</h6>
                                    <h6>₹<?php echo $subtotal; ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Shipping</h6>
                                    <h6 class="font-weight-medium">₹10</h6>
                                </div>
                            </div>

                            <div class="pt-2">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5>Total</h5>
                                    <h5>₹<?php echo $subtotal + 10; ?></h5>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Payment</span>
                    </h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold py-3 order_btn">Place Order</button>

                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- Checkout End -->

<script>
    $(document).ready(function() {
        $(".order_btn").click(function(e) {
            e.preventDefault();
            let form = document.getElementById("checkoutForm");
            let formdata = new FormData(form);
            formdata.append("action", "billing_insert");
            $.ajax({

                url: "get_filter_data.php",
                type: "post",
                dataType: "json",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 200) {
                        Swal.fire({
                            title: "Your addredsd has been saved successfully",
                            icon: "success",
                            draggable: true
                        }).then(() => {
                            location.reload();
                        });


                        // location.reload(true);
                    } else {

                        if (data.errors.category_type) {
                            $("#category_type_error").text(data.errors.category_type);
                        } else {
                            $("#category_type_error").text("");
                        }
                        if (data.errors.category_image) {
                            $("#category_image_error").text(data.errors.category_image);
                        } else {
                            $("#category_image_error").text("");
                        }
                    }
                }

            });


        })
    })
</script>

<?php
include_once 'includes/footer.php';
?>