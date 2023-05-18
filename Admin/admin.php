<?php include('partials/header.php')?>
          <?php


            //check wether the message is display or not
            if(isset($_SESSION['message'])){
              ?>
              <div class="alert alert-primary alert-dismissible fade show text-white" role="alert">
               <?php echo $_SESSION['message']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
           
            <?php
             
              unset($_SESSION['message']);
            }      
            
          ?>
    


<section class="main">
<div class="container">
    <div class="row " >
        <div class="col">
          <h2>Admin</h2>
        </div>
        <div class="col text-end">
           <h2><a href="add_admin.php">Add Admin</a></h2> 
        </div>
    </div>
    
          
  
    <table class="table table-striped">
    <thead>
    <tr>
      <th scope="col">S.N</th>
      <th scope="col">Full name</th>
      <th scope="col">Username</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <?php
   //query to get all admin
   $sql = "SELECT * FROM tbl_admin";

   //execute the query
   $res = mysqli_query($conn, $sql);

   //check wether the query is executed or not
   if($res == TRUE){
   //count the rows to check wether we have database or not
   $count = mysqli_num_rows($res);

   $sn = 1;
   //check the num of rows
   if($count>0){
     //we have data in database

     while($rows=mysqli_fetch_assoc($res)){
       //using while loop to get all data from the database.
       //And while loop is run as long as we have data in database

       //Get indivudial data 
      $id = $rows['id'];
       $fullname = $rows['full_name'];
       $username = $rows['username'];
       ?>
      <tbody>
          <tr>
            <th scope="row"><?php echo $sn++; ?></th>
            <td><?php echo $fullname; ?></td>
            <td><?php echo $username; ?></td>
            <td>
              <a href="<?php echo SITE_URL?>Admin/change_password.php?id=<?php echo $id; ?>" class="update">Change Password</a>
                <a href="<?php echo SITE_URL?>Admin/update_admin.php?id=<?php echo $id; ?>" class="update">Update</a>
                <a href="<?php echo SITE_URL?>Admin/delete_admin.php?id=<?php echo $id; ?>" class="delete">Delete</a>
            </td>
          </tr>
        </tbody>
   <?php
     }
   //displaying all the values in our table
   
   }
   else{
     //we do not have data in database
   }
   }

  ?>
  
    </table>
</div>
</section>

<?php include('partials/footer.php')?>