<?php include('partials/header.php') ?>


<div class="container category">
    <div class="wrapper"> 
        <h2>Add Category</h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id='title'>
        </div>
        <div class="input-group mb-3">
         <input type="file" class="form-control" name="image" id="image">
         <label class="input-group-text" for="image">Upload</label>
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
    <?php 
        if(isset($_SESSION['error'])){
	?>
	<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
     <?php echo $_SESSION['error']; ?>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
	<?php
	unset($_SESSION['error']);
}
?>
  
</div>
<?php include('partials/footer.php'); ?>

<?php

if(isset($_POST['submit'])){

    $title=$_POST['title'];
    
    if(isset($_POST['featured'])){
       $featured=$_POST['featured'];
    }
    else{
        $featured="Yes";
    }

    if(isset($_POST['active'])){
      $active=$_POST['active'];
    }
    else{
        $active="Yes";
    }

    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];

        if($image_name !=""){
            //auto renaming image
        //get the extension of our image (PNG,JPG,GIF) eg 'special.food.jpg'
        $ext= end(explode('.',$image_name));

        $image_name ='Food_Category_'.rand(000,999).'.'.$ext;


        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/".$image_name;
        $upload=move_uploaded_file( $source_path , $destination_path);

        if($upload == false){
           // echo 'failed to upload';
            $_SESSION['error']="Failed to upload photo";
            header('location:'.SITE_URL.'Admin/add_category.php');
            die();
        }
        }
        
    }
    else{
        $image_name="";
    }

    $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
           ";
    
    $res = mysqli_query($conn, $sql) ;

    if($res==true){
        //setting messages
        $_SESSION['message']="Category successfully added";
        //redirect
        //header('location:'.SITE_URL.'Admin/add_category.php');
        echo "<script>window.location.href= 'category.php' </script>";
    
    }
    else{
        $_SESSION['error']="Failed to added category";
        header('location:'.SITE_URL.'Admin/add_category.php');
    }
}
?>