<?php
//include constant file
include('../config/constants.php');
//check whether the id and image name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
  //Get the value and delete
  $id=$_GET['id'];
  $image_name=$_GET['image_name'];
  //remove the physical image if available
  if($image_name !="")
  {
    //image is available so remeve it
    $path="../images/category/".$image_name;
    //Remove the image
    $remove = unlink($path);
    //if failed to remove image then add an error message and stop the process
    if($remove==false)
    {
    $_SESSION['remove']="<div class = 'error'>Failed to remove category image.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
    //stop the process
      die();
    }
  }
  //Delete data from database
  $sql = "DELETE FROM tbl_category WHERE id=$id";
  //execute the query
  $res = mysqli_query($conn, $sql);
  //check whether the data is deleted from db or not
  if($res==true)
  {
    //set success message and redirect
    $_SESSION['delete'] = "<div class = 'success'>Category deleted successfully.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
    }
    else {
      //set fail message and redirect
      $_SESSION['delete']= "<div class = 'error'>Failed to delete category.</div>";
      header('location:'.SITEURL.'admin/manage-category.php');
    }

}
else
{
  //redirect to manage category page
  header('location:'.SITEURL.'admin/manage-category.php');
}

 ?>
