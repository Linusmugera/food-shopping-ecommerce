<?php include 'partials/menu.php'; ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
    <br>
    <?php
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if(isset($_SESSION['upload']))
    {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
     ?>
     <br>
    <!--Add category starts here -->
<form class="" action="" method="post" enctype="multipart/form-data">
  <table class = "tbl-30" >
    <tr>
      <td>Title:</td>
      <td>
      <input type="text" name="title"placeholder="Category Title">
    </td>
    </tr>

    <tr>
      <td>Select Image</td>
      <td>
<input type="file" name="image">
      </td>
    </tr>

<tr>
  <td>Featured:</td>
  <td>
<input type="radio" name="featured" value="yes">Yes
<input type="radio" name="featured" value="no">No
  </td>
</tr>
<tr>
  <td>Active:</td>
  <td>
<input type="radio" name="active" value="yes">Yes
<input type="radio" name="active" value="no">No
  </td>
</tr>
<tr>
  <td colspan="2">
<input type="submit" name="submit" value="Add Category" class = "btn-secondary">
  </td>
</tr>

  </table>
</form>

      <!--Add category ends here -->
      <?php
//check whether the submit button is clicked
if(isset($_POST['submit']))
{
  //Get the values
  $title = $_POST['title'];
  //for radio input, check whether the button is selected or not
  if(isset($_POST['featured']))
  {
    //get the value
    $featured = $_POST['featured'];
  }
  else
  {
    //set the default value
    $featured = "No";
  }
  if(isset($_POST['active']))
  {
    $active=$_POST['active'];
  }
  else {
    $active = "No";
  }
  //check whether the image is selected or not
  //set the value for image name accordingly
  //print_r($_FILES['image']);
  //die();
  if(isset($_FILES['image']['name']))
  {
    //upload the image
    //To upload image we need image name, source path and destination path
    $image_name = $_FILES['image']['name'];
    //upload the image only if image is selected
    if($image_name != "")
    {
    //Auto rename the image
    //Get the extension of our image
    $ext=end(explode('.', $image_name));

    //Rename the image
    $image_name = "food_Category_".rand(000, 999). '.'.$ext;
    $source_path = $_FILES['image']['tmp_name'];

    $destination_path = "../images/category/".$image_name;
    //finally upload the image
    $upload = move_uploaded_file($source_path,$destination_path);
    //check whether the image is uploaded or not
    //If not uploaded then stop the process and redirect with error message
    if($upload==false)
    {
      //Set message
      $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
      //Redirect to add category page
      header('location:'.SITEURL.'admin/add-category.php');
      //stop the process
      die();
    }
    }
  }
  else
  {
    //Don't upload the image  and set the image name value as blank
    $image_name = "";
  }
  // create sql query to insert into database
  $sql = "INSERT INTO tbl_category SET
        title = '$title',
        image_name= '$image_name',
        featured = '$featured',
        active = '$active'
        ";
        //Execute the query and save in database
        $res = mysqli_query($conn, $sql);
        //check whether the query executed or not and data added or not
        if($res==true)
        {
          //query executed and category added
          $_SESSION['add'] = "<div class = 'success'> Category added successfully. </div>";
          //Redirect to manage category page
          header('location:'.SITEURL.'admin/manage-category.php');
        }
        else {
          //failed to add category
          $_SESSION['add'] = "<div class = 'error'> Failed to add category. </div>";
          //Redirect to manage category page
          header('location:'.SITEURL.'admin/add-category.php');
        }
}

       ?>

  </div>

</div>

<?php include 'partials/footer.php'; ?>
