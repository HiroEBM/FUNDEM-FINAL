<?php
session_start();
@include 'dbcon.php';

if(!isset($_SESSION['user_id'])){
  header("location:login.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/yourpost.css" />
    <link rel="icon" href="IMAGES/PLACEHOLDERS/LOGO.png" type="image/png">
    <title>View Post</title>
  </head>
  <body>
   
  

  <div class="container-1">
  <?php include "includes/navbar.php"?>
     
     <div class="box-container">
<?php 


$user_id = $_SESSION['user_id'];    
$sql = "SELECT * FROM user_tbl WHERE user_id ='$user_id' ";
$query_run1 = mysqli_query($con, $sql);  

if(mysqli_num_rows($query_run1) > 0){
    foreach($query_run1 as $user);
}

$query = "SELECT * FROM create_blog WHERE user_id ='$user_id' ";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $post){
        ?>
          <div class="box">
              <img src="IMAGES/<?= $post['image']?>">
              <h3><?= $post['title']?></h3>
              <p>
                <strong>Name:</strong> <?= $user['Fname'];?>
                                       <?= $user['Lname'];?>
              </p>
              <p>
              <strong>Target Amount:</strong> <?php echo $post['amount'];?>
              </p>
              <a href="test.php?create_id=<?= $post['create_id'] ?>&user_id=<?= $post['user_id'] ?>" class="btn">VIEW</a>
          </div>

      <?php
            }
          }
?> 

   </div>
        </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>