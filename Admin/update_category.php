<?php include('partials/header.php') ?>
<div class="container p-3">
	<div class="wrapper">
		<h2>Update Category</h2>
	</div>
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
   

    $sql ="SELECT * FROM tbl_category WHERE id=$id";

    $query = mysqli_query($conn, $sql);

   
        $count = mysqli_num_rows($query);

        if($count==1){
            $rows = mysqli_fetch_assoc($query);

            $id=$rows['id'];
            $title=$rows['title'];
            $image= $rows['image_name'];
            $featured = $rows['featured'];
            $active=$rows['active'];
        }
        else{
            $_SESSION['error']="Category not found";
            header('location:'.SITE_URL.'Admin/update_category.php');
        }
    }else{
        header('location:'.SITE_URL.'Admin/category.php');
    }
    ?>

	<form method="post" action="" enctype="multipart/form-data">
	    <div class="mb-3">
		    <label for="title" class="form-label">Title</label>
		    <input type="text" name="title" class="form-control" id="title" value="<?php echo $title;?>" placeholder="Enter the title">
	    </div>
        <div class="my-3">
        <label for="image" class="form-label">Current Image</label>
        <div class="category_image">
            <?php
            if($image!=""){
                ?>
                <img src="<?php echo SITE_URL;?>images/category/<?php echo $image ?>" width="200px">
                <?php
            }
            else{
                echo "Image is not uploaded.";
            }
            
            ?>
        </div>
        </div>
	     <div class="mb-3">
		    <label for="image" class="form-label">Image</label>
		    <input type="file" name="image" class="form-control" id="image" >
	    </div>
	  <div class="mb-3 fs-4">
	        <label for="featured" class="form-label">Featured: </label>
		    <input type="radio" <?php if( $featured == "Yes"){echo "checked";}?> name="featured" class="form-check-input" id="featured" value="Yes" > Yes
		    <input type="radio" <?php if( $featured == "No"){echo "checked";}?> name="featured" class="form-check-input" id="featured" value="No" > No
	  </div>
	  <div class="mb-3 fs-4">
	    <label for="active" class="form-label">Active: </label>
		    <input type="radio" <?php if( $active == "Yes"){echo "checked";}?> name="active" class="form-check-input" id="active" value="Yes" > Yes
		    <input type="radio" <?php if( $active == "No"){echo "checked";}?> name="active" class="form-check-input" id="active" value="No" > No
	  </div>
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <input type="hidden" name="current_image" value="<?php echo $image; ?>">
	  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
            //check wether the message is display or not
            if(isset($_SESSION['error'])){
             
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            }      
            
          ?>
</div>
<?php
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $title = $_POST['title'];
    $image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    
    //updating image
    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        if($image_name !=""){
            $array = explode(".",$image_name);
            $ext = end($array);

            $image_name = "Food_category_".rand(000,999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

          

            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload==false){
                $_SESSION['error']="Failed to upload Images";
                header('location:'.SITE_URL.'Admin/category.php');
                die();
            }

            //remove the current image if avilable
           if( $image !=""){
            $remove_path ="../images/category/".$image;
            $remove = unlink($remove_path);

            //check

            if($remove==false){
                $_SESSION['error']="Failed to remove Images";
                header('location:'.SITE_URL.'Admin/category.php');
                die();
            }
        }
               
        }
        else{
            $image_name=$image;
        }

    }
    else{
        $image_name =$image;
    }

    $sql2= "UPDATE tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    WHERE id=$id
    ";

    $query2= mysqli_query($conn, $sql2);

    if($query2==true){
        $_SESSION['message']="Category Updated Successfully.";
        header('location:'.SITE_URL.'Admin/category.php');
    }
    else{
        $_SESSION['error']="Category Updated Failed.";
        header('location:'.SITE_URL.'Admin/update_category.php');
    }
}
?>
<?php include('partials/footer.php') ?>