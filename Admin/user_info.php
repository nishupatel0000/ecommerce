  <?php
  session_start();
  require_once '../common/config.php';
  require_once 'includes/header.php';

  require_once 'includes/aside.php';



  ?>
  <style>
    #myTable1 {
      margin-top: 63px;
    }

    .btn_user {
      display: flex;
      justify-content: flex-end;
      margin-right: 10px;
    }

    .btn {
      height: 50px;
    }

    .error {
      color: red;
      font-size: 18px;

    }
  </style>
  <div class="row align-items-center mb-3">
    <div class="col-sm-6">
      <h3 class="mb-0 fw-semibold">User </h3>
    </div>
    <div class="col-sm-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-sm-end mb-0">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4" style="height: 2000px;">
        <div class="card-header">
          List of User
          <div class="mb-4 btn_user">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newuser">
              <i class="fa fa-plus"></i>&nbsp; Add New User
            </button>
          </div>
        </div>
        <div class="card-body">
          <!-- Modal -->
          <div class="modal fade" id="newuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form id="add_user">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">

                      <label for="name_user" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name_user" name="firstname" placeholder="Minimum 6 characters">
                      <div id="name" class="error"></div>
                    </div>

                    <div class="mb-3">
                      <label for="email_user" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Enter Your Email">
                      <div id="email_err" class="error"></div>

                    </div>
                    <div class="mb-3">
                      <label for="password_user" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password_user" name="password_user" autocomplete="current-password"  placeholder="Enter Your Password">
                      <div id="password_err" class="error"></div>

                    </div>
                    <div class="mb-3">
                      <label for="mobile_user" class="form-label">Mobile</label>
                      <input type="text" class="form-control" id="mobile_user" name="mobileno_user" placeholder="918596785748">
                      <div id="mobileno_err" class="error"></div>

                    </div>



                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <input type="submit" class="btn btn-primary" name="submit" value="Add User" id="add_user_btn">
                  </div>
                </div>
              </form>
            </div>
          </div>

          <table id="myTable" class="table table-striped table-bordered" border="1px" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>

                <th scope="col">Email</th>
                <th scope="col">Mobile No</th>

                <th scope="col">Operation</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_SESSION['update'])) {
                $msg = addslashes($_SESSION['update']);
                echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({   
                    title: 'Update!',
                    text: '$msg',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
                unset($_SESSION['update']);
              }


              ?>

            </tbody>
          </table>


          <!-- View Modal -->
          <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="viewModalLabel">User Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-sm">
                        <p><strong>Name:</strong> <span id="modal-user-name"></span></p>
                        <p><strong>Email:</strong> <span id="modal-user-email"></span></p>
                        <p><strong>Mobile No:</strong> <span id="modal-user-mobile"></span></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form method="POST" id="edit_user">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id" id="myid">
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="e_name" name="name"  placeholder="Enter Your Name">
                      <div id="name_er" class="error"></div>
                    </div>
                    <div class="mb-3">

                      <div id="username_er" class="error"></div>

                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email"   placeholder="Enter Your Email" >
                      <div id="email_er" class="error"></div>

                    </div>
                    <div class="mb-3">
                      <label for="mobile" class="form-label">Mobile</label>
                      <input type="text" class="form-control" id="mobile" name="mobileno"   placeholder="Enter Your Mobile Number">
                      <div id="mobile_er" class="error"></div>

                    </div>

                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                    <input type="submit" class="btn btn-primary" name="update" id="update_user" value="Update">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    $(document).ready(function() {
      $(document).on("click", ".edit", function() {
        var userId = $(this).data("id");

        $.ajax({
          url: 'fetch_data.php',
          type: 'POST',
          data: {
            id: userId
          },
          success: function(response) {

            var userDetails = JSON.parse(response);
            $("#myid").val(userDetails.id);

            $("#e_name").val(userDetails.name);
            $("#e_username").val(userDetails.username);
            $("#email").val(userDetails.email);
            $("#mobile").val(userDetails.mobileno);
            $("#vehicle_no").val(userDetails.vehicle_no);
            $("#vehicle_type").val(userDetails.vehicle_type);
          },
          error: function() {
            alert("Error fetching user details.");
          }
        });
      });

      $(document).on("click", ".view", function() {
        var userId = $(this).data("id");
          $("#spinner").show();
        $.ajax({
          url: 'fetch_user_details.php',
          type: 'POST',
          data: {
            id: userId
          },
          success: function(response) {
            var userDetails = JSON.parse(response);
            $("#modal-user-name").text(userDetails.name);
            $("#modal-user-username").text(userDetails.username);
            $("#modal-user-email").text(userDetails.email);
            $("#modal-user-mobile").text(userDetails.mobileno);
            $("#modal-user-vehicle_no").text(userDetails.vehicle_no);
            $("#modal-user-vehicle_type").text(userDetails.vehicle_type);
           },

          error: function() {
            alert("Error fetching user details.");
          }
        });
      });
      // $(".delete").click(function(e) {
      $(document).on("click", ".delete", function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        Swal.fire({
          title: 'Are you sure?',
          text: "You are about to delete this user.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e3342f',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "delete.php",
              type: "POST",
              data: {
                "id": id
              },
              success: function(data) {
                Swal.fire("Delete Successfully!", "", "success")
                  .then(() => {
                    location.reload();
                  });
              }
            });

            // Swal.fire("Delete Successfully!", "", "success")
            //   .then(() => {
            //     // location.reload();
            //   });

            // window.location.href = 'delete.php?id=' + id;
          }
        });
      });
      $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'display.php',
        columns: [{
            data: 'id'
          },
          {
            data: 'name'
          },
          {
            data: 'email'
          },



          {
            data: 'mobile'
          },

          {
            data: null,
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
              return `
            <button class="btn btn-primary edit" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#editModal"> <i class="fa fa-edit"></i></button>
            <button class="btn btn-danger delete" data-id="${row.id}">  <i class="fa fa-trash"></i></button>
            <button class="btn btn-warning view" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#viewModal"> <i class="fa fa-eye" aria-hidden="true"></i></button>
          `;
            }
          }
        ],




      });

    });

    $(".delete").click(function(e) {
      e.preventDefault(); // prevent default link behavior if it's an <a> tag
      alert("fff");

      var id = $(this).data("id"); // get data-id

      Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this user.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Delete Successfully!", "", "success")
            .then(() => {
              location.reload();
            });
          $.ajax({
            url: "delete.php",
            type: "POST",
            data: {

              "id": id
            },
            success: function(data) {}
          });
        }
      });

    });

    $(document).ready(function() {
      $("#add_user_btn").click(function(e) {
        e.preventDefault()
        var form = document.getElementById('add_user');
        var formData = new FormData(form);
        formData.append("action", "user_insert");
        $.ajax({
          url: "add_user.php",
          type: "POST",
          dataType: "json",
          data: formData,
          processData: false,
          contentType: false,
          success: function(data) {
            if (data.status == 200) {
              Swal.fire({
                title: "User has been saved successfully!",
                icon: "success",
                draggable: true
              }).then(() => {
                location.reload();
              });
              $('#newuser').modal('hide');
              // location.reload();
              // $("#newuser").hide();


              // $")
            } else {
              if (data.errors.name) {
                $("#name").text(data.errors.name);
              } else {

                $("#name").text("");
              }
              if (data.errors.username) {
                $("#username").text(data.errors.username);
              } else {

                $("#username").text("");
              }
              if (data.errors.email) {
                $("#email_err").text(data.errors.email);
              } else {
                $("#email_err").text("");

              }
              if (data.errors.password) {
                $("#password_err").text(data.errors.password);
              } else {
                $("#password_err").text("");

              }
              if (data.errors.mobileno) {
                $("#mobileno_err").text(data.errors.mobileno);
              } else {

                $("#mobileno_err").text("");
              }
              if (data.errors.vehicle_no) {
                $("#vehicle_no_err").text(data.errors.vehicle_no);
              } else {

                $("#vehicle_no_err").text("");
              }
              if (data.errors.vehicle_type) {
                $("#vehicle_type_err").text(data.errors.vehicle_type);
              } else {
                $("#vehicle_type_err").text("");
              }
            }
          }
        });
      });
    });

    $("#update_user").click(function(e) {
      e.preventDefault();
      var editform = document.getElementById('edit_user');

      var formdata = new FormData(editform);
      formdata.append("action", "update_user");
      $.ajax({
        url: "add_user.php",
        type: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(res) {
          if (res.code == 200) {
            //  $("#editModal").hide();  
            $('#editModal').modal('hide');
            Swal.fire({
              title: "Update Data SuccessFully!",
              icon: "success",
              draggable: true
            }).then(() => {
              location.reload();
            });

          } else {
            // alert(res.errors.email);

            if (res.errors.name) {
              $("#name_er").text(res.errors.name);
            } else {
              $("#name_er").text("");
            }
            if (res.errors.email) {
              $("#email_er").text(res.errors.email);
            } else {
              $("#email_er").text("");
            }
            if (res.errors.mobileno) {
              $("#mobile_er").text(res.errors.mobileno);
            } else {
              $("#mobile_er").text("");
            }
          }
        }
      });

    });
  </script>
  <?php
  require_once 'includes/footer.php';

  ?>