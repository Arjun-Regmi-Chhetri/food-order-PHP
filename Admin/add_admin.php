<?php include('partials/header.php') ?>
<div class="container">
<?php
            //check wether the message is display or not
            if(isset($_SESSION['add'])){
             
              echo $_SESSION['add'];
              unset($_SESSION['add']);
            }      
            
          ?>
<form action="" method="post" >
  <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" name="fullname" class="form-control" id="fullname" placeholder ="Enter your fullname" >
  </div>
  <div class="mb-3">
        <label for="fullname" class="form-label">User Name</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
  </div>
 
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<?php include('partials/footer.php') ?>

<?php
// process the value from form and save it in database

// check wether the submit button is clicked or not 
if(isset($_POST['submit'])){
//button clicked

//1.get the data from form
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $password = md5($_POST['password']); //password encrypted

  // 2. sql query to save the data into database

  $sql = "INSERT INTO tbl_admin SET
          full_name = '$fullname',
          username = '$username',
          password = '$password'
  ";


// 3. executing query and save into database
  $res = mysqli_query($conn, $sql) or die(mysqli_error());


//4. check wether the(the query is executed) data is inserted or not  and display appropriate message
  
if($res==TRUE){
  //data inserted
 // echo'Data inserted successfully'

//creating a session varible to displaye message
  $_SESSION['message']='Admin added successfully';

  //redirect page to add admin
  header("location:".SITE_URL.'Admin/admin.php');
}
else{
  //failed to insert data
 // echo'Failed to insert data';

 //creating a session varible to displaye message
 $_SESSION['message']='Admin added failed';

 //redirect page to add admin
 header("location:".SITE_URL.'Admin/add_admin.php');
}
}
