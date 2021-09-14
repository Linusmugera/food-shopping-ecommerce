<?php
//include constants.php file here
include("../config/constants.php");
//get the id of the admin to be deleted
$id=$_GET['id'];
//create sql query to delete the Admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//Execute the querry
$res = mysqli_query($conn, $sql);
//check whetherr the query executed Successfully
if($res==TRUE){
  //echo "admin deleted";
//create session variable to display the message
$_SESSION['delete'] = "<div class='delete'>Admin deleted Successfully</div>";
//REdirect to manage admin
header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
  //echo "failed to delete admin";
  $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later</div>";
  //REdirect to manage admin
  header('location:'.SITEURL.'admin/manage-admin.php');

}
//Redirect to manage admin page with a message

 ?>
