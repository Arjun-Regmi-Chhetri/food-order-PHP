<?php include('partials/header.php')?>
<?php


//check wether the message is display or not
if(isset($_SESSION['error'])){
    ?>
    <div class="alert alert-danger alert-dismissible  show text-white" role="alert">
     <?php echo $_SESSION['error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  
  <?php
   
    unset($_SESSION['error']);
  }      
  
  ?>

<div class="container category">
    <div class="wrapper"> 
        <h2>Add Food</h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id='title' placeholder="Enter title">
        </div>
        <div class="mb-3">
            <label for="desciption">Description</label><br>
            <textarea name="description" id="description" cols="50" rows="5" placeholder="Enter description"></textarea>
        </div>
        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" step="0.01" class="form-control" id="price">
        </div>
        <div class="input-group mb-3">
         <input type="file" class="form-control" name="image" id="image">
        </div>
        <div class="mb-3">
            <label for="category">Category</label>
            <select class="form-select" id="category" name="category">
            <option value="1">No category found.</option>
                <?php
                   
                   $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";
                   $query = mysqli_query($conn, $sql);

                   $count =mysqli_num_rows($query);

                   if($count>0){
                       while($rows = mysqli_fetch_assoc($query)){
                        $id=$rows['id'];
                        $title=$rows['title'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                        <?php
                       }                     
                   }
                   else{
                       ?>
                    <option value="1">No category found.</option>
                    <?php
                   }
                     ?>
             </select>
        </div>
       <div class="mb-3">
       <label for="featured">Featured:</label>
       <span class="me-2"></span>
        <input type="radio" name="featured" id="featured" class="form-check-input " value="Yes"><span class="mx-2 text-primary">Yes</span> 
        <input type="radio" name="featured" id="featured" class="form-check-input" value="No"><span class="mx-2 text-danger">No</span> 
       </div>
       <div class="mb-3">
       <label for="active">Active:</label>
       <span class="me-2"></span>
        <input type="radio" name="active" id="active" class="form-check-input " value="Yes"><span class="mx-2 text-primary">Yes</span> 
        <input type="radio" name="active" class="form-check-input " id="active" class="form-check-input" value="No"><span class="mx-2 text-danger">No</span> 
       </div>
       <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
//process the form and get the value

//checked wether the submit button is clicked or not
if(isset($_POST['submit'])){

    //get the values from the form
    $title=$_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category=$_POST['category'];
    
    if(isset($_POST['featured'])){
        $featured =$_POST['featured'];
    }else{
        $featured ="No";
    }
    if(isset($_POST['active'])){
        $active =$_POST['active'];
    }else{
        $active ="No";
    }

    //uploading image 
    if(isset($_FILES['image']['name'])){
        //image name 

        $image_name = $_FILES['image']['name'];

        //chceck the image name and upload it
        if($image_name !=""){

            //rename image 
            
            $ext =end(explode(".", $image_name));
            $image_name ="Food_Name_".rand(000,999).'.'.$ext;

            //source path and destinatiion path for saving images
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/".$image_name;

            //upload
            $upload = move_uploaded_file($source_path,$destination_path);

            if($upload == false){
                $_SESSION['error'] ="Failed to upload image";
                header('location:'.SITE_URL.'Admin/add_food.php');
                die();
            }

        }
    }
    else{

        //if image is not selected set default value
        $image_name ="";
    }

    $sql2 = "INSERT INTO tbl_food SET
             title='$title',
             description='$description',
             price=$price,
             image_name='$image_name',
             category_id='$category',
             featured ='$featured',
             active='$active'
            ";
    $query2=mysqli_query($conn, $sql2);

    if($query2==true){
        $_SESSION['message']="Successfully added Food.";
       // header('location:'.SITE_URL.'Admin/food.php');
       echo "<script>window.location.href='food.php'</script>";
    }
    else{
        $_SESSION['error']="Failed added Food.";
        echo "<script>window.location.href='food.php'</script>";
    }
}
?>

<?php include('partials/footer.php')?>