<?php
include('../config/constant.php');

//check wether id and image value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get the values and delete
   // echo"delete the values11";

   $id=$_GET['id'];
   $image_name = $_GET['image_name'];

   //remove the physical file avilable
   if($image_name !=""){
       //image is avialable remove it 
       $path = '../images/category/'.$image_name;
       //remove the image
       $remove = unlink($path);

       //if failed to remove image then add an error message and stop the process
       if($remove==false){
           $_SESSION['error']="Image upload failed";
           header('location:'.SITE_URL.'Admin/category.php');
           die();
       }
   }

   $sql = "DELETE FROM tbl_category WHERE id=$id";

   $query=mysqli_query($conn, $sql);

   if($query==true){
       $_SESSION['message']="Category deleted successfully.";
       header('location:'.SITE_URL.'Admin/category.php');
   }
   else{
    $_SESSION['error']="Failed to delete";
    header('location:'.SITE_URL.'Admin/category.php');
   }
}
else{

    header('location:'.SITE_URL.'Admin/category.php');
}