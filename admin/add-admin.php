<?php include('partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>
    <br>
    <?php
if(isset($_SESSION['add'])){
  echo $_SESSION['add'];
  unset($_SESSION['add']);
}
     ?>
    <form action="" method="post">
      <table class="tbl-30">
        <tr>
          <td>Full Name:</td>
          <td>
            <input type="text" name="full_name" placeholder="Enter your name"> </td>
        </tr>

        <tr>
          <td>Username:</td>
          <td>
            <input type="text" name="username" placeholder="Your Username">
          </td>
        </tr>

        <tr>
          <td>Password:</td>
          <td>
            <input type="password" name="password" placeholder="Your password">
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

  </div>

</div>

<?php include('partials/footer.php') ?>

<?php

//process the value from form and save it in database
//check whether the submit button is clicked
if (isset($_POST['submit'])) {
//Get data from the form
$full_name =$_POST['full_name'];
$username= $_POST['username'];
$password=md5($_POST['password']);

//sql querry to save data to database
$sql = "INSERT INTO tbl_admin SET
full_name='$full_name',
username='$username',
password='$password'
";
// Execute query and save data to database
$res = mysqli_query($conn, $sql) or die(mysqli_error());
//Check whether the data is inserted or not and display appropriate message
if($res==TRUE){
  //create a session variable to dispaly Message
  $_SESSION['add'] = "<div class='success'>Admin added Successfully</div>";
  //Redirect page to Manage-Admin
  header("location:".SITEURL.'admin/manage-admin.php');
}
else{
  $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
  //REdirect page to add Admin
  header("location:".SITEURL.'admin/add-admin.php');
}
}
?>
