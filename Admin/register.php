
<!-- register -->
<?php

require_once '../common/config.php';




?>
<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Admin Register </title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="AdminLTE 4 | Register Page" />
  <meta name="author" content="ColorlibHQ" />
  <meta
    name="description"
    content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
  <meta
    name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
  <!--end::Primary Meta Tags-->
  <!--begin::Fonts-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
    crossorigin="anonymous" />
  <!--end::Fonts-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="assets/css/adminlte.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!--end::Required Plugin(AdminLTE)-->
  <link rel="icon" href="assets/img/favicon.jpg">
  <style>
    .alert {
      padding: 15px 20px;
      margin: 20px 0;
      border-radius: 6px;
      font-size: 16px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      position: relative;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease-in-out;
      opacity: 0.9;
      animation: fadeIn 0.5s ease-in-out;
      z-index: 1000;


    }

    .error {
      color: red;
      font-size: 18px;
      font-weight: 10px;
      margin-top: 10px;
      

    }

    .error-alert {
      background-color: #ffe5e5;
      color: #b30000;
      border: 1px solid #ffcccc;
    }

    .alert::before {
      content: "⚠️ ";
      margin-right: 8px;
      font-weight: bold;
    }
  </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="register-page bg-body-secondary">
  <div class="register-box">
    <div class="register-logo">
      <a href="#"><b>Register </b></a>

    </div>
    <!-- /.register-logo -->
    <div class="card">
      <div class="card-body register-card-body">

        <form method="POST" id="user_register">



          <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" />

            <div class="input-group-text"><span class="bi bi-person"></span></div>

          </div>
          <b id="nameerr" class="error"></b>

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" id="email" name="email" />
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            <div class="error-msg"></div>

          </div>
          <b id="emailerr" class="error"></b>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" id="password" name="password" />
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>

          </div>
          <b id="passworderr" class="error"></b>

          <!--begin::Row-->
          <div class="row">
            <div class="col-8">
              <div class="form-check">
                <!-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree to the <a href="#">terms</a>
                  </label> -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <div class="d-grid gap-2">
                <!-- <button type="submit" class="btn btn-primary">Register</button> -->
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->
        </form>
        <!-- <div class="social-auth-links text-center mb-3 d-grid gap-2">
          <p>- OR -</p>
          <a href="#" class="btn btn-primary">
            <i class="bi bi-facebook me-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-danger">
            <i class="bi bi-google me-2"></i> Sign in using Google+
          </a>
        </div> -->
        <!-- /.social-auth-links -->
        <p class="mb-0">
          <a href="index.php" class="text-center" style="text-decoration: none;"> I already have account </a>
        </p>
      </div>
      <!-- /.register-card-body -->
    </div>
  </div>
  <!-- /.register-box -->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
    crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="assets/js/adminlte.js"></script>

  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>

</body>
<script>
  $("#submit").click(function(e) {
    e.preventDefault();
    var form = document.getElementById("user_register");
    var formdata = new FormData(form);
    formdata.append("action", "register");

    $.ajax({
      url: "insert_admin.php",
      type: "post",
      data: formdata,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function(data) {
        if (data.code == 200) {
          window.location.href = "index.php";
        } else {
         
          if (data.error.name) {
            $("#nameerr").text(data.error.name);
          } else {
            $("#nameerr").text("");
          }

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

        }
      }


    })
  })
</script>

<!--end::Body-->

</html>