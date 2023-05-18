<?php

// start session
session_start();

  // 3. execute the query

// creating constant to store non repeating value
 define('SITE_URL','http://localhost/food%20order/');
  define('LOCALHOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','food_order');

  $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
  $db_name = mysqli_select_db($conn, DB_NAME) or die('mysqli_error');//selecting database name
 