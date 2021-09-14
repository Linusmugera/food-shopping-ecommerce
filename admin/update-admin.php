<?php include('partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Update Admin</h1>
    <br>
<?php
//Get the id of the  selected Admin
$id=$_GET['id'];
//create sql query to get the details
$sql="SELECT * FROM tbl_admin WHERE id=$id";
//Execute the querry
$res=mysqli_query($conn,$sql)or die(mysqli_error());
//check whether the query is executed
if($res==TRUE){
  //check whether the data is available or
  $count = mysqli_num_rows($res);
  //check whether we have admin data or not
  if($count==1){
    //Get the details
    $row=mysqli_fetch_assoc($res);
    $full_name= $row['full_name'];
    $username = $row['username'];
  }
  else{
    // Redirect to manage Admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
  }
}
 ?>

    <form action="" method="post">
      <table class="tbl-30">
        <tr>
          <td>Full Name:</td>
          <td>
            <input type="text" name="full_name" value="<?php echo $full_name ?>">
          </td>
        </tr>

        <tr>
          <td>Username:</td>
          <td>
            <input type="text" name="username" value="<?php echo $username ?>">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
          </td>
        </tr>
      </table>

    </form>

  </div>
</div>
<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
  //get values from form to update
$id=$_POST['id'];
$full_name=$_POST['full_name'];
  $username = $_POST['username'];
  //create sql query to update admin
$sql="UPDATE tbl_admin SET
  full_name = '$full_name',
  username = '$username'
  WHERE id = '$id'
  ";
//Execute querry
$res = mysqli_query($conn, $sql);
//check the whether the query executed Successfully
if($res==TRUE){
  $_SESSION['update']= " <div class='success'> Admin updated Successfully</div>";
  //Redirect to manage Admin page
  header('location:'.SITEURL.'admin/manage-admin.php');
}

else{
  //failed to update admin
  $_SESSION['update']= " <div class='error'> Failed to update admin. Try again later</div>";
  //Redirect to manage Admin page
  header('location:'.SITEURL.'admin/manage-admin.php');
}
}
 ?>



<?php include('partials/footer.php') ?>
