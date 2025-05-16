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
        <h3 class="mb-0 fw-semibold"> Color </h3>
    </div>
    <div class="col-sm-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-sm-end mb-0">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Color</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4" style="height: 2000px;">
            <div class="card-header">
                List of Colors
                <div class="mb-4 btn_user">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_color ">
                        <i class="fa fa-plus"></i>&nbsp; Add New Color
                    </button>
                    <div class="modal fade" id="add_color" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form id="color_add" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Color</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="cat_title" class="form-label">Color Name</label>

                                            <input type="text" name="color_name" id="color_name" class="form-control" placeholder="Enter Color Name">
                                            <div id="color_name_error" class="error"></div>



                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Add " id="add_color_btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editcolor" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" id="edit_color">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Color</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="color_old_id" id="color_old_id">
                                <div class="mb-3">
                                    <label for="Color_type" class="form-label">Color Name</label>
                                    <input type="text" name="color_edit_name" id="color_edit_name" class="form-control" placeholder="Enter Color Name">
                                    <div id="color_edit_name_error" class="error text-danger mt-1"></div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="update" value="Update" id="update_color">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">

                <table id="myTable1" class="table table-striped table table-bordered mt-5" border="1px" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Color Name</th>
                            <th scope="col">Operation</th>

                            <!-- <th scope="col">Operation</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = "SELECT * FROM colors";
                        $result = mysqli_query($con_query, $select);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['color_id']; ?></td>
                                <td><?php echo $row['color_name']; ?></td>

                                <td id="mytd">
                                    <a href=""> <button class="btn btn-primary edit" data-id="<?php echo $row['color_id']; ?>" data-bs-toggle="modal" data-bs-target="#editcolor"> <i class="fa fa-edit"></i></button></a>

                                    <a href=""><button class="btn  btn-danger delete_btn" data-id="<?php echo $row['color_id']; ?>"><i class="fa fa-trash"></i></button></a>
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

        $("#add_color_btn").click(function(e) {
            e.preventDefault();

            let form = document.getElementById("color_add");
            let formdata = new FormData(form);
            formdata.append("action", "color_insert");
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
                            title: "color has been saved successfully",
                            icon: "success",
                            draggable: true
                        }).then(() => {
                            location.reload();
                        });

                        $('#add_color').modal('hide');
                        // location.reload(true);
                    } else {

                        if (data.errors.color_name) {
                            $("#color_name_error").text(data.errors.color_name);
                        } else {
                            $("#color_name_error").text("");
                        }

                    }
                }

            });


        });
    });
</script>


<script>
    $(".delete_btn").click(function(e) {
        e.preventDefault();
        var id = $(this).data("id");
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
                    url: "category_data.php",
                    type: "POST",
                    data: {
                        "action": "color_del",
                        "id": id
                    },
                    success: function(data) {
                        Swal.fire("Delete Successfully!", "", "success")
                            .then(() => {
                                location.reload();
                            });
                    }
                });
            }
        });

    });
</script>
<script>
    $(".edit").click(function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#form_content").hide();
        $("#loader").show();

        $.ajax({
            url: 'category_data.php',
            type: 'POST',
            data: {
                id: id,
                "action": "color_edit",
            },


            success: function(response) {


                var userDetails = JSON.parse(response);

                $("#color_old_id").val(userDetails.color_id);

                $("#color_edit_name").val(userDetails.color_name);

            },
            error: function() {
                alert("Error fetching user details.");
            }
        });


    })
</script>
<script>
    $("#update_color").click(function(e) {
        e.preventDefault();
        var editform = document.getElementById('edit_color');

        var formdata = new FormData(editform);
        formdata.append("action", "update_color_data");
        $.ajax({
            url: "category_data.php",
            type: "POST",
            dataType: "json",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(res) {

                if (res.code == 200) {

                    $('#editcolor').modal('hide');
                    Swal.fire({
                        title: " Data Updated SuccessFully!",
                        icon: "success",
                        draggable: true
                    }).then(() => {
                        location.reload();
                    });



                } else {
                    // alert(res.errors.email);

                    if (res.errors.color_edit_name) {
                        $("#color_edit_name_error").text(res.errors.color_edit_name);
                    } else {
                        $("#color_edit_name_error").text("");
                    }
                }
            }
        })
    })
</script>
<?php
require_once 'includes/footer.php';



?>