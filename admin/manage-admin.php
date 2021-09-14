<?php include('partials/menu.php'); ?>
<!-- main section starts -->
<div class="main-content">
  <div class="wrapper">
<h1>Manage Admin</h1>
<?php
if(isset($_SESSION['add'])){
  echo $_SESSION['add']; // Displaying session message
  unset($_SESSION['add']); //Removig session message
}
if(isset($_SESSION['delete'])){
  echo $_SESSION['delete'];
  unset($_SESSION['delete']);
}
if(isset($_SESSION['update'])){
  echo $_SESSION['update'];
  unset($_SESSION['update']);
}
if(isset($_SESSION['user-not-found'])){
  echo $_SESSION['user-not-found'];
  unset($_SESSION['user-not-found']);
}
if(isset($_SESSION['pwd-not-match'])){
  echo $_SESSION['pwd-not-match'];
  unset($_SESSION['pwd-not-match']);
}
if(isset($_SESSION['change-pwd'])){
  echo $_SESSION['change-pwd'];
  unset($_SESSION['change-pwd']);
}
 ?>
 <br> <br>
 <!-- button to add aadmin -->
 <a class="btn-primary" href="add-admin.php" > Add Admin</a>
 <br/><br/>
  <table class="fulltable">
  <tr>
    <th>S.N</th>
    <th>full Name</th>
    <th>Username</th>
    <th>Actions</th>
  </tr>

  <?php
  //query to get all admin
$sql = "SELECT * FROM tbl_admin";
//Execute the query
$res = mysqli_query($conn, $sql);
//check whether the query is executed
if($res==TRUE){
  //Count rows to check whether we have  data in database or not
  $count = mysqli_num_rows($res); //function to get all rows in db
  $sn=1; //create a variable and assign the value
  //check the num of rows
  if($count>0){
    //we have data in database
    while($rows=mysqli_fetch_assoc($res)){
      //using while loop to get all the data from database.
      //And while loop will run as long as we have data in database
      //Get individual data
      $id=$rows['id'];
      $full_name=$rows['full_name'];
      $username=$rows['username'];
      //Display the vallue in our table
      ?>
      <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $full_name; ?></td>
        <td><?php echo $username; ?></td>
        <td>
<a class="btn-primary"href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>">Change Password</a>
<a class="btn-secondary"href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>">Update Admin</a>
<a class="btn-danger"href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>">Delete Admin</a>
        </td>
      </tr>
      <?php
    }
  }
  else{
    //We do not have data in database.
  }

}

   ?>

</table>
</div>
  </div>
</div>
<!-- main section ends here -->
<?php include('partials/footer.php'); ?>
