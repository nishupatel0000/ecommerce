  <?php
    include_once '../common/config.php';
    ?>


  <div class="container-fluid bg-dark mb-30">
      <div class="row px-xl-5">
          <div class="col-lg-3 d-none d-lg-block">
              <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                  <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                  <i class="fa fa-angle-down text-dark"></i>
              </a>
              <?php

                ?>
              <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                  <div class="navbar-nav w-100">
                      <?php
                        $category_select = "select * from categories";
                        $result_select = mysqli_query($con_query, $category_select);
                        if (mysqli_num_rows($result_select) > 0) {
                            while ($data = mysqli_fetch_assoc($result_select)) {
                        ?>
                              <div class="nav-item dropdown dropright">
                                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $data['category_name']; ?><i class="fa fa-angle-right float-right mt-1"></i></a>
                                  <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                      <a href="shop.php?men_cloth=<?php echo $data['id'] ?>" class="dropdown-item">Men's <?php echo $data['category_name']; ?></a>
                                      <a href="shop.php?women_cloth=<?php echo $data['id'] ?>" class="dropdown-item">Women's <?php echo $data['category_name']; ?></a>
                                      <a href="shop.php?baby_cloth=<?php echo $data['id'] ?>" class="dropdown-item">Baby's <?php echo $data['category_name']; ?></a>
                                  </div>
                              </div>
                              <!-- <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a> -->

                      <?php
                            }
                        }
                        ?>
                  </div>
              </nav>
          </div>
          <div class="col-lg-9">
              <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                  <a href="" class="text-decoration-none d-block d-lg-none">
                      <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                      <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                  </a>
                  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                      <div class="navbar-nav mr-auto py-0">
                          <a href="index.php" class="nav-item nav-link active">Home</a>
                          <a href="shop.php" class="nav-item nav-link">Shop</a>
                          <!-- <a href="detail.php" class="nav-item nav-link">Shop Detail</a> -->
                          <div class="nav-item dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                              <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                  <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                  <a href="checkout.php" class="dropdown-item">Checkout</a>
                              </div>
                          </div>
                          <a href="contact.php" class="nav-item nav-link">Contact</a>
                      </div>
                      <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                          <a href="wishlist.php" class="btn px-0">
                              <i class="fas fa-heart text-primary"></i>

                              <?php
                                $wishlistCount = 0;
                                if (isset($_SESSION['user_id'])) {

                                    $id = $_SESSION['user_id'];
                                    $category_select = "select count(id) as wishlist_id  from wishlist where user_id = '$id'";
                                    $result_select = mysqli_query($con_query, $category_select);
                                    $data = mysqli_fetch_assoc($result_select);
                                }

                                ?>


                              <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                  <?= isset($_SESSION['user_id']) ? $data['wishlist_id'] : 0 ?>
                              </span>
                          </a>

                          <a href="cart.php" class="btn px-0 ml-3">
                              <i class="fas fa-shopping-cart text-primary"></i>
                              <?php
                                $wishlistCount = 0;
                                if (isset($_SESSION['user_id'])) {

                                    $id = $_SESSION['user_id'];
                                    $category_select = "select count(id) as cart_id  from cart where user_id = '$id'";
                                    $result_select = mysqli_query($con_query, $category_select);
                                    $data = mysqli_fetch_assoc($result_select);
                                }

                                ?>
                              <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                  <?= isset($_SESSION['user_id']) ? $data['cart_id'] : 0 ?>

                              </span>
                          </a>
                      </div>
                  </div>
              </nav>
          </div>
      </div>
  </div>