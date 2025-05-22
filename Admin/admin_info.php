<?php
session_start();
require_once "../common/config.php";

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $_SESSION['users_id'] = $userId;
  // echo "Logged in user ID: $userId";
} else {
  echo "User not loggeccf d in.";
}

$display_data = "select * from admin where id='$userId'";
$result_data = mysqli_query($con_query, $display_data);
$data = mysqli_fetch_assoc($result_data);
?>


<?php require_once "includes/header.php"; ?>


<?php require_once "includes/aside.php"; ?>

<style>
  .text-red {
    color: #dc3545 !important;
  }
</style>

<div class="row align-items-center mb-3">
  <div class="col-sm-6">
    <h3 class="mb-0 fw-semibold">Profile</h3>
  </div>
  <div class="col-sm-6">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-sm-end mb-0">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
      </ol>
    </nav>
  </div>
</div>



<div class="app-content">

  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4" style="height: 550px;">
          <div class="card-header with-border bg-primary">
            <h3 class="card-title" style="color: white;">Edit Profile </h3>
          </div>
          <div class="card-body">
            <div class="col-md-12 pad margin no-print">
              <div style="margin-bottom: 0!important;border-bottom: 1px solid black;" class="callout">
                <h4><i class="fa fa-info"></i> Note:</h4>
                Leave <strong>Password</strong> and <strong>Confirm Password</strong> empty if you are not
                going to
                change the password.
                <br>
                <span class="text-danger">*</span>
                If You want to change Password <strong> Old password </strong>is <strong>
                 required.</strong>
              </div>

            </div>
            <form id="update_form">
              <div class="row g-3 mt-3">
                <!-- Left Column: Username and Email -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="hidden" name="old_id" id="old_id" value="<?php echo  $data['id'];?>">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $data['username']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter email" value="<?php echo $data['email']; ?>">
                  </div>
                </div>

                <!-- Right Column: Password Fields -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="oldPassword" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter old password">
                    <div id="oldpassword_err" class="error"></div>
                    <div id="old_empty_err" class="error"></div>

                  </div>
                  <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password">
                    <div id="new_empty_err" class="error"></div>
                 
                 </div>
                  <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password">
                    <div id="confirm_err" class="error"></div>
                
                  </div>
                </div>

                <!-- Save Button -->
                <div class="col-12 text-end">
                  <button type="submit" class="btn btn-primary" name="update" id="update">Save</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Now your table -->


  </div>
</div>


 
<script>
  $(".delete").click(function(e) {
    e.preventDefault();
    let id = $(this).data("id");
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
        window.location.href = 'admin_delete.php?id=' + id;
      }
    });


  })



  $(".edit").click(function(e) {
    e.preventDefault();
    let id = $(this).data("id");
    $.ajax({
      url: "admin_fetch_data.php",
      type: "post",
      data: {
        id: id
      },
      success: function(res) {
        var data = JSON.parse(res);
        $("#myid").val(data.id);
        $("#e_name").val(data.username);
        $("#email").val(data.email);
      }
    })

  });



  // $("#update_user").click(function(e) {
  //   e.preventDefault();
  //   var form = document.getElementById("editForm");
  //   var formdata = new FormData(form);
  //   formdata.append("action", "update");
  //   $.ajax({
  //     url: "admin_update.php",
  //     type: "post",
  //     dataType: "json",
  //     data: formdata,
  //     processData: false,
  //     contentType: false,
  //     success: function(response) {
  //       if (response.code == 200) {
  //         //  $("#editModal").hide();  
  //         $('#editModal').modal('hide');
  //         Swal.fire({
  //           title: "Update Data SuccessFully!",
  //           icon: "success",
  //           draggable: true
  //         }).then(() => {
  //           location.reload();
  //         });

  //       } else {
  //         if (response.error.name) {
  //           $("#name_er").text(response.error.name);
  //         } else {
  //           $("#name_er").text("");
  //         }
  //         if (response.error.email) {
  //           $("#email_er").text(response.error.email);
  //         } else {
  //           $("#email_er").text("");
  //         }

  //       }
  //     }
  //   })

  // })

  $("#update").click(function(e) {
    e.preventDefault();
    var form= document.getElementById("update_form");
    var formdata = new FormData(form);
    formdata.append("action","update_admin");
    $.ajax({
      url:"category_data.php",
      type:"POST",
      dataType:"json",
      data:formdata,
      processData:false,
      contentType:false,
      success:function(data){
        console.log(data);
        if(data.code==200){
             Swal.fire({
            title: "Update Data SuccessFully!",
            icon: "success",
            draggable: true
          }).then(() => {
            location.reload();
          });

  //       }

        }
        else{
          // alert("error");
          // alert(data.errors.old_password);
          $("#oldpassword_err").text(data.errors.old_password);
          $("#confirm_err").text(data.errors.new_password);
          $("#new_empty_err").text(data.errors.new_empty);

          $("#old_empty_err").text(data.errors.old_empty);

          // alert(data.msg);
          // alert("something went wrong");
        }
 
 
       

      
      }
      
    })


  })
</script>
<?php require_once "includes/footer.php"; ?>