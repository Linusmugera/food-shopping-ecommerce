<?php include('partials/menu.php');?>
<div class="main-content">
  <div class="wrapper">
    <h1>Add food</h1>

    <br>
    <?php
    if(isset($_SESSION['upload']))
    {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

     ?>
    <form class="" action="" method="post" enctype="multipart/form-data">
      <table class="tbl-30">

        <tr>
          <td>Title:</td>
          <td>
<input type="text" name="title" placeholder="Title for the food">
          </td>
        </tr>
        <tr>
          <td>Description:</td>
          <td>
            <textarea name="description" rows="5" cols="30" placeholder="Description of the food"></textarea>
          </td>
        </tr>
        <tr>
          <td>Price:</td>
          <td>
            <input type="number" name="price">
          </td>
        </tr>
        <tr>
          <td>Select Image:</td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>
        <tr>
          <td>Category:</td>
          <td>
            <select name="category">
              <?php
              //create php code to display categories from database
              //1.create sqp to get all categories from db
              $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
              //Executing the query
              $res = mysqli_query($conn, $sql);
              // count the rows to check whether we have categories or not
              $count = mysqli_num_rows($res);
              if($count>0)
              {
                //we have categories
                while($row=mysqli_fetch_assoc($res))
                {
                  //get the details of the categories
                  $id = $row['id'];
                  $title = $row['title'];
                  ?>
                  <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                  <?php
                }
              }
              else {
                //No category
              ?>
              <option value="0">No category found</option>
              <?php
              }

              //2.display on dropdown

               ?>

            </select>
          </td>
        </tr>
        <tr>
          <td>Featured:</td>
          <td>
            <input type="radio" name="featured" value="yes"> Yes
            <input type="radio" name="featured" value="no"> No
          </td>
        </tr>
        <tr>
          <td>Active:</td>
          <td>
            <input type="radio" name="active" value="yes"> Yes
            <input type="radio" name="active" value="no"> No
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
          </td>
        </tr>
      </table>

    </form>
<?php
//check whether the form is clicked or not
if(isset($_POST['submit']))
{
  //1.Get data from the form
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  //check whether the radio button for featured are clicked or not
  if(isset($_POST['featured']))
  {
    $featured = $_POST['featured'];
  }
  else{
    $featured = "No";
  }
  if(isset($_POST['active']))
  {
    $active = $_POST['active'];
  }
  else{
    $active = "No";
  }
  //2. upload image
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

    $destination_path = "../images/food/".$image_name;
    //finally upload the image
    $upload = move_uploaded_file($source_path,$destination_path);
    //check whether the image is uploaded or not
    //If not uploaded then stop the process and redirect with error message
      if($upload==false)
      {
        //failed to upload the image
        //Redirect to add food page with error message
        $_SESSION['upload'] = "<div class= 'error'>Failed to upload the image.</div>";
        header('location:'.SITEURL.'admin/add-food.php');
        //stop the process
        die();
      }
    }
  }
  else {
    $image_name ="";
  }
  //3.Insert data into database
  $sql2 = "INSERT INTO tbl_food SET
          title = '$title',
          description ='$description',
          price= $price,
          image_name = '$image_name',
          category_id = $category,
          featured = '$featured',
          active = '$active'
   ";
   //Execute query
   $res2 = mysqli_query($conn, $sql2);
   //check whether data is inserted or not
   if($res2 == true )
   {
     $_SESSION['add'] = "<div class = 'success'> Food added successfully.</div>";
     header('location:'.SITEURL.'admin/manage-food.php');
   }

}
 ?>
  </div>

</div>



<?php include('partials/footer.php'); ?>
