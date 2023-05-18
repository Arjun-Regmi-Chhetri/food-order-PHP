<?php include('../config/constant.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container"> 
    <div class="form_box">

    <form method="post" action="">
      <h2 class="text-center mb-5">Login</h2>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="username" >
  </div>
  <div class="mb-2">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password" >
  </div>
  <?php
  if(isset($_SESSION['error_message'])){
    echo $_SESSION['error_message'];
    unset($_SESSION['error_message']);
  } 
  ?>
  <br>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
    </div>

</div>
<?php
//check wether the message is display or not
if(isset($_SESSION['error_message_login'])){
  ?>
  <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
   <?php echo $_SESSION['error_message_login']; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
 
  unset($_SESSION['error_message_login']);
}      

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<?php

//check wether the submit button is clicked or not
if(isset($_POST['submit'])){

//1. get the values from the form
 $username = $_POST['username'];
 $password = md5($_POST['password']);

 //2.create sql query wether the username and password is exits or not

 $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

 //execute query

 $query = mysqli_query($conn, $sql);

 //count the rows wether the user exits or not

 $count = mysqli_num_rows($query);

 //check the count

 if($count==1){
   //user avilable
   $_SESSION['message']="Login Successfull";
   $_SESSION['user']=$username; //to check wether user is logged in or not and logout will unset it 

   //redirect to index of admin

  header('location:'.SITE_URL.'Admin/');
 }
 else{
   //user not avilable
   $_SESSION['error_message']="<div class='error'>User does not match</div>";

   header('location:'.SITE_URL.'Admin/login.php');
  
 }

}
?>