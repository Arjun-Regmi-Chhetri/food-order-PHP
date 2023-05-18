<?php include('partials/header.php') ?>
<div class="container">

<?php
if(isset($_GET['id'])){
  $id =$_GET['id'];
}
?>


<form action="" method="post" >
  <div class="mb-3">
        <label for="old_password" class="form-label">Old Password</label>
        <input type="password" name="current_password" class="form-control" id="old_password" placeholder="Enter your old password">
  </div>
  <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter your new password">
  </div>
 
  <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm your password">
  </div>
  <?php
  if(isset($_SESSION['error_message'])){
    echo $_SESSION['error_message'];
    unset($_SESSION['error_message']);
  } 
  ?>
  <input type="text" name="id" value=" <?php echo $id ?>">
  <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
</form>
</div>

<?php include('partials/footer.php') ?>

 <?php
// process the value from form and save it in database

// check wether the submit button is clicked or not 
if(isset($_POST['submit'])){
//button clicked

//1.get the data from form
 $id = $_POST['id'];
 $current_password =md5($_POST['current_password']) ;
 $new_password =md5($_POST['new_password'])  ;
$confirm_password =md5($_POST['confirm_password']) ; //password encrypted


//2. create sql query

$sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

//3. Execute query

$query = mysqli_query($conn, $sql);

//4. Check the query wether it is submitted or not

if($query==true){

  //check wether data is avilable or not
  $count = mysqli_num_rows($query);

  if($count==1){
    //user exist and password can be changed
    if($new_password==$confirm_password){
      $sqlPsw = "UPDATE tbl_admin SET password='$new_password' WHERE id= $id";

      $queryPsw = mysqli_query($conn, $sqlPsw);

      if($queryPsw==true){
        $_SESSION['message']="<div>Password changed successfully.</div>";
        header("location:".SITE_URL.'Admin/admin.php');

      }
      else{
        $_SESSION['error_message']="<div class='error'>Failed to change password.</div>";
        header("location:".SITE_URL.'Admin/change_password.php');
      }
      }
      else{
        $_SESSION['error_message']="<div class='error'>Password Doesnot Match.</div>";
        header("location:".SITE_URL.'Admin/change_password.php');
      }

    }
  else{
    $_SESSION['message']="User not found";
    header("location:".SITE_URL."Admin/admin.php");
  }
 }
}
 ?>