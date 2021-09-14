<?php include 'partials/menu.php'; ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Change Password</h1>
    <br>
<?php
if(isset($_GET['id'])){
  $id=$_GET['id'];
}
 ?>

<form action="" method="post">
  <table class ="tbl-30">
    <tr>
      <td>Current Password:</td>
      <td><input type="password"name="current_password"placeholder="current password"</td>

    </tr>
    <tr>
      <td>New Password:</td>
      <td> <input type="password"name="new_password"placeholder="new password">
      </td>
    </tr>
    <tr>
      <td>Confirm Password:</td>
      <td>
        <input type="password" name="confirm_password" placeholder="confirm password">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="submit" value="change password" class="btn-secondary">
      </td>
    </tr>
  </table>
</form>

  </div>

</div>
<?php
//check whethe the submint button is clicked
if(isset($_POST['submit'])){
  //get the data from the form
  $id=$_POST['id'];
  $current_password = md5($_POST['current_password']);
  $new_password = md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);
  //check whether the user with current id and current password exists or not
  $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password='$current_password'";
  //Execute the query
  $res = mysqli_query($conn, $sql);
  if($res==TRUE)
  {
    //check whether data is available
    $count=mysqli_num_rows($res);
    if($count==1)
    {
      //user exists and password changed
      if($new_password==$confirm_password)
      {
        //update password
         $sql2="UPDATE tbl_admin SET
         password='$new_password'
         WHERE id=$id
         ";
         //Execute the query
         $res2 = mysqli_query($conn, $sql2);
         //Check whether the query executed or not
         if($res2==TRUE)
         {
           //display success message
           $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
           //Redirect the user
           header('location:'.SITEURL.'admin/manage-admin.php');
         }
         else
         {
        //Redirec to manage admin with an error message
        $_SESSION['change-pwd'] = "<div class='error'>Failed to change password</div>";
        //Redirect the user
        header('location:'.SITEURL.'admin/manage-admin.php');
      }
         }


    else
    {
      $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match</div>";
      header('location:'.SITEURL.'admin/manage-admin.php');
    }
  }


    else
    {
      //user does not exist set message and redirect
      $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
      header('location:'.SITEURL.'admin/manage-admin.php');
    }
  }
}



  //check whether the new password and confirm password match or not
  //change password if all above is true


 ?>

<?php include 'partials/footer.php'; ?>
