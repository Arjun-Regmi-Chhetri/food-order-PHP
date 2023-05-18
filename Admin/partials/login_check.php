<?php

//Authorization-acess control

//check wether the user is logged in or not

if(!isset($_SESSION['user'])){ //if user session is not set
//user is not logged in

//redirect login page with sesssion message
$_SESSION['error_message_login'] ='You need to login first';

//redirect location

header('location:'.SITE_URL.'Admin/login.php');
}
?>