<?php

//1.include constant
include('../config/constant.php');

//2. destroy session
session_destroy(); //it unset session['user']

//3.redirect location
header('location:'.SITE_URL.'Admin/login.php');

