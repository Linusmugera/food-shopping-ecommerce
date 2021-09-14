<?php
//Authorization access control
//check whether the user is logged in or not
if(!isset($_SESSION['user']))
{

  //user is not logged in
  // Redirect to login page
  $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please login to access Admin Panel.</div>";
  //Redirect to login page
  header('location:'.SITEURL.'admin/login.php');
}

 ?>
