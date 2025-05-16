<?php
require_once '../common/config.php';






if ($_POST['action'] == "category_delete") {
  $id  = $_POST['id'];
  $select_img = "select image from menu where id='$id'";
  $result_img = mysqli_query($con_query, $select_img);
  $data = mysqli_fetch_assoc($result_img);
  $image = $data['image'];


  $del_category = "delete from menu where id = '$id'";
  $del_result = mysqli_query($con_query, $del_category);
  if ($image) {
    $filePath = "../Admin/assets/img/menu/" . $image;
    if (file_exists($filePath)) {
      unlink($filePath);
    }
  }
  if ($del_result) {
    $output =
      [
        'msg' => "Data deleted successfully",
      ];
    echo json_encode($output);
  }
}

if ($_POST['action'] == "chef_delete") {
  $id  = $_POST['id'];
  $select_img = "select image from chef where id='$id'";
  $result_img = mysqli_query($con_query, $select_img);
  $data = mysqli_fetch_assoc($result_img);


  $del_category = "delete from chef where id = '$id'";
  $del_result = mysqli_query($con_query, $del_category);

  if ($del_result) {
    $image = $data['image'];
    if ($image) {
      $filePath = "../Admin/assets/img/chefs/" . $image;
      if (file_exists($filePath)) {
        unlink($filePath);
      }
    }
    $output =
      [
        'msg' => "Data deleted successfully",
      ];
    echo json_encode($output);
  }
}


if ($_POST['action'] == "category_insert") {

  if (empty($_POST['category_type'])) {
    $error['category_type'] = ' * Field is required';
  } else {

    $type = $_POST['category_type'];
  }


    if (empty($_FILES['category_image']['name'])) {
    $error['category_image'] = " * Image is empty";
     
  } else {



    $fileTmpPath = $_FILES['category_image']['tmp_name'];
    $originalName = $_FILES['category_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);


    $newFileName = $randomName . '.' . $fileExt;

    $uploadDir = '../Admin/assets/img/category/';

    $destPath = $uploadDir . $newFileName;


    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
  }

  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {

    $insert_category = "insert into categories(category_name,category_image)values('$type','$newFileName')";
    $result_category = mysqli_query($con_query, $insert_category);


    if ($result_category) {
      move_uploaded_file($fileTmpPath, $destPath);

      $data = [
        "status" => 200,
        "msg" => " Category saved successfully",
      ];
      echo json_encode($data);
      return false;
    }
  }
}

if ($_POST['action'] == "category_del") {
  $id  = $_POST['id'];

  $select_image = "select category_image from categories where id= '$id'";
 $result_img = mysqli_query($con_query, $select_image);
  $data = mysqli_fetch_assoc($result_img);
  $del_category = "delete from categories where id = '$id'";
 
  $del_result = mysqli_query($con_query, $del_category);
  if($del_result) {
    $image = $data['category_image'];
     if ($image) {
      $filePath = "../Admin/assets/img/category/" . $image;
      if (file_exists($filePath)) {
        unlink($filePath);
      }
    }
    $output =
      [
        'msg' => "Data deleted successfully",
      ];
    echo json_encode($output);
  }
}

if ($_POST['action'] == "product_view") {
  $id = $_POST['id'];
 


  $select = "SELECT * FROM product where product_id='$id'";
  
  $result = mysqli_query($con_query, $select);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}
if ($_POST['action'] == "update_category_data") {
  $id = $_POST['id'];

  if (empty($_POST['category_edit_type'])) {
    $err['type'] = "*Field is required";
  } else {
    $type = $_POST['category_edit_type'];
  }

    if (empty($_FILES['category_edit_image']['name'])) {

    $newFileName = $_POST['old_category_image'];
  } else {




    $fileTmpPath = $_FILES['category_edit_image']['tmp_name'];
    $originalName = $_FILES['category_edit_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    $newFileName = $randomName . '.' . $fileExt;
    $uploadDir = '../Admin/assets/img/category/';
    $destPath = $uploadDir . $newFileName;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    move_uploaded_file($fileTmpPath, $destPath);
    $oldimage = $uploadDir . $_POST['old_category_image'];
    if (file_exists($oldimage)) {
      unlink($oldimage);
    }
  }


  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update = "UPDATE categories SET category_name='$type',category_image='$newFileName' WHERE id='$id'";
    $result = mysqli_query($con_query, $update);
    if ($result) {
      $output = [
        'code' => 200,
        'msg' => "Category Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}
if ($_POST['action'] == "category_edit") {
  $id = $_POST['id'];


  $select = "SELECT * FROM categories where id='$id'";
  $result = mysqli_query($con_query, $select);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}

if ($_POST['action'] == "color_insert") {

  if (empty($_POST['color_name'])) {
    $error['color_name'] = ' * Field is required';
  } else {

    $color_name = $_POST['color_name'];
  }


   

  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {

    $insert_color = "insert into colors(color_name)values('$color_name')";
    $result_color = mysqli_query($con_query,$insert_color);


    if ($result_color) {
     

      $data = [
        "status" => 200,
        "msg" => " color saved successfully",
      ];
      echo json_encode($data);
      return false;
    }
  }
}

if ($_POST['action'] == "color_edit") {
  $id = $_POST['id'];

 
  $select = "SELECT * FROM colors where color_id='$id'";
  $result = mysqli_query($con_query, $select);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}


if ($_POST['action'] == "update_color_data") {

 

  $id = $_POST['color_old_id'];
  


  
  if (empty($_POST['color_edit_name'])) {
    $err['color_edit_name'] = "*Field is required";
  } else {
    $color_edit_name = $_POST['color_edit_name'];
  }

  

 


  
  

 

  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update = "UPDATE colors SET color_name='$color_edit_name'   WHERE color_id ='$id'";
    $result = mysqli_query($con_query, $update);
    if ($result) {


      $output = [
        'code' => 200,
        'msg' => "Menu Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}

// if ($_POST['action'] == "color_del") {
//   $id = $_POST['id'];




//   $del_color = "delete from colors where color_id = '$id'";
 
//   $del_result= mysqli_query($con_query, $del_color);

//   if ($del_result ) {
   
//     $output =
//       [
//         'msg' => "Data deleted successfully",
//       ];
//     echo json_encode($output);
//   }

//   else{
//     echo "data will not deleted";

//   }
// }


if ($_POST['action'] == "product_insert") {

  if (empty($_POST['product_title'])) {
    $error['product_title'] = ' *Product Name is required';
  } else {

    $product_title = $_POST['product_title'];
  }

  if (empty($_POST['product_description'])) {
    $error['product_description'] = ' * Description is required';
  } else {

    $product_description = $_POST['product_description'];
  }

  if (empty($_FILES['product_image']['name'])) {
    $error['product_image'] = " * Image is empty";
     
  } else {



    $fileTmpPath = $_FILES['product_image']['tmp_name'];
    $originalName = $_FILES['product_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);


    $newFileName = $randomName . '.' . $fileExt;

    $uploadDir = '../Admin/assets/img/product/';

    $destPath = $uploadDir . $newFileName;


    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
  }

  if (empty($_POST['product_price'])) {
    $error['product_price'] = ' * Field is required';
  } else {

    $product_price = $_POST['product_price'];
  }


  if (empty($_POST['additional_description'])) {
    $error['additional_description'] = ' * Additional description is required';
  } else {
    
    $additional_description = $_POST['additional_description'];
  }

  if(empty($_POST['gender'])){
    $error['gender'] = ' * Gender is required'; 
  }
  else{
      $gender = $_POST['gender'];
  
      
  }
  
  if (empty($_POST['type'])) {
    $error['type'] = ' * Select any category';
  } else {

    $type = $_POST['type'];
  }

    if (empty($_POST['color'])) {
    $error['color'] = ' * Select any color';
  } else {

    $color = $_POST['color'];
  }



  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_product = "insert into product(name,description,image,price,additional_description,gender,cat_id,color_id)values('$product_title','$product_description','$newFileName','$product_price','$additional_description','$gender','$type','$color')";
 
   
    $result_product = mysqli_query($con_query, $insert_product);


    if ($result_product) {
      move_uploaded_file($fileTmpPath, $destPath);

      $data = [
        "status" => 200,
        "msg" => "your data saved successfully",
      ];
      echo json_encode($data);
      return true;
    }

  }
}


if ($_POST['action'] == "product_update") {


  if (empty($_POST['edit_type'])) {
    $err['edit_type'] = "field is required";
  } else {
    $category_id = $_POST['edit_type'];
  }

    if (empty($_POST['edit_color'])) {
    $err['edit_color'] = "field is required";
  } else {
    $color_id = $_POST['edit_color'];
  }

  $id = $_POST['id'];

  
  if (empty($_POST['product_edit_title'])) {
    $err['product_edit_title'] = "*Field is required";
  } else {
    $product_edit_title = $_POST['product_edit_title'];
  }

  if (empty($_POST['product_edit_description'])) {
    $err['product_edit_description'] = "*Field is required";
  } else {
    $product_edit_description = $_POST['product_edit_description'];
  }

 


  if (empty($_POST['product_edit_price'])) {
    $err['product_edit_price'] = "*Field is required";
  } else {
    $price = $_POST['product_edit_price'];
  }


    if (empty($_POST['edit_additional_description'])) {
    $err['edit_additional_description'] = "*Field is required";
  } else {
    $edit_additional_description = $_POST['edit_additional_description'];
  }

  $gender=$_POST['gender_edit'];


  if (empty($_FILES['product_edit_image']['name'])) {

    $newFileName = $_POST['old_product_image'];
  } else {




    $fileTmpPath = $_FILES['product_edit_image']['tmp_name'];
    $originalName = $_FILES['product_edit_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    $newFileName = $randomName . '.' . $fileExt;
    $uploadDir = '../Admin/assets/img/product/';
    $destPath = $uploadDir . $newFileName;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    move_uploaded_file($fileTmpPath, $destPath);
    $oldimage = $uploadDir . $_POST['old_product_image'];
    if (file_exists($oldimage)) {
      unlink($oldimage);
    }
  }

  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update = "UPDATE product SET name='$product_edit_title',description='$product_edit_description',image='$newFileName',price='$price',additional_description='$edit_additional_description',gender='$gender',cat_id='$category_id',color_id='$color_id'  WHERE product_id ='$id'";
    $result = mysqli_query($con_query, $update);
    if ($result) {


      $output = [
        'code' => 200,
        'msg' => "Menu Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}



if ($_POST['action'] == "testimonial_insert") {

  if (empty($_POST['description'])) {
    $error['description'] = ' * Description is required';
  } else {

    $description = $_POST['description'];
  }

  if (empty($_POST['Username'])) {
    $error['Username'] = ' * username is required';
  } else {

    $Username = $_POST['Username'];
  }

  if (empty($_POST['Designation'])) {
    $error['Designation'] = ' * Description is required';
  } else {

    $Designation = $_POST['Designation'];
  }





  if (empty($_POST['rating'])) {
    $error['rating'] = ' * rating is required';
  } else {

    $rating = $_POST['rating'];
  }


  if (empty($_FILES['image']['name'])) {
    $error['image'] = " * Image is empty";
  } else {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $originalName = $_FILES['image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);

    // Generate 5-letter random string
    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $newFileName = $randomName . '.' . $fileExt;
    $uploadDir = '../Admin/assets/img/testimonials/';
    $destPath = $uploadDir . $newFileName;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
  }



  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_categories = "insert into testimonial(description,username,designation,rating,image)values('$description','$Username','$Designation','$rating','$newFileName')";
    $result_categories = mysqli_query($con_query, $insert_categories);


    if ($result_categories) {
      move_uploaded_file($fileTmpPath, $destPath);

      $data = [
        "status" => 200,
        "msg" => "your data saved successfully",
      ];
      echo json_encode($data);
      return false;
    }
  }
}



if ($_POST['action'] == "testimonial_view") {
  $id = $_POST['id'];


  $select = "SELECT * FROM testimonial where id='$id'";
  $result = mysqli_query($con_query, $select);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}



if ($_POST['action'] == "update_testimonial") {

  $id = $_POST['id'];

  if (empty($_POST['edit_description'])) {
    $err['description'] = "*Field is required";
  } else {
    $description = $_POST['edit_description'];
  }

  if (empty($_POST['username'])) {
    $err['username'] = "field is required";
  } else {
    $username = $_POST['username'];
  }



  if (empty($_POST['edit_designation'])) {
    $err['designation'] = "*Field is required";
  } else {
    $designation = $_POST['edit_designation'];
  }


  if (empty($_POST['rating'])) {
    $err['rating'] = "*Field is required";
  } else {
    $rating = $_POST['rating'];
  }


  if (empty($_FILES['edit_image']['name'])) {

    $newFileName = $_POST['old_category_image'];
  } else {


    $fileTmpPath = $_FILES['edit_image']['tmp_name'];
    $originalName = $_FILES['edit_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);

    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    $newFileName = $randomName . '.' . $fileExt;

    $uploadDir = '../Admin/assets/img/testimonials/';
    $destPath = $uploadDir . $newFileName;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    move_uploaded_file($fileTmpPath, $destPath);
    $oldimage = $uploadDir . $_POST['old_category_image'];
    if (file_exists($oldimage)) {
      unlink($oldimage);
    }
  }

  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update = "UPDATE  testimonial  SET description='$description',username='$username',designation='$designation',rating='$rating',image='$newFileName'  WHERE id='$id'";

    $result = mysqli_query($con_query, $update);
    if ($result) {




      $output = [
        'code' => 200,
        'msg' => "Menu Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}

if ($_POST['action'] == "testimonial_delete") {
  $id  = $_POST['id'];
  $select_img = "select image from testimonial where id='$id'";
  $result_img = mysqli_query($con_query, $select_img);
  $data = mysqli_fetch_assoc($result_img);
  $del_category = "delete from testimonial where id = '$id'";
  $del_result = mysqli_query($con_query, $del_category);
  if ($del_result) {
    $image = $data['image'];
    if ($image) {
      $filePath = "../Admin/assets/img/testimonials/" . $image;
      if (file_exists($filePath)) {
        unlink($filePath);
      }
    }
    $output =
      [
        'msg' => "Data deleted successfully",
      ];
    echo json_encode($output);
  }
}



if ($_POST['action'] == "chef_insert") {




  if (empty($_POST['chef_title'])) {
    $error['chef_title'] = ' *  title is required';
  } else {

    $chef_title = $_POST['chef_title'];
  }

  if (empty($_POST['chef_designation'])) {
    $error['chef_designation'] = ' * designation is required';
  } else {

    $chef_designation = $_POST['chef_designation'];
  }
  if (empty($_POST['chef_description'])) {
    $error['chef_description'] = ' * description is required';
  } else {

    $chef_description = $_POST['chef_description'];
  }

  if (empty($_FILES['chef_image']['name'])) {
    $error['chef_image'] = " * image is empty";
  } else {


    $fileTmpPath = $_FILES['chef_image']['tmp_name'];
    $originalName = $_FILES['chef_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    $newFileName = $randomName . '.' . $fileExt;

    $uploadDir = '../Admin/assets/img/chefs/';
    $destPath = $uploadDir . $newFileName;

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    move_uploaded_file($fileTmpPath, $destPath);
  }



  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_chef = "insert into chef(title,designation,description,image)values('$chef_title','$chef_designation','$chef_description','$newFileName')";

    $result_chef = mysqli_query($con_query, $insert_chef);


    if ($result_chef) {
      $data = [
        "status" => 200,
        "msg" => "Chef saved successfully",
      ];
      echo json_encode($data);
      return false;
    }
  }
}


if ($_POST['action'] == "chef_view") {
  $id = $_POST['id'];


  $select = "SELECT * FROM chef where id='$id'";
  $result = mysqli_query($con_query, $select);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}



if ($_POST['action'] == "update_chef") {

  $id = $_POST['id'];

  if (empty($_POST['chef_edit_title'])) {
    $err['chef_title_error'] = "Title is required";
  } else {
    $chef_title = $_POST['chef_edit_title'];
  }


  // $category_image = mysqli_real_escape_string($con_query, $_POST['category_image']);
  if (empty($_POST['chef_edit_designation'])) {
    $err['chef_edit_designation'] = "*Field is required";
  } else {
    $chef_designation = $_POST['chef_edit_designation'];
  }

  if (empty($_POST['chef_edit_description'])) {
    $err['chef_edit_description'] = "*Field is required";
  } else {
    $chef_description = $_POST['chef_edit_description'];
  }
  if (empty($_FILES['chef_edit_image']['name'])) {
    $newFileName = $_POST['old_chef_image'];
  } else {
    $fileTmpPath = $_FILES['chef_edit_image']['tmp_name'];
    $originalName = $_FILES['chef_edit_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $newFileName = $randomName . '.' . $fileExt;
    $uploadDir = '../Admin/assets/img/chefs/';
    $destPath = $uploadDir . $newFileName;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    move_uploaded_file($fileTmpPath, $destPath);

      $oldimage = $uploadDir . $_POST['old_chef_image'];
      if (file_exists($oldimage)) {
        unlink($oldimage);
      }
  }

  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update = "UPDATE chef SET title='$chef_title',designation='$chef_designation',description='$chef_description',image='$newFileName'   WHERE id='$id'";

    $result = mysqli_query($con_query, $update);
    if ($result) {
      
      $output = [
        'code' => 200,
        'msg' => "Menu Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}


if ($_POST['action'] == "about_insert") {

  if (empty($_POST['title'])) {
    $error['title'] = ' * title is required';
  } else {

    $title = $_POST['title'];
  }

  if (empty($_FILES['primary_image']['name'])) {
    $error['primary_image'] = " * Image is empty";
  } else {

    $fileTmpPath = $_FILES['primary_image']['tmp_name'];
    $originalName = $_FILES['primary_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);


    $newFileName = $randomName . '.' . $fileExt;

    $uploadDir = '../Admin/assets/img/about/';

    $destPath = $uploadDir . $newFileName;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
  }

  if (empty($_POST['description'])) {
    $error['description'] = ' * Description is required';
  } else {

    $description = $_POST['description'];
  }

  if (empty($_FILES['secondary_image']['name'])) {
    $error['secondary_image'] = " * Image is empty";
  } else {

    $secondary_file = $_FILES['secondary_image']['tmp_name'];
    $originalName = $_FILES['secondary_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);


    $secondary_image = $randomName . '.' . $fileExt;

    $uploadDir = '../Admin/assets/img/about/';

    $secondary_path = $uploadDir . $secondary_image;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
  }
  if (empty($_POST['booking_no'])) {
    $error['booking_no'] = ' * field is required';
  } else {

    $booking_no = $_POST['booking_no'];
  }
  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_about = "insert into about_us(title,primary_image,description,secondary_image,booking_no)values('$title','$newFileName','$description','$secondary_image','$booking_no')";
    $result_about = mysqli_query($con_query, $insert_about);


    if ($result_about) {
      move_uploaded_file($fileTmpPath, $destPath);
      move_uploaded_file($secondary_file, $secondary_path);

      $data = [
        "status" => 200,
        "msg" => "  data saved successfully",
      ];
      echo json_encode($data);
      return true;
    }
  }
}



if ($_POST['action'] == "about_update") {

  $id = $_POST['about_us_id'];
  if (empty($_POST['edit_title'])) {
    $err['edit_title'] = "Title is required";
  } else {
    $edit_title = $_POST['edit_title'];
  }

  if (empty($_FILES['primary_image_edit']['name'])) {
    $primary_image =  $_POST['old_about_primary_image'];
  } else {

    $primary_fileTmpPath = $_FILES['primary_image_edit']['tmp_name'];
    $primary_originalName = $_FILES['primary_image_edit']['name'];
    $primary_fileExt = pathinfo($primary_originalName, PATHINFO_EXTENSION);

    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    $primary_image = $randomName . '.' . $primary_fileExt;
    $uploadDir = '../Admin/assets/img/about/';
    $primary_destPath = $uploadDir . $primary_image;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    move_uploaded_file($primary_fileTmpPath, $primary_destPath);
    $old_primary_image = $uploadDir . $_POST['old_about_primary_image'];
    if (file_exists($old_primary_image)) {
      unlink($old_primary_image);
    }
  }


  if (empty($_POST['description__edit'])) {
    $err['description__edit'] = "*Field is required";
  } else {
    $description__edit = $_POST['description__edit'];
  }



  // echo $_FILES['category_image']['name'];

  if (empty($_FILES['secondary_image_edit']['name'])) {

    $secondary_image =  $_POST['old_about_secondary_image'];
  } else {
    $secondary_fileTmpPath = $_FILES['secondary_image_edit']['tmp_name'];
    $secondary_originalName = $_FILES['secondary_image_edit']['name'];
    $fileExt = pathinfo($secondary_originalName, PATHINFO_EXTENSION);

    // Generate 5-letter random string
    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    // Final file name with extension
    $secondary_image = $randomName . '.' . $fileExt;

    // Upload path
    $uploadDir = '../Admin/assets/img/about/';
    $secondary_destPath = $uploadDir . $secondary_image;

    // Create folder if not exists
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    move_uploaded_file($secondary_fileTmpPath, $secondary_destPath);

    $old_about_secondary_image = $uploadDir . $_POST['old_about_secondary_image'];
    if (file_exists($old_about_secondary_image)) {
      unlink($old_about_secondary_image);
    }

    // Move uploaded file

  }

  if (empty($_POST['booking_no_edit'])) {
    $err['booking_no_edit'] = ' * field is required';
  } else {

    $booking_no_edit = $_POST['booking_no_edit'];
  }

  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update_about_us = "UPDATE about_us SET title='$edit_title',primary_image='$primary_image',description='$description__edit',secondary_image='$secondary_image',booking_no='$booking_no_edit'  WHERE id='$id'";

    $result = mysqli_query($con_query, $update_about_us);
    if ($result) {



      $output = [
        'code' => 200,
        'msg' => "Menu Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}



if ($_POST['action'] == "conatact_insert") {

  if (empty($_POST['address'])) {
    $error['address'] = ' * address is required';
  } else {

    $address = $_POST['address'];
  }


  if (empty($_POST['email'])) {
    $error['email'] = ' * email is required';
  } else {

    $email = $_POST['email'];
  }

  if (empty($_POST['contact'])) {
    $error['contact'] = ' * contact is required';
  } else {

    $contact = $_POST['contact'];
  }

  if (empty($_POST['from_time'])) {
    $error['from_time'] = ' * from_time is required';
  } else {

    $from_time = $_POST['from_time'];
  }

  if (empty($_POST['to_time'])) {
    $error['to_time'] = ' * to_time is required';
  } else {

    $to_time = $_POST['to_time'];
  }




  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_about = "insert into contact_us(address,email,contact_number,from_time,to_time)values('$address','$email','$contact','$from_time','$to_time')";
    $result_about = mysqli_query($con_query, $insert_about);


    if ($result_about) {


      $data = [
        "status" => 200,
        "msg" => "Data saved successfully",
      ];
      echo json_encode($data);
      return true;
    }
  }
}

if ($_POST['action'] == "contact_update") {

  $id = $_POST['id'];


  if (empty($_POST['address_edit'])) {
    $err['address_edit_err'] = "Address is required";
  } else {
    $address_edit = $_POST['address_edit'];
  }

  if (empty($_POST['edit_email'])) {
    $err['edit_email'] = "Email is required";
  } else {
    $edit_email = $_POST['edit_email'];
  }


  if (empty($_POST['edit_contact'])) {
    $err['edit_contact'] = "Contact is required";
  } else {
    $edit_contact = $_POST['edit_contact'];
  }

  if (empty($_POST['time_edit'])) {
    $err['time_edit'] = "Field  is required";
  } else {
    $time_edit = $_POST['time_edit'];
  }


  if (empty($_POST['to_time_edit'])) {
    $err['to_time_edit'] = "Field  is required";
  } else {
    $to_time_edit = $_POST['to_time_edit'];
  }



  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update_about_us = "UPDATE contact_us SET  address='$address_edit', email='$edit_email',contact_number='$edit_contact',from_time='$time_edit',to_time='$to_time_edit'    WHERE id='$id'";

    $result = mysqli_query($con_query, $update_about_us);
    if ($result) {



      $output = [
        'code' => 200,
        'msg' => "Data Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}







// banner insert


if ($_POST['action'] == "banner_insert") {

  if (empty($_POST['title'])) {
    $error['title'] = ' * title is required';
  } else {

    $title = $_POST['title'];
  }


  if (empty($_POST['description'])) {
    $error['description'] = ' * description is required';
  } else {

    $description = $_POST['description'];
  }

  if (empty($_FILES['image']['name'])) {
    $error['image'] = " * Image is empty";
  } else {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $originalName = $_FILES['image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $newFileName = $randomName . '.' . $fileExt;
    $uploadDir = '../Admin/assets/img/banner/';
    $destPath = $uploadDir . $newFileName;
    move_uploaded_file($fileTmpPath, $destPath);



    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
  }





  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_about = "insert into banner(title,description,image)values('$title','$description','$newFileName')";
    $result_about = mysqli_query($con_query, $insert_about);


    if ($result_about) {


      $data = [
        "status" => 200,
        "msg" => "Banner saved successfully",
      ];
      echo json_encode($data);
      return true;
    }
  }
}


if ($_POST['action'] == "banner_update") {

  $id = $_POST['id'];

  if (empty($_POST['title_edit'])) {
    $err['edit_title'] = "Title is required";
  } else {
    $edit_title = $_POST['title_edit'];
  }


  if (empty($_POST['edit_description'])) {
    $err['edit_description'] = "Description is required";
  } else {
    $edit_description = $_POST['edit_description'];
  }



  if (empty($_FILES['edit_image']['name'])) {
    $primary_image =  $_POST['old_img'];
  } else {

    $primary_fileTmpPath = $_FILES['edit_image']['tmp_name'];
    $primary_originalName = $_FILES['edit_image']['name'];
    $primary_fileExt = pathinfo($primary_originalName, PATHINFO_EXTENSION);

    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    $primary_image = $randomName . '.' . $primary_fileExt;
    $uploadDir = '../admin/assets/img/banner/';
    $primary_destPath = $uploadDir . $primary_image;
    // Create folder if not exists
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    move_uploaded_file($primary_fileTmpPath, $primary_destPath);

    $old_image = $uploadDir . basename(trim($_POST['old_img']));




    if (file_exists($old_image)) {

      unlink($old_image);
    }
  }


  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update_banner_us = "UPDATE banner SET title='$edit_title',description='$edit_description',image='$primary_image' WHERE id='$id'";

    $result = mysqli_query($con_query, $update_banner_us);
    if ($result) {



      $output = [
        'code' => 200,
        'msg' => "Banner Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}


if ($_POST['action'] == "gallery_insert") {

  if (empty($_FILES['image']['name'][0])) {
    $error['image'] = " * Image is empty";
  } else {
    $uploadDir = '../Admin/assets/img/gallery/';

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    foreach ($_FILES['image']['tmp_name'] as $key => $tmpName) {
      $filename = $_FILES['image']['name'][$key];

      // Get the file extension BEFORE using it
      $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

      // Generate random filename
      $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
      $newFileName = $randomName . '.' . $fileExt;

      // Full destination path
      $destPath = $uploadDir . $newFileName;

      // Move file to destination
      if (move_uploaded_file($tmpName, $destPath)) {
        $safeFileName = mysqli_real_escape_string($con_query, $newFileName);

        $insert = "INSERT INTO gallery (gallery_image) VALUES ('$safeFileName')";
        $result = mysqli_query($con_query, $insert);

        if ($result) {
          $success[] = $newFileName;
        } else {
          $error[] = "Database error for: $filename";
        }
      } else {
        $error[] = "Failed to upload: $filename";
      }
    }
  }


  if (!empty($error)) {
    echo json_encode([
      'status' => 400,
      'errors' => $error
    ]);
  } else {
    echo json_encode([
      'status' => 200,
      'msg' => 'Photos uploaded successfully',
      'files' => $success
    ]);
  }
  exit;


  // if (!empty($error)) {
  //   $allerror = [

  //     'errors' => $error

  //   ];
  //   echo json_encode($allerror);
  //   return false;
  // } else {
  //   $insert_about = "insert into gallery(gallery_image)values('$newFileName')";
  //   $result_about = mysqli_query($con_query, $insert_about);


  //   if ($result_about) {


  //     $data = [
  //       "status" => 200,
  //       "msg" => "photo saved successfully",
  //     ];
  //     echo json_encode($data);
  //     return true;
  //   }
  // }
}

if ($_POST['action'] == "gallery_delete") {
  $id  = $_POST['id'];


  $select_img = "select gallery_image from gallery where gallery_id ='$id'";
  $result_img = mysqli_query($con_query, $select_img);
  $data = mysqli_fetch_assoc($result_img);
  $image = $data['gallery_image'];

  $del_gallery = "delete from  gallery  where gallery_id = '$id'";
  $del_result = mysqli_query($con_query, $del_gallery);
  if ($image) {
    $filePath = "../Admin/assets/img/gallery/" . $image;
    if (file_exists($filePath)) {
      unlink($filePath);
    }
  }
  if ($del_result) {
    $output =
      [
        'msg' => "Data deleted successfully",
      ];
    echo json_encode($output);
  }
}

if ($_POST['action'] == "event_insert") {

  if (empty($_POST['event_title'])) {
    $error['event_title'] = ' *title is required';
  } else {

    $event_title = $_POST['event_title'];
  }


  if (empty($_POST['event_description'])) {
    $error['event_description'] = ' *description is required';
  } else {

    $event_description = $_POST['event_description'];
  }



  if (empty($_POST['event_price'])) {
    $error['event_price'] = ' *price is required';
  } else {

    $event_price = $_POST['event_price'];
  }

  if (empty($_FILES['event_image']['name'])) {
    $error['image'] = " * Image is empty";
  } else {
    $fileTmpPath = $_FILES['event_image']['tmp_name'];
    $originalName = $_FILES['event_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $newFileName = $randomName . '.' . $fileExt;
    $uploadDir = '../Admin/assets/img/event/';
    $destPath = $uploadDir . $newFileName;




    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
  }





  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_about = "insert into event( title,description,price,image)values('$event_title','$event_description','$event_price','$newFileName')";
    $result_about = mysqli_query($con_query, $insert_about);


    if ($result_about) {

      move_uploaded_file($fileTmpPath, $destPath);
      $data = [
        "status" => 200,
        "msg" => "Banner saved successfully",
      ];
      echo json_encode($data);
      return true;
    }
  }
}
if ($_POST['action'] == "event_view") {
  $id = $_POST['id'];


  $select = "SELECT * FROM event where id='$id'";
  $result = mysqli_query($con_query, $select);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}


// if ($_POST['action'] == "update_event") {


//   if (empty($_POST['event_edit_title'])) {
//     $id = $_POST['id'];
//     $err['edit_title'] = "title is required";
//   } else {
//     $event_edit_title = $_POST['event_edit_title'];
//   }



//   if (empty($_POST['food_title'])) {
//     $err['food_title'] = "*Field is required";
//   } else {
//     $food_title = $_POST['food_title'];
//   }

//   if (empty($_POST['category_description'])) {
//     $err['category_description'] = "*Field is required";
//   } else {
//     $category_description = $_POST['category_description'];
//   }


//   if (empty($_POST['category_price'])) {
//     $err['price'] = "*Field is required";
//   } else {
//     $price = $_POST['category_price'];
//   }


//   if (empty($_FILES['category_image']['name'])) {

//     $newFileName = $_POST['old_category_image'];
//   } else {




//     $fileTmpPath = $_FILES['category_image']['tmp_name'];
//     $originalName = $_FILES['category_image']['name'];
//     $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


//     $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

//     $newFileName = $randomName . '.' . $fileExt;
//     $uploadDir = '../Admin/assets/img/menu/';
//     $destPath = $uploadDir . $newFileName;
//     if (!is_dir($uploadDir)) {
//       mkdir($uploadDir, 0755, true);
//     }
//     move_uploaded_file($fileTmpPath, $destPath);
//     $oldimage = $uploadDir . $_POST['old_category_image'];
//     if (file_exists($oldimage)) {
//       unlink($oldimage);
//     }
//   }

//   if (!empty($err)) {
//     $allerrs = [
//       'code' => 404,
//       'errors' => $err,
//     ];
//     echo json_encode($allerrs);
//     return false;
//   } else {
//     $update = "UPDATE menu SET title='$food_title',description='$category_description',price='$price',image='$newFileName',category_id='$category_id'  WHERE id='$id'";
//     $result = mysqli_query($con_query, $update);
//     if ($result) {


//       $output = [
//         'code' => 200,
//         'msg' => "Menu Updated successfully!!!"
//       ];
//       echo json_encode($output);
//       return true;
//     } else {
//       $dberr = [
//         "code" => 404,
//         "msg"  => "any database related problem"
//       ];
//       echo json_encode($dberr);
//       return false;
//     }
//   }
// }
if ($_POST['action'] == "update_event") {


  $id = $_POST['id'];

  if (empty($_POST['event_edit_title'])) {
    $err['edit_title'] = "title is required";
  } else {
    $event_edit_title = $_POST['event_edit_title'];
  }



  if (empty($_POST['event_edit_description'])) {
    $err['event_edit_description'] = "*Field is required";
  } else {
    $event_edit_description = $_POST['event_edit_description'];
  }


  if (empty($_POST['event_edit_price'])) {
    $err['event_edit_price'] = "*Field is required";
  } else {
    $event_price = $_POST['event_edit_price'];
  }


  if (empty($_FILES['event_edit_image']['name'])) {

    $newFileName = $_POST['old_event_image'];
  } else {




    $fileTmpPath = $_FILES['event_edit_image']['tmp_name'];
    $originalName = $_FILES['event_edit_image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);


    $randomName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    $newFileName = $randomName . '.' . $fileExt;
    $uploadDir = '../Admin/assets/img/event/';
    $destPath = $uploadDir . $newFileName;
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    move_uploaded_file($fileTmpPath, $destPath);
    $oldimage = $uploadDir . $_POST['old_event_image'];
    if (file_exists($oldimage)) {
      unlink($oldimage);
    }
  }

  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update = "UPDATE event SET title='$event_edit_title',description='$event_edit_description',price='$event_price',image='$newFileName'   WHERE id='$id'";
    $result = mysqli_query($con_query, $update);
    if ($result) {
      $uploadDir = '../Admin/assets/img/event/';


      $output = [
        'code' => 200,
        'msg' => "Event Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}
if ($_POST['action'] == "event_delete") {
  $id  = $_POST['id'];


  $select_img = "select image from event where id ='$id'";
  $result_img = mysqli_query($con_query, $select_img);
  $data = mysqli_fetch_assoc($result_img);
  $image = $data['image'];

  $del_event = "delete from  event  where id = '$id'";
  $del_result = mysqli_query($con_query, $del_event);
  if ($image) {
    $filePath = "../Admin/assets/img/event/" . $image;
    if (file_exists($filePath)) {
      unlink($filePath);
    }
  }
  if ($del_result) {
    $output =
      [
        'msg' => "Data deleted successfully",
      ];
    echo json_encode($output);
  }
}
 


if ($_POST['action'] == "privacy_insert") {

  if (empty($_POST['description'])) {
    $err['description'] = "*Field is required";
  } else {
    $description = $_POST['description'];
  }


  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_privacy = "insert into privacy(description)values('$description')";
    $result_privacy = mysqli_query($con_query, $insert_privacy);


    if ($result_privacy) {


      $data = [
        "status" => 200,
        "msg" => "Banner saved successfully",
      ];
      echo json_encode($data);
      return true;
    }
  }
}








// if (!empty($error)) {
//   $allerror = [

//     'errors' => $error

//   ];
//   echo json_encode($allerror);
//   return false;
// } else {
//   $insert_about = "insert into gallery(gallery_image)values('$newFileName')";
//   $result_about = mysqli_query($con_query, $insert_about);


//   if ($result_about) {


//     $data = [
//       "status" => 200,
//       "msg" => "photo saved successfully",
//     ];
//     echo json_encode($data);
//     return true;
//   }
// }


if ($_POST['action'] == "privacy_update") {

  $id = $_POST['privacy_id'];




  if (empty($_POST['description_edit'])) {
    $err['edit_description'] = "Description is required";
  } else {
    $edit_description = $_POST['description_edit'];
  }






  if (!empty($err)) {
    $allerrs = [
      'code' => 404,
      'errors' => $err,
    ];
    echo json_encode($allerrs);
    return false;
  } else {
    $update_privacy = "UPDATE privacy SET description='$edit_description' WHERE id='$id'";

    $result = mysqli_query($con_query, $update_privacy);
    if ($result) {



      $output = [
        'code' => 200,
        'msg' => "Privacy Updated successfully!!!"
      ];
      echo json_encode($output);
      return true;
    } else {
      $dberr = [
        "code" => 404,
        "msg"  => "any database related problem"
      ];
      echo json_encode($dberr);
      return false;
    }
  }
}


// if ($_POST['action'] == "update_admin") {
//   $id = $_POST['old_id'];
//   // echo $id;
//   // die();
//   $select_password = "select * from admin where id='$id'";
//   $result_password = mysqli_query($con_query, $select_password);
//   $data = mysqli_fetch_assoc($result_password);

//   $oldPassword = $_POST['oldPassword'];
//   // if(!empty($_POST['newPassword'])){

//   $newPassword = $_POST['newPassword'];
//   // }
//   $confirmPassword = $_POST['confirmPassword'];


//   if (empty($_POST['username'])) {
//     $err['username'] = "username is required";
//   } else {
//     $username = $_POST['username'];
//   }


//   if (empty($_POST['user_email'])) {
//     $err['user_email'] = "email is required";
//   } else {
//     $user_email = $_POST['user_email'];
//   }

//   if (!empty($oldPassword) ||  !empty($newPassword) || !empty($confirmPassword)) {

//     // echo "in";

//     $old_pass = $data['password'];
//     if ($oldPassword != $old_pass) {

//       $error['old_password'] = "Password does not match with old one";
//       // echo $error['old_password'];
//       if (!empty($error['old_password'])) {
//         $op = [
//           "code" => 403,
//           "msgs" => "old password is not correct",
//         ];
//         echo json_encode($op);
//         return false;
//       }
//     }




//     if ($_POST['newPassword'] != $_POST['confirmPassword']) {
//       $error['new_password'] = "Password does not match";
//       if (!empty($error['new_password'])) {
//         $op = [
//           "code" => 403,
//           "msgs" => "Confirm password does not match",
//         ];
//         echo json_encode($op);
//         return false;
//       }
//     } else {

//       if (empty($_POST['newPassword'])) {
//         $newPassword =  $data['password'];

//         // echo "old data updated";
 
//       } else {
           
//    $newPassword = $_POST['newPassword'];
//         $update_password = "update admin set password='$newPassword' where id='$id'";
//         $result_password = mysqli_query($con_query, $update_password);
//         if ($result_password) {
//           $final_op = [
//             "code" => 200,
//             "msg" => "succeess",
//           ];
//           echo json_encode($final_op);
//           return false;
//         }
//       }
//     }
//   } else {
//     if (!empty($err)) {
//       $allerror = [
//         "code" => 404,
//         "errors" => $err,

//       ];
//       echo json_encode($allerror);
//       return false;
//     } else {
//       $newPassword =  $data['password'];

//       $update_data = "update admin set username='$username',email='$user_email',password='$newPassword' where id='$id'";
//       $result_update = mysqli_query($con_query, $update_data);
//       if ($result_update) {
//         $output = [
//           "code" => 200,
//           "msg" => "successfully updated",

//         ];
//         echo json_encode($output);
//         return true;
//       }
//     }
//   }


  if ($_POST['action'] == "update_admin") {
    $id = $_POST['old_id'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $errors = [];

  
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    if (empty($user_email)) {
        $errors['user_email'] = "Email is required";
    }
 
    $select_query = "SELECT password FROM admin WHERE id = '$id'";
    $result = mysqli_query($con_query, $select_query);
    $data = mysqli_fetch_assoc($result);
    $currentPassword = $data['password'];
 
    if (!empty($oldPassword) || !empty($newPassword) || !empty($confirmPassword)) {
 
        if ($oldPassword != $currentPassword) {
            $errors['old_password'] = "Old password does not match";
        }
        if ($newPassword != $confirmPassword) {
            $errors['new_password'] = "New password and confirmation do not match";
        }
    }

    if (!empty($errors)) {
        $response = [
            "code" => 403,
            "errors" => $errors,
        ];
        echo json_encode($response);
        return;
    }

  
    if (!empty($newPassword)) {
    
        $update_query = "UPDATE admin SET username = '$username', email = '$user_email', password = '$newPassword' WHERE id = '$id'";
    } else {
  
        $update_query = "UPDATE admin SET username = '$username', email = '$user_email' WHERE id = '$id'";
    }

    $update_result = mysqli_query($con_query, $update_query);

    if ($update_result) {
        $response = [
            "code" => 200,
            "msg" => "Successfully updated",
        ];
    } else {
        $response = [
            "code" => 500,
            "msg" => "Update failed",
        ];
    }

    echo json_encode($response);
}






 



// }



if ($_POST['action'] == "book_insert") {

  if (empty($_POST['name'])) {
    $error['name'] = ' * Name is required';
  } else {

    $name = $_POST['name'];
  }
    if (empty($_POST['email'])) {
    $error['email'] = ' * Email is required';
  } else {

    $email = $_POST['email'];
  }


    if (empty($_POST['phone'])) {
    $error['phone'] = ' * Phone is required';
  } else {

    $phone = $_POST['phone'];
  }
  
    if (empty($_POST['date'])) {
    $error['date'] = ' * Date is required';
  } else {

    $date = $_POST['date'];
  }
    
    if (empty($_POST['time'])) {
    $error['time'] = ' * Time is required';
  } else {

    $time = $_POST['time'];
  }

    
    if (empty($_POST['people'])) {
    $error['people'] = ' * Field is required';
  } else {

    $people = $_POST['people'];
  }

      if (empty($_POST['message'])) {
    $error['message'] = ' * Field is required';
  } else {

    $message = $_POST['message'];
  }
  



  

 





  if (!empty($error)) {
    $allerror = [

      'errors' => $error

    ];
    echo json_encode($allerror);
    return false;
  } else {
    $insert_book = "insert into book_table(name,email,phone,date,time,people,message)values('$name','$email','$phone','$date','$time','$people','$message')";

    $result_book = mysqli_query($con_query, $insert_book);


    if ($result_book) {


      $data = [
        "status" => 200,
        "msg" => "data saved successfully",
      ];
      echo json_encode($data);
      return true;
    }
  }
}

if ($_POST['action'] == "data_get") {

 
$id = $_POST['id'];
 
require_once '../common/config.php';  
$select = "SELECT * FROM book_table where id='$id'";
$result = mysqli_query($con_query, $select);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);



 
 
 }
  ?>
 



  