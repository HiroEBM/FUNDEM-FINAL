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
    <link rel="icon" href="IMAGES/PLACEHOLDERS/LOGO.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/viewpost.css" />
    <script src="https://www.paypal.com/sdk/js?client-id=AXH_1pN91wGgKdUa0T3sD7yvTw4qyXNMFjI_Cz8FAuKFU75cWIZhsrI7_UITJRkcV32Skgk0YJ6lGD8H&currency=PHP"></script>
    <title>View Post</title>
  </head>
  <body>
   
    <div class="container">
    <?php include ('includes/navbar.php');?>
    <?php
      $user_id = $_SESSION['user_id'];
      $user_frid = $_SESSION['viewed_post_user_id'];
      $create_id = $_SESSION['viewed_post_create_id'];

      $sql = "SELECT * FROM user_tbl WHERE user_id = '$user_frid'";
      $sql_run = mysqli_query($con, $sql);
        
      $query = "SELECT * FROM create_blog WHERE create_id = '$create_id'";
      $query_run = mysqli_query($con, $query);
    

      if(mysqli_num_rows($sql_run)>0){
        $user = mysqli_fetch_array($sql_run);
      if(mysqli_num_rows($query_run)>0){
        $post = mysqli_fetch_array($query_run);
    ?>
        <header class="header">
            <div class="image">
                <img src="IMAGES/<?= $post['image'];?>" alt="header image"  />
              </div>

          <div class="content">
          <h1><?=$post['title'];?></h1>
          <p class = "form-control">
              <?=$post['story'];?>
            </p>
        <p><span>Date Posted: <?= $post['date']?></span></p>
         <p><span>Posted by: <?= $user['Fname']?> <?= $user['Lname']?></span></p>

        <div class="donate-section">
             <p><span><strong>P<?=$post['d_count']?> raised </strong> of P<?= $post['amount']?> </span></p>
            <form id="myForm" action="code.php" method = "POST">
              <input id='donate'type="text" name = "donation" placeholder="amount to donate" >
              <input type="hidden" name= "id" value ="<?= $post['create_id'];?>"/>
              <input type="hidden" name= "log" value ="<?= $post['d_count'];?>"/>
            </form>
            
            <a href = "" type="button" id='donate_But' class="btn mt-4 "></a>
            <a href = 'editPost.php' type="button" id = 'edit-post' class="btn btn-outline-dark mt-4 ">Edit Post</a>

            <script>
            
            let user_id = '<?= $user_id ?>';
            let user_frid = '<?= $user_frid ?>';

        if (user_id !== '' && user_id === user_frid) {
           document.getElementById('donate').style.display = 'none';
           document.getElementById('donate_But').style.display = 'none';
    }
    else {
      document.getElementById('edit-post').style.display = 'none';
    }
    //API
      paypal.Buttons({
        createOrder: function(data, actions){
          const donate = document.getElementById('donate').value;
            return actions.order.create({
              purchase_units: [{
                amount: {
                  currency_code: "PHP",
                  value: donate
                        }
                    }]
                })

            },
            onApprove: function(data, actions){
                console.log('Data :' + data);
                console.log('Action : '+actions);
                return actions.order.capture().then(function(details){
                    console.log(details);
                    alert("Transaction Status: " + details.status);
                    setTimeout(function() {
                      document.getElementById('myForm').submit();
                        }, 100);
                })
            }
        }).render('#donate_But');



        //for page refresh




            
          </script>  
         </div>
      </div>
        </header>
      </div>

      <?php
            }
          }
?> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php include '<includes/footer.php' ?>
  </body>
</html>