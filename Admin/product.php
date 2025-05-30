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
    <h3 class="mb-0 fw-semibold"> Product </h3>
  </div>
  <div class="col-sm-6">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-sm-end mb-0">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Product</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4" style="height: 2000px;">
      <div class="card-header">
        List of Product
        <div class="mb-4 btn_user">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_product">
            <i class="fa fa-plus"></i>&nbsp; Add New Product
          </button>
          <div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form id="product_add" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="cat_title" class="form-label"> Product Category</label>
                      <select name="type" id="type" class="form-control">
                        <option value="">Select Type of category</option>
                        <?php
                        $cat_query = "SELECT * FROM categories";
                        $cat_result = mysqli_query($con_query, $cat_query);
                        while ($cat = mysqli_fetch_assoc($cat_result)) {
                          echo '<option value="' . $cat['id'] . '">' . $cat['category_name'] . '</option>';
                        }
                        ?>
                      </select>
                      <div id="type_error" class="error"></div>

                    </div>
                    <div class="mb-3">
                      <label for="cat_title" class="form-label">Title</label>
                      <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter name of product">
                      <div id="product_title_error" class="error"></div>

                    </div>
                    <div class="mb-3">
                      <label for="product_description" class="form-label">Content / Description</label>
                      <textarea name="product_description" id="product_description" rows="2" cols="50" class="form-control" placeholder="Enter content or description"></textarea>
                      <div id="product_description_error" class="error"></div>


                    </div>
                    <div class="mb-3">
                      <label for="image" class="form-label">Image</label>
                      <input type="file" name="product_image" id="product_image" class="form-control">
                    </div>
                    <div id="product_image_error" class="error"></div>
                    <div class="mb-3">
                      <label for="price" class="form-label">Price</label>
                      <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter price">

                      <div id="product_price_error" class="error"></div>
                    </div>
                    <label for="des" class="form-label">Additional Description</label>
                    <textarea name="additional_description" id="additional_description" rows="5" cols="50" class="form-control" placeholder="Enter  Additional description"></textarea>
                    <div id="additional_description_error" class="error"></div>
                    <label for="cat_title" class="form-label">Color</label>
                    <select name="color" id="color" class="form-control">
                      <option value="">Select color of product</option>
                      <?php
                      $cat_query = "SELECT * FROM colors";
                      $cat_result = mysqli_query($con_query, $cat_query);
                      while ($cat = mysqli_fetch_assoc($cat_result)) {
                        echo '<option value="' . $cat['color_id'] . '">' . $cat['color_name'] . '</option>';
                      }
                      ?>
                    </select>
                    <div id="color_error" class="error"></div>

                    <label>Gender:</label><br>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">male</label><br>

                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">female</label><br>

                    <input type="radio" id="other" name="gender" value="baby">
                    <label for="other">baby</label><br>
                    <div id="gender_error" class="error"></div>

                  </div>


                  <p>
                    <label class="toggleSwitch xlarge" onclick="">
                      <input type="checkbox" name="status" id="status" />
                      <span style="margin-left: 5px;">
                        <span>OFF</span>
                        <span>ON</span>
                        Status
                      </span>
                      <a></a>
                    </label>
                  </p>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add" id="add_product_btn">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="modal fade" id="edit_product" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form method="POST" id="edit_category_form" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="id" id="myid">
                  <div class="mb-3">
                    <label for=" Product_title" class="form-label"> Product Category</label>

                    <select name="edit_type" id="edit_type" class="form-control">
                      <option value="">Select Type of Product</option>
                      <?php
                      $cat_query = "SELECT * FROM categories";
                      $cat_result = mysqli_query($con_query, $cat_query);
                      while ($cat = mysqli_fetch_assoc($cat_result)) {
                        echo '<option value="' . $cat['id'] . '">' . $cat['category_name'] . '</option>';
                      }
                      ?>
                    </select>
                    <div id="edit_type_error" class="error"></div>

                    <label for="Product_title" class="form-label">Title</label>

                    <input type="text" name="product_edit_title" id="product_edit_title" class="form-control" placeholder="Enter  Product Title">
                    <div id="product_edit_title_error" class="error"></div>
                  </div>
                  <div class="mb-3">
                    <label for="des" class="form-label">Content / Description</label>
                    <textarea name="product_edit_description" id="product_edit_description" rows="8" cols="50" class="form-control" placeholder="Enter the content or description"></textarea>
                    <div id="product_edit_description_error" class="error"></div>


                  </div>
                  <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="product_edit_image" id="product_edit_image" class="form-control">
                    <input type="hidden" name="old_product_image" id="old_product_image" value="">

                    <img src="" id="product_image_preview" width="250px" height="200px">
                    <div id="product_edit_image_error" class="error"></div>
                  </div>
                  <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="product_edit_price" id="product_edit_price" class="form-control" placeholder="Enter the price">

                    <div id="product_edit_price_error" class="error"></div>
                  </div>
                  <div class="mb-3">
                    <label for="des" class="form-label">Additional Description</label>
                    <textarea name="edit_additional_description" id="edit_additional_description" rows="18" cols="50" class="form-control" placeholder="Enter the content or description"></textarea>
                    <div id="edit_additional_description_error" class="error"></div>

                    <label for="cat_title" class="form-label">Color</label>
                    <select name="edit_color" id="edit_color" class="form-control">
                      <option value="">Select color of product</option>
                      <?php
                      $cat_query = "SELECT * FROM colors";
                      $cat_result = mysqli_query($con_query, $cat_query);
                      while ($cat = mysqli_fetch_assoc($cat_result)) {
                        echo '<option value="' . $cat['color_id'] . '">' . $cat['color_name'] . '</option>';
                      }
                      ?>
                    </select>
                    <div id="color_edit_error" class="error"></div>
                    <label>Gender:</label><br>

                    <div>
                      <input type="radio" id="male" name="gender_edit" value="male">
                      <label for="male">male</label>
                    </div>

                    <div>
                      <input type="radio" id="female" name="gender_edit" value="female">
                      <label for="female">female</label>
                    </div>

                    <div>
                      <input type="radio" id="other" name="gender_edit" value="baby">
                      <label for="other">baby</label>
                    </div>

                    <div id="gender_edit_error" class="error"></div>

                  </div>
      
                  <label class="toggleSwitch xlarge">
                    <input
                      type="checkbox"
                      name="edit_status"
                      id="edit_status">
                    <span style="margin-left: 5px;">
                      <span>OFF</span>
                      <span>ON</span>
                      staus
                    </span>
                    <a></a>
                  </label>


                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" name="update" value="Update" id="update_product">
                </div>


              </div>
            </form>
          </div>
        </div>
        <table id="myTable1" class="table table-striped table table-bordered mt-5" border="1px" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col"> Product Price</th>
              <th scope="col">Type</th>
              <th scope="col">Image</th>
              <th scope="col">Operation</th>

              <!-- <th scope="col">Operation</th> -->

            </tr>
          </thead>
          <tbody>
            <?php
            $select = "select p.*, c.category_name as category_name from Product p left join categories c on c.id = p.cat_id";
            $result = mysqli_query($con_query, $select);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['category_name']; ?></td>

                <td><img src="../Admin/assets/img/product/<?php echo $row['image']; ?>" class="profile_img"></td>
                <td id="mytd">
                  <a href=""> <button class="btn btn-primary edit" data-id="<?php echo $row['product_id']; ?>" data-bs-toggle="modal" data-bs-target="#edit_product"> <i class="fa fa-edit"></i></button></a>

                  <a href="javascript:void(0)"><button class="btn btn-danger delete_btn" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-trash"></i></button></a>
                </td>
              </tr>
            <?php
            }
            ?>
            <script>
              $(document).ready(function() {
                $('#myTable1').DataTable();
              });
            </script>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {


    $("#add_product_btn").click(function(e) {
      e.preventDefault();
      let form = document.getElementById("product_add");
      let formdata = new FormData(form);
      formdata.append("action", "product_insert");
      formdata.append("status", document.getElementById("status").checked ? 1 : 0);
      $.ajax({

        url: "category_data.php",
        type: "post",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(data) {
          if (data.status == 200) {
            Swal.fire({
              title: " Product has been saved successfully",
              icon: "success",
              draggable: true
            }).then(() => {
              location.reload();
            });

            $('#add_product').modal('hide');

          } else {

            if (data.errors.product_image) {
              $("#product_image_error").text(data.errors.product_image);
            } else {
              $("#product_image_error").text("");
            }
            if (data.errors.product_title) {
              $("#product_title_error").text(data.errors.product_title);
            } else {
              or
              $("#product_title_error").text("");
            }
            if (data.errors.product_description) {
              $("#product_description_error").text(data.errors.product_description);
            } else {
              $("#product_description_error").text("");
            }

            if (data.errors.additional_description) {
              $("#additional_description_error").text(data.errors.additional_description);
            } else {
              $("#additional_description_error").text("");
            }


            if (data.errors.gender) {
              $("#gender_error").text(data.errors.gender);
            } else {
              $("#gender_error").text("");
            }
            if (data.errors.product_price) {
              $("#product_price_error").text(data.errors.product_price);
            } else {
              $("#product_price_error").text("");
            }

            if (data.errors.type) {
              $("#type_error").text(data.errors.type);
            } else {
              $("#type_error").text("");
            }
            if (data.errors.color) {
              $("#color_error").text(data.errors.color);
            } else {
              $("#color_error").text("");
            }

          }
        }

      });


    });


    $('#myTable1').on('click', '.delete_btn', function(e) {
      e.preventDefault();
      var id = $(this).data("id");
      Swal.fire({
        title: "Are you sure?",
        text: "Do You Want to delete this  Product??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "category_data.php",
            type: "POST",
            data: {
              "action": "product_delete",
              "id": id
            },
            success: function(data) {
              Swal.fire("Product Delete Successfully!", "", "success")
                .then(() => {
                  location.reload();
                });
            }
          });
        }
      });

    });

    $('#myTable1').on('click', '.edit', function(e) {
      e.preventDefault();
      var id = $(this).data("id");
      $.ajax({
        url: 'category_data.php',
        type: 'POST',
        data: {
          id: id,
          "action": "product_view",
        },


        success: function(response) {
          // console.log("sdfs" + base_url);
          var userDetails = JSON.parse(response);
          var genderValue = userDetails.gender;

          $("#myid").val(userDetails.product_id);
          $("#product_edit_title").val(userDetails.name);
          $("#product_edit_description").val(userDetails.description);
          $("#product_edit_price").val(userDetails.price);
          $("#edit_type").val(userDetails.cat_id);
          $("#product_image_preview").attr('src', "../admin/assets/img/product/" + userDetails.image);
          $("#old_product_image").val(userDetails.image);
          $("#edit_additional_description").val(userDetails.additional_description);
          $('input[name="gender_edit"][value="' + genderValue + '"]').prop('checked', true);
          $("#edit_color").val(userDetails.color_id);
          $("#edit_status").prop("checked", userDetails.is_active == 1);



          // $("# Product_image").val(userDetails.image);



        },
        error: function() {
          alert("Error fetching user details.");
        }
      });


    })

    $("#update_product").click(function(e) {
      e.preventDefault();
      var editform = document.getElementById('edit_category_form');

      var formdata = new FormData(editform);
      formdata.append("action", "product_update");
      formdata.append("edit_status", document.getElementById("edit_status").checked ? 1 : 0);
      $.ajax({
        url: "category_data.php",
        type: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(res) {


          if (res.code == 200) {
            console.log(res.msg);
            //  $("#editModal").hide();  
            $('#edit_product').modal('hide');
            Swal.fire({
              title: "  Product Updated SuccessFully!!",
              icon: "success",
              draggable: true
            }).then(() => {
              location.reload();
            });

          } else {

            //  alert(res.errors);



            if (res.errors.product_edit_title) {
              $("#product_edit_title_error").text(res.errors.product_edit_title);
            } else {

              $("#product_edit_title_error").text("");
            }
            if (res.errors.product_edit_description) {
              $("#product_edit_description_error").text(res.errors.product_edit_description);
            } else {
              $("#product_edit_description_error").text("");
            }

            if (res.errors.edit_additional_description) {
              $("#edit_additional_description_error").text(res.errors.edit_additional_description);
            } else {
              $("#edit_additional_description_error").text("");
            }


            if (res.errors.gender) {
              $("#gender_edit_error").text(res.errors.gender);
            } else {
              $("#gender_edit_error").text("");
            }
            if (res.errors.product_edit_price) {
              $("#product_edit_price_error").text(res.errors.product_edit_price);
            } else {
              $("#product_edit_price_error").text("");
            }

            if (res.errors.edit_type) {
              $("#edit_type_error").text(res.errors.edit_type);
            } else {
              $("#edit_type_error").text("");
            }


            if (res.errors.edit_color) {
              $("#color_edit_error").text(res.errors.edit_color);
            } else {
              $("#color_edit_error").text("");
            }




          }
        }
      })
    })
  });
</script>
<?php
require_once 'includes/footer.php';

?>