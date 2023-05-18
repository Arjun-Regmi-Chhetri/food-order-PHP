<?php include('partials/header.php')?>

<div class="main">  
    <div class="container">
        <div class="row">
            <h2>Upadte Admin</h2>
        </div>

        <?php 
        //1. get the id 
        $id = $_GET['id'];

        //2. create sql query
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //3.execute the query
        $query= mysqli_query($conn, $sql) or die(mysqli_error());

        //4.Check the query wether data is execute or not

        if($query==true){

            //check wether data is avialabe or not

            $count = mysqli_num_rows($query);

            //check wether we have admin data or not
            
            if($count==1){
                //get the details
                //echo "admin avilable";
                $rows = mysqli_fetch_assoc($query);

                $fullname = $rows['full_name'];
                $username = $rows['username'];
            }
            else{
                //redirect to admin.php

                header("location:".SITE_URL.'Admin/admin.php');
            }
        }

        ?>
        <form action="" method="post" >
                <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder ="Enter your fullname" value='<?php echo $fullname; ?>'>
                </div>
                <div class="mb-3">
                        <label for="fullname" class="form-label">User Name</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" value='<?php echo $username; ?>'>
                </div>
                
                <!-- <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                </div> -->
                <input type="hidden" name='id' value= '<?php echo $id; ?>'>
                <button type="submit" name="submit" class="btn btn-primary">Update Admin</button>
        </form>


      <?php

      //check wether the submit button is clicked or not
      if(isset($_POST['submit'])){
         // echo 'button clicked';
         
         //1. get the data from the form

          $id = $_POST['id'];
          $fullname = $_POST['fullname'];
          $username = $_POST['username'];

          //2. create sql query

          $sql = "UPDATE tbl_admin SET
                  full_name ='$fullname',
                  username = '$username'
                  WHERE id = '$id'
                  ";

         //3. execute query

         $query = mysqli_query($conn, $sql) or die(mysqli_error());

         //4. chcek the query is executed or not

         if($query == true){
             //data succcessfully updated
             $_SESSION['message']='Admin updated successfully';
             header('location:'.SITE_URL.'Admin/admin.php');
         }
         else{
             //failed to update data
             $_SESSION['message']='Admin updated failed';
             header('location:'.SITE_URL.'Admin/admin.php');
         }
      }

      ?>


    </div>
</div>
<?php include('partials/footer.php')?>