<?php

include("../config/constant.php");

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    $id =$_GET['id'];
    $image = $_GET['image_name'];
    

    //removing image from the file
    if($image !=""){

        $remove_path ="../images/food/". $image;
        $remove = unlink($remove_path);

        if($remove == false){
            $_SESSION['error']="Image deleted failed";
            header('location:'.SITE_URL.'Admin/food.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_food WHERE id=$id";

    $query = mysqli_query($conn, $sql);

    if($query==true){
        $_SESSION['message']="Deleted Successfully";
        header('location:'.SITE_URL.'Admin/food.php');
    }
    else{
        $_SESSION['error']="Deleted failed";
        header('location:'.SITE_URL.'Admin/food.php');
    }
}
else{
    header('location:'.SITE_URL.'Admin/food.php');
}
