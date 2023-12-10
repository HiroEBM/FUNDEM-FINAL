<?php 
session_start();
require 'dbcon.php';

//Registration Form
if(isset($_POST['register_user'])){
    $fname = mysqli_real_escape_string($con, $_POST['f_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $lname = mysqli_real_escape_string($con, $_POST['l_name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $password = mysqli_real_escape_string($con, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($con, md5($_POST['confirm_password']));

    $select = "SELECT * FROM user_tbl WHERE email='$email'";
    $result = mysqli_query($con, $select);
  
    if(mysqli_num_rows($result) > 0){
      $_SESSION['message'] = 'email already exist!';
      header('location:Regform.php');
      exit(0);
    } else{
      if ($password != $confirm_password){
        $_SESSION['message'] = 'Password not match!';
        header('location:Regform.php');
        exit(0);
      }
      else{
        $insert ="INSERT INTO user_tbl (Fname, Lname, email, password, phone, gender) VALUES ('$fname', '$lname', '$email', '$password', '$phone', '$gender')";
        mysqli_query($con, $insert);
        $_SESSION['message'] = 'Account created successfully!';
        header('location:login.php');
        exit(0);
      }
    }
  }

  //Log in Form
  if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, md5($_POST['password']));

    $determine = mysqli_query($con, "SELECT user_id FROM user_tbl WHERE email = '$email' AND password = '$password'") or die('query failed');

    if (mysqli_num_rows($determine) > 0) {
        $result = mysqli_fetch_assoc($determine);
        if ($result) {
            // Access the user_id
            $user_id = $result['user_id'];
            // Store user_id in the session
            $_SESSION['user_id'] = $user_id;
            header("Location: index.php");
            exit(); // Don't forget to exit after header redirection
        }
    } else {
        // Query failed
        $_SESSION['message'] = 'incorrect email or password!';
        header('location: login.php');
    }
}

//Make post
if(isset($_POST['upload-post']) && isset($_FILES['filename'])){

    $img_name = $_FILES['filename']['name'];
    $img_size = $_FILES['filename']['size'];
    $tmp_name = $_FILES['filename']['tmp_name'];
    $error = $_FILES['filename']['error'];
    
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $story = mysqli_real_escape_string($con, $_POST['story']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    
// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    // Access user_id
    $user_id = $_SESSION['user_id'];
    
    // Use $user_id in your code
      echo "User ID: " . $user_id;
    } else {
      // Redirect or handle the case when the user is not logged in
      header("Location: login.php");
      exit();
    }
    
    if ($error === 0){
      if ($img_size > 2500000){
        header("Location: makepost.php");
        exit(0);
      } else {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");
    
        if (in_array($img_ex_lc, $allowed_exs)){
          $new_img_name = uniqid("IMG", true).'.'. $img_ex_lc;
          $img_upload_path = 'IMAGES/'.$new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);
    
          $sql = "INSERT INTO create_blog(title, story, amount, image, user_id) VALUES('$title', '$story', '$amount','$new_img_name','$user_id')";
          mysqli_query($con,$sql);
          header("Location: yourpost.php");
        }else{
          header('location: makepost.php');
          exit(0);
        }
      }
    } else{
      header('location: makepost.php');
      exit(0);
    }
    }


//Update Profile
if(isset($_POST['update_user'])&& isset($_FILES['filename']))
{

    $img_name = $_FILES['filename']['name'];
    $img_size = $_FILES['filename']['size'];
    $tmp_name = $_FILES['filename']['tmp_name'];
    $error = $_FILES['filename']['error'];
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $Fname = mysqli_real_escape_string($con, $_POST['Fname']);
    $Lname = mysqli_real_escape_string($con, $_POST['Lname']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $bday = date('Y-m-d', strtotime($_POST['bday']));
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = "UPDATE user_tbl SET Fname='$Fname', Lname='$Lname', phone='$phone', gender='$gender', bday='$bday', email='$email' WHERE user_id='$user_id' ";
    mysqli_query($con, $query);
    header("Location: viewprofile.php");

    if ($error === 0){
      if ($img_size > 2500000){
        header("Location: profile.php");
        exit(0);
      } else {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");
    
        if (in_array($img_ex_lc, $allowed_exs)){
          $new_img_name = uniqid("IMG", true).'.'. $img_ex_lc;
          $img_upload_path = 'IMAGES/'.$new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);
    
          $query = "UPDATE user_tbl SET profilePic = '$new_img_name' WHERE user_id='$user_id'";
          mysqli_query($con, $query);
          header("Location: viewprofile.php");
        }else{
          header('location: profile.php');
          exit(0);
        }
      }
    } else{
      header('location: viewprofile.php');
      exit(0);
    }
  }


//Delete Profile
if(isset($_POST['delete_user']))
{
    $user = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM user_tbl WHERE user_id='$user'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Account Deleted Successfully";
        unset($_SESSION['user_id']);
        header("location:login.php");
        die();
    }
    else
    {
        header("location: profile.php");
        exit(0);
    }
}



//update Post
if(isset($_POST['update-post']) && isset($_FILES['filename'])){

  $img_name = $_FILES['filename']['name'];
  $img_size = $_FILES['filename']['size'];
  $tmp_name = $_FILES['filename']['tmp_name'];
  $error = $_FILES['filename']['error'];
  
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $story = mysqli_real_escape_string($con, $_POST['story']);
  $amount = mysqli_real_escape_string($con, $_POST['amount']);
  $post_id = mysqli_real_escape_string($con, $_POST['create_id']);


  print_r($post_id);
  
// Check if user is logged in
if(isset($_SESSION['user_id'])) {
  // Access user_id
  $user_id = $_SESSION['user_id'];
  
  // Use $user_id in your code
    echo "User ID: " . $user_id;
  } else {
    // Redirect or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
  }

  $query = "UPDATE create_blog SET title='$title', story='$story', amount = '$amount' WHERE create_id='$post_id'";
  mysqli_query($con,$query);
  header("Location: viewpost.php");

  if ($error === 0){
    if ($img_size > 125000){
      header("Location: editPost.php");
      exit(0);
    } else {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = array("jpg", "jpeg", "png");
  
      if (in_array($img_ex_lc, $allowed_exs)){
        $new_img_name = uniqid("IMG", true).'.'. $img_ex_lc;
        $img_upload_path = 'IMAGES/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
        

        $sql = "UPDATE create_blog SET image = '$new_img_name' WHERE create_id='$post_id'";
        mysqli_query($con,$sql);
        header("Location: viewpost.php");
        exit(0);
      }else{
        header('location: editPost.php');
        exit(0);
      }
    }
  } else{
    header('location: viewpost.php');
    exit(0);
  }
}

//Delete Post
if(isset($_POST['delete-post']))
{
    $user = mysqli_real_escape_string($con, $_POST['delete-post']);

    $query = "DELETE FROM create_blog WHERE create_id='$user'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header("location: index.php");
        exit(0);
    }
    else
    {
        header("location: editPost.php");
        exit(0);
    }
}
//donation
if (isset($_POST['donation'], $_POST['log'], $_POST['id']))
{

  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM user_tbl WHERE user_id = '$user_id'";
  $sql_run = mysqli_query($con, $sql);

 
  $user = mysqli_fetch_array($sql_run);
  $donator = mysqli_real_escape_string($con, $user['Fname']);
  
  $log = intval(mysqli_real_escape_string($con, $_POST['donation']));
  $add = intval(mysqli_real_escape_string($con, $_POST['log']));
  $id = mysqli_real_escape_string($con, $_POST['id']);
  $result = $log + $add;

  $query = "UPDATE create_blog SET d_count  = '$result', donator='$donator' WHERE create_id='$id'";
  $query_run = mysqli_query($con, $query);
  

  if($query_run)
    {
        header("location: viewpost.php");
        exit(0);
    }
    else
    {
        header("location: viewpost.php");
        exit(0);
    }
  }






  

?>