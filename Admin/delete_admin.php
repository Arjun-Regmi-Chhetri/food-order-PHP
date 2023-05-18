<?php

// including constant
 include('../config/constant.php');

// 1. Get the id of the admin to be deleted
$id = $_GET['id'];

// 2.create sql query 
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//3. execute query
$res = mysqli_query($conn, $sql);

// 4. chcek the query is deleted or not

if($res==true){
   //delete susccess fully

   //creating session to display appropriate message
   $_SESSION['message']='Admin has been deleted successfully.';

   //redirect to admin page
   header('location:'.SITE_URL.'Admin/admin.php');
}
else{
//delete failed

   //creating session to display appropriate message
   $_SESSION['message']='Admin is failed to delete.';

      //redirect to admin page
      header('location:'.SITE_URL.'Admin/admin.php');
}
?>