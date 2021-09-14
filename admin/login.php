<!DOCTYPE html>
<?php include('../config/constants.php'); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
  </head>
  <body>
    <div class="login">
      <h1 class = "text-center">Login</h1>
      <br>
      <?php
      if(isset($_SESSION['login']))
      {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      }
      if(isset($_SESSION['no-login-message']))
      {
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
      }
       ?>
       <br><br>

      <!-- login form starts here-->
      <form class="text-center" action="" method="post">
        Username:<br>
        <input type="text" name="username" placeholder="Enter username"><br><br>
        Password:<br>
        <input type="password" name="password" placeholder="Enter password"><br><br>
        <input type="submit" name="submit" value="login" class="btn-primary">
        <br><br>
      </form>
      <p>Created by = <a href="mugeralinus@gmail.com">Linus Mugera</a></p>
    </div>
  </body>
</html>

<?php
//check whether the submit button is clicked
if(isset($_POST['submit']))
{
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  //2. sql to check whethe the user with username and passwword exist or not.
$sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
// execute query
$res = mysqli_query($conn, $sql);
// Count rows to check whether the user exists or not
$count = mysqli_num_rows($res);
if($count==1)
{
  //User available and login success
  $_SESSION['login'] = "<div class = 'success'> Login successful.</div>";
  $_SESSION['user'] = $username; //To check whether the user is logged in or not
  //Redirect to homepage/dashboard
  header('location:'.SITEURL.'admin/');
}
else {
  //user not availble and login fail
  $_SESSION['login'] = "<div class = 'error text-center'> Username and password did not match.</div>";
  //Redirect to homepage/dashboard
  header('location:'.SITEURL.'admin/login.php');
}
}

 ?>
