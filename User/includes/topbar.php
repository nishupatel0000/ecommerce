  <?php session_start();

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $_SESSION['users_id'] = $userId;
        // echo "Logged in user ID: $userId";
        // header("location:admin_info.php");
    } else {
        //   echo "User not logged in.";
    }
    ?>
  <div class="container-fluid">
      <div class="row bg-secondary py-1 px-xl-5">
          <div class="col-lg-6 d-none d-lg-block">
              <div class="d-inline-flex align-items-center h-100">
                  <a class="text-body mr-3" href="">About</a>
                  <a class="text-body mr-3" href="">Contact</a>
                  <a class="text-body mr-3" href="">Help</a>
                  <a class="text-body mr-3" href="">FAQs</a>
              </div>
          </div>
          <div class="col-lg-6 text-center text-lg-right">
              <div class="d-inline-flex align-items-center">
                  <div class="profile-dropdown">
                      <div class="profile-toggle">


                          <?php
                            if (!isset($_SESSION['user_id'])) {
                            ?>
                              <span class="profile-name" onclick="openAuthModal()">Login</span>



                          <?php

                            } else {
                            ?>
                              <span class="profile-name"><?php echo $_SESSION['name']; ?> <i class="fa fa-caret-down"></i></span>
                              <div class="profile-menu">
                                  <a href="/profile.php"><i class="fa fa-user"></i> My Profile</a>
                                  <a href="/orders.php"><i class="fa fa-box"></i> Orders</a>
                                  <a href="../user/wishlist.php"><i class="fa fa-heart"></i> Wishlist</a>
                                  <!-- <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a> -->
                                  <a href="#" id="logoutbtn" title="Logout">
                                      <i class="fa fa-sign-out-alt"></i> Logout
                                  </a>
                              </div>
                          <?php
                            }
                            ?>

                      </div>


                  </div>
                  <!-- <div class="btn-group mx-2">
                      <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                      <div class="dropdown-menu dropdown-menu-right">
                          <button class="dropdown-item" type="button">EUR</button>
                          <button class="dropdown-item" type="button">GBP</button>
                          <button class="dropdown-item" type="button">CAD</button>
                      </div>
                  </div>
                  <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                      <div class="dropdown-menu dropdown-menu-right">
                          <button class="dropdown-item" type="button">FR</button>
                          <button class="dropdown-item" type="button">AR</button>
                          <button class="dropdown-item" type="button">RU</button>
                      </div>
                  </div> -->
              </div>
              <div class="d-inline-flex align-items-center d-block d-lg-none">
                  <a href="" class="btn px-0 ml-2">
                      <i class="fas fa-heart text-dark"></i>
                      <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                  </a>
                  <a href="" class="btn px-0 ml-2">
                      <i class="fas fa-shopping-cart text-dark"></i>
                      <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                  </a>
              </div>
          </div>
      </div>
      <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
          <div class="col-lg-4">
              <a href="" class="text-decoration-none">
                  <span class="h1 text-uppercase text-primary bg-dark px-2">E</span>
                  <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shopping</span>
              </a>
          </div>
          <div class="col-lg-4 col-6 text-left">
              <form action="">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for products">
                      <div class="input-group-append">
                          <!-- <span class="input-group-text bg-transparent text-primary"> -->
                          <!-- <i class="fa fa-search"></i> -->
                          </span>
                      </div>
                  </div>
              </form>
          </div>
          <div class="col-lg-4 col-6 text-right">
              <p class="m-0">Customer Service</p>
              <h5 class="m-0">+012 345 6789</h5>
          </div>

      </div>

  </div>
  <div id="authModal" class="modal" style="display: none;">
      <div class="modal-box">
          <div class="left-box">
              <h2 id="authTitle">Login</h2>
              <p id="authSubtitle">Get access to your Orders, Wishlist and Recommendations</p>
          </div>
          <div class="right-box">
              <span class="close" onclick="closeAuthModal()">&times;</span>

              <!-- Login Form -->
              <form id="loginForm" action="login.php" method="POST">
                  <input type="email" name="email" placeholder="Enter Email"><br>
                  <span id="emailerr" class="error-msg"></span>
                  <span id="email_not_err" class="error-msg"></span>

                  <input type="password" name="password" placeholder="Enter Password" required><br>
                  <span id="passworderr" class="error-msg"></span>

                  <button type="submit" id="login_btn">Login</button>
                  <p>New here? <a href="#" onclick="toggleAuth('register')">Create an account</a></p>
              </form>

              <!-- Register Form -->
              <form id="registerForm" enctype="multipart/form-data" style="display: none;">
                  <input type="text" id="name" name="name" placeholder="Full Name" required><br>
                  <span id="name_error" class="error-msg"></span>
                  <input type="email" id="email" name="email" placeholder="Email Address" required>
                  <span id="email_error" class="error-msg"></span>
                  <input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile Number">
                  <span id="mobile_number_error" class="error-msg"></span>
                  <input type="password" id="password" name="password" placeholder="Password" required>
                  <span id="password_error" class="error-msg"></span>
                  <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                  <span id="confirm_password_error" class="error-msg"></span>
                  <input type="file" id="image" name="image" accept="image/*">
                  <span id="image_error" class="error-msg"></span>
                  <select id="device_type" name="device_type">
                      <option value="web">Web</option>
                      <option value="android">Android</option>
                      <option value="ios">iOS</option>
                  </select>
                  <span id="device_type_error" class="error-msg"></span>
                  <input type="text" id="device_token" name="device_token" placeholder="Device Token">
                  <span id="device_token_error" class="error-msg"></span>
                  <!-- <label>Status:</label><br>
                    <label><input type="radio" name="status" value="1" checked> Active</label>
                    <label><input type="radio" name="status" value="0"> Inactive</label><br> -->

                  <button type="submit" id="register">Register</button>

                  <p>Already have an account? <a href="#" onclick="toggleAuth('login')">Login here</a></p>
              </form>



          </div>
      </div>
  </div>




  <script>
      const toggle = document.querySelector('.profile-toggle');
      const menu = document.querySelector('.profile-menu');

      toggle.addEventListener('click', () => {
          menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
      });

      // Optional: Hide dropdown when clicking outside
      document.addEventListener('click', function(e) {
          if (!document.querySelector('.profile-dropdown').contains(e.target)) {
              menu.style.display = 'none';
          }
      });
  </script>

  <script>
      function openAuthModal() {
          document.getElementById('authModal').style.display = 'flex';
          toggleAuth('login'); // default
          document.body.style.overflow = 'hidden';
      }

      function closeAuthModal() {
          document.getElementById('authModal').style.display = 'none';
          document.body.style.overflow = '';
      }

      // Toggle between login and register
      function toggleAuth(mode) {
          const loginForm = document.getElementById('loginForm');
          const registerForm = document.getElementById('registerForm');
          const title = document.getElementById('authTitle');
          const subtitle = document.getElementById('authSubtitle');

          if (mode === 'register') {
              loginForm.style.display = 'none';
              registerForm.style.display = 'block';
              title.innerText = 'Register';
              subtitle.innerText = 'Create your account to start shopping';
          } else {
              loginForm.style.display = 'block';
              registerForm.style.display = 'none';
              title.innerText = 'Login';
              subtitle.innerText = 'Get access to your Orders, Wishlist and Recommendations';
          }
      }

      $(document).ready(function() {
          $("#register").click(function(e) {
              e.preventDefault();
              let form = document.getElementById("registerForm");
              let formdata = new FormData(form);
              formdata.append("action", "user_register");
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
                              title: "Your account has been created successfully!",
                              icon: "success",
                              draggable: true
                          }).then(() => {
                              location.reload();
                          });

                          $('#register').modal('hide');
                          // location.reload(true);
                      } else {
                          // console.log("hello");

                          // alert(data.errors);
                          if (data.errors.name) {
                              $("#name_error").text(data.errors.name);
                          } else {
                              $("#name_error").text("");
                          }

                          if (data.errors.email) {
                              $("#email_error").text(data.errors.email);
                          } else {
                              $("#email_error").text("");
                          }

                          if (data.errors.mobile_number) {
                              $("#mobile_number_error").text(data.errors.mobile_number);
                          } else {
                              $("#mobile_number_error").text("");
                          }

                          if (data.errors.password) {
                              $("#password_error").text(data.errors.password);
                          } else {
                              $("#password_error").text("");
                          }

                          if (data.errors.confirm_password) {
                              $("#confirm_password_error").text(data.errors.confirm_password);
                          } else {
                              $("#confirm_password_error").text("");
                          }

                          if (data.errors.image) {
                              $("#image_error").text(data.errors.image);
                          } else {
                              $("#image_error").text("");
                          }

                          if (data.errors.device_type) {
                              $("#device_type_error").text(data.errors.device_type);
                          } else {
                              $("#device_type_error").text("");
                          }

                          if (data.errors.device_token) {
                              $("#device_token_error").text(data.errors.device_token);
                          } else {
                              $("#device_token_error").text("");
                          }

                          if (data.errors.status) {
                              $("#status_error").text(data.errors.status);
                          } else {
                              $("#status_error").text("");
                          }

                      }
                  },
                  error: function(xhr, status, error) {
                      console.error("AJAX Error:", status, error);
                      console.error("Response:", xhr.responseText); // This shows the raw response
                  }



              });

          });


          $("#login_btn").click(function(e) {
              e.preventDefault();

              var form = document.getElementById("loginForm");
              var formdata = new FormData(form);
              formdata.append("action", "user_login");

              $.ajax({
                  url: "get_filter_data.php",
                  type: "post",
                  data: formdata,
                  processData: false,
                  contentType: false,
                  dataType: "json",
                  success: function(data) {
                      if (data.code == 200) {
                          // alert(data.code); 
                          // $('#authModal').modal('hide');
                          closeAuthModal(); 
                          setTimeout(function() {
                              location.reload();
                          }, 300);
                      } else {



                          if (data.error.email) {
                              $("#emailerr").text(data.error.email);
                          } else {
                              $("#emailerr").text("");
                          }

                          if (data.error.password) {
                              $("#passworderr").text(data.error.password);
                          } else {
                              $("#passworderr").text("");
                          }

                          if (data.error.notfound) {
                              $("#email_not_err").text(data.error.notfound);
                          } else {
                              $("#email_not_err").text("");
                          }

                      }
                  }


              })
          })


          $("#logoutbtn").click(function(e) {
              e.preventDefault();
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You will be logged out.",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: 'Yes, log out',
                  cancelButtonText: 'Cancel'
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Redirect to logout.php
                      window.location.href = 'logout.php';
                  }
              });
          });

      })
  </script>