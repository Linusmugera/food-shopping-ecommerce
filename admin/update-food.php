<?php include('partials/menu.php'); ?>
<div class="main-content">
  <div class="wrapper">
<h1>Update Food</h1>
<?php
//check whether the id is set or not
if(isset($_GET['id']))
{
//Get the id and all oher details
$id=$_GET['id'];
//create sql query to get all other details
$sql = "SELECT * FROM tbl_food WHERE id=$id";
//Execute the query
$res = mysqli_query($conn, $sql);
//count the rows to check whether the id is valid or not
$count = mysqli_num_rows($res);
if($count==1)
{
  //Get all the data
  $row = mysqli_fetch_assoc($res);
  $title = $row['title'];
  $description = $row['description'];
  $price= $row['price'];
  $current_image = $row['image_name'];
  $featured = $row['featured'];
  $active=$row['active'];
}
else {
  //redirect to manage category with session message
  $_SESSION['no-food-found']= "<div class='error'>food not found.</div>";
  //Redirect to manage category
  header('location:'.SITEURL.'admin/manage-food.php');
}


}
else {
  $_SESSION['update']= "<div class='error'>Failed to update food.</div>";
  //Redirect to manage category
  header('location:'.SITEURL.'admin/manage-food.php');
}

 ?>

<form class="" action="" method="post" enctype="multipart/form-data">

<table class="tbl-30">
    <tr>
      <td>Title:</td>
      <td>
<input type="text" name="title" value="<?php echo $title; ?>">
      </td>
    </tr>
    <tr>
      <td>Description</td>
      <td>
      <textarea name="description" rows="5" cols="30" placeholder="<?php echo $description; ?>"></textarea>
      </td>
    </tr>
    <tr>
      <td>Price</td>
      <td>
        <input type="number" name="price" value="<?php echo $price; ?>">
      </td>
    </tr>
    <tr>
      <td>Current Image:</td>
      <td>
        <?php
        if($current_image !="")
        {
          //display the image
          ?>
          <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image;  ?>" width="100px" >
          <?php
        }
        else{
          //display message
          echo "<div class='error' >Image not added</div>";
        }
         ?>
      </td>
    </tr>
    <tr>
      <td>new Image:</td>
      <td>
        <input type="file" name="image">
      </td>
    </tr>
    <tr>
      <td>Featured:</td>
      <td>
        <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes"> Yes
        <input <?php if($featured=="no"){echo "checked";} ?> type="radio" name="featured" value="no">No
      </td>
    </tr>
    <tr>
      <td>Active:</td>
      <td>
        <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes"> Yes
        <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no">No
      </td>
    </tr>
    <tr>
      <td>
        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" name="submit" value="update-food" class = "btn-secondary">
      </td>
    </tr>
</table>

</form>
<?php
if(isset($_POST['submit']))
{
//1.get the values
$id=$_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$current_image=$_POST['current_image'];
$featured=$_POST['featured'];
$active=$_POST['active'];
//2.updating new image if selected
//check whether the image is selected or not
if(isset($_FILES['image']['name']))
{
  //Get the image details
  $image_name= $_FILES['image']['name'];
  //check whether the image is available or not
  if($image_name != "")
  {
    //image available
    //upload the new image
    //Auto rename the image
    //Get the extension of our image
    $ext=end(explode('.', $image_name));

    //Rename the image
    $image_name = "food_Category_".rand(000, 999). '.'.$ext;
    $source_path = $_FILES['image']['tmp_name'];

    $destination_path = "../images/food/".$image_name;
    //finally upload the image
    $upload = move_uploaded_file($source_path,$destination_path);
    //check whether the image is uploaded or not
    //If not uploaded then stop the process and redirect with error message
    if($upload==false)
    {
      //Set message
      $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
      //Redirect to add category page
      header('location:'.SITEURL.'admin/manage-food.php');
      //stop the process
      die();
    }
    //Remove the current image if available
    if($current_image !="")
    {
    $remove_path = "../images/food/".$current_image;
    $remove = unlink($remove_path);
    //check whether the image is removed or not
    //if failed then display message and stop the process
    if($remove==false)
    {
      $_SESSION['failed-remove']="<div class='error'>Failed to remove current image.</div>";
      //Redirect to add category page
      header('location:'.SITEURL.'admin/manage-food.php');
      die();
      }
    }
  }
  else {
      $image_name=$current_image;
  }
}
else {
  $image_name=$current_image;
}
//3.update the database
$sql2 = "UPDATE tbl_food SET
    title= '$title',
    description = '$description',
    price = '$price',
    image_name= '$image_name',
    featured='$featured',
    active='$active'
    WHERE id = $id
";
//Execute the query
$res2 = mysqli_query($conn, $sql2);
//4. Redirect to manage category with message
//check whether executed or not
if($res2==true)
{
  //category updated
  $_SESSION['update-food']= "<div class = 'success'>Food update successfully.</div>";
  header('location:'.SITEURL.'admin/manage-food.php');
}else {
  //failed to update category
  $_SESSION['update-food']= "<div class = 'error'>Failed to update food.</div>";
  header('location:'.SITEURL.'admin/manage-food.php');
}

}

 ?>

  </div>

</div>




<?php include('partials/footer.php') ?>
