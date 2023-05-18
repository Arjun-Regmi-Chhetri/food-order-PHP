<?php include('partials/header.php')?>

<div class="container category">
    <div class="wrapper"> 
        <h2>Add Food</h2>
    </div>
    <?php

    if(isset($_GET['id'])){

        $id =$_GET['id'];

        $sql1 = "SELECT * FROM tbl_food WHERE id ='$id'";

        $query1 = mysqli_query($conn,$sql1);

        $count=mysqli_num_rows($query1);

        if($count==1){
             $rows = mysqli_fetch_assoc($query1);
           
				$title=$rows['title'];
                $description = $rows['description'];
				$price = $rows['price'];
				$image = $rows['image_name'];
				$category = $rows['category_id'];
				$featured = $rows['featured'];
				$active = $rows['active'];
        }
    }
    else{
        header('location:'.SITE_URL.'Admin/food_php');
    }

    ?>
<form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id='title' value="<?php echo $title; ?>">
        </div>
        <div class="mb-3">
            <label for="description">Description</label><br>
            <textarea name="description" id="description" cols="50" rows="5"> <?php echo $description; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" id="price" value="<?php echo $price; ?>">
        </div>
        <div class="mb-3">
            <label>Current Image</label> <br>
            <?php
            if($image!=""){
                ?>
                <img src="<?php echo SITE_URL;?>images/food/<?php echo $image; ?>" alt="" width="100px" height='100px'>
                <?php
            }
            else{
                echo "No image uploaded";
            }
            ?>
        </div>
        <div class="input-group mb-3">
         <input type="file" class="form-control" name="image" id="image">
        </div>
        <div class="mb-3">
            <label for="category">Category</label>
            <select class="form-select" id="category" name="category" >
                <?php
                   
                   $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                   $query = mysqli_query($conn, $sql);

                   $count =mysqli_num_rows($query);

                   if($count>0){
                       while($rows = mysqli_fetch_assoc($query)){
                        $category_id=$rows['id'];
                        $category_title=$rows['title'];
                       ?>
                       <option <?php if($category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>";
                      <?php
                       }                     
                   }
                   else{
                       ?>
                    <option value="0">No category found.</option>
                    <?php
                   }
                     ?>
             </select>
        </div>
       <div class="mb-3">
       <label for="featured">Featured:</label>
       <span class="me-2"></span>
        <input type="radio" <?php if($featured=="Yes"){echo "checked";} ?> name="featured" id="featured" class="form-check-input " value="Yes"><span class="mx-2 text-primary">Yes</span> 
        <input type="radio" name="featured" <?php if($featured=="No"){echo "checked";} ?> id="featured" class="form-check-input" value="No"><span class="mx-2 text-danger">No</span> 
       </div>
       <div class="mb-3">
       <label for="active">Active:</label>
       <span class="me-2"></span>
        <input type="radio" name="active" <?php if($active=="Yes"){echo "checked";} ?> id="active" class="form-check-input " value="Yes"><span class="mx-2 text-primary">Yes</span> 
        <input type="radio" name="active" <?php if($active=="No"){echo "checked";} ?> class="form-check-input " id="active" class="form-check-input" value="No"><span class="mx-2 text-danger">No</span> 
       </div>
       <input type="hidden" name='id' value ="<?php echo $id;?>">
       <input type="hidden" name="current_image" value="<?php $image; ?>">
       <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <?php

  if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $title = $_POST['title'];
    $image = $_POST['current_image'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category'];
    $featured =$_POST['featured'];
    $active = $_POST['active'];

     //updating image
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

            if($image !=""){
                $remove_path ="../images/food/".$image;
                $remove = unlink($remove_path);

                if($remove == false){
                    $_SESSION['error'] ="Failed to remove image";
                header('location:'.SITE_URL.'Admin/add_food.php');
                die();
                }
            }

        }
        else{
            $image_name =$image;
        }
    }
    else{

        //if image is not selected set default value
        $image_name =$image;
    }
    $sql2 = "UPDATE tbl_food SET
             title ='$title',
             description='$description',
             image_name='$image_name',
             price=$price,
             category_id ='$category_id',
             featured='$featured',
             active='$active'
             WHERE id=$id
            ";

     $query2= mysqli_query($conn, $sql2);

     if($query2==true){
        $_SESSION['message']="Food Updated Successfully.";
        //header('location:'.SITE_URL.'Admin/food.php');
        echo"<script>window.location.href='food.php'</script>";
     }
     else{
        $_SESSION['message']="Faield to add food.";
        header('location:'.SITE_URL.'Admin/food.php');
     }
  }

  ?>
<?php include('partials/footer.php')?>
