<?php include('partials/menu.php'); ?>
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Food</h1>
    <!-- button to add category -->
    <a class="btn-primary" href="<?php echo SITEURL; ?>admin/add-food.php" > Add food</a>
    <br/><br/>

    <?php
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if(isset($_SESSION['delete']))
    {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    if(isset($_SESSION['remove']))
    {
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
    }
    if(isset($_SESSION['no-food-found']))
    {
      echo $_SESSION['no-food-found'];
      unset($_SESSION['no-food-found']);
    }
    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if(isset($_SESSION['upload']))
    {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    if(isset($_SESSION['failed-remove']))
    {
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
    }
    if(isset($_SESSION['update-food']))
    {
      echo $_SESSION['update-food'];
      unset($_SESSION['update-food']);
    }







     ?>
     <table class="fulltable">
     <tr>
       <th>S.N</th>
       <th>Title</th>
       <th>Price</th>
       <th>Image</th>
       <th>Featured</th>
       <th>Active</th>
       <th>Actions</th>
     </tr>
     <?php
     //create sql query to get all the food
     $sql = "SELECT * FROM tbl_food";
     $res = mysqli_query($conn, $sql);
     $count = mysqli_num_rows($res);
     //create serial no. variable and set default value as 1
     $sn=1;
     if ($count>0)
     {
       while($row=mysqli_fetch_assoc($res))
       {
         //get the values from individual customers
         $id = $row['id'];
         $title = $row['title'];
         $price = $row['price'];
         $image_name = $row['image_name'];
         $featured = $row['featured'];
         $active = $row['active'];
         ?>
         <tr>
           <td><?php echo $sn++; ?></td>
           <td><?php echo $title; ?></td>
           <td>$<?php echo $price; ?></td>
           <td><?php
           //check whether we haave image name or not
           if($image_name!="")
           {
             //display the message
           ?>
           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" width=100px">
           <?php
           }
           else
           {
             //display the message
             echo "<div class='error'>Image not added</div>";
           }
            ?></td>
           <td><?php echo $featured; ?></td>
           <td><?php echo $active; ?></td>
           <td><a class="btn-secondary"href="<?php echo SITEURL;  ?>admin/update-food.php?id=<?php echo $id; ?>">Update food</a>
               <a class="btn-danger"href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>& image_name=<?php echo $image_name; ?>">Delete food</a>
           </td>
         </tr>
         <?php

       }
     }
     else {
       echo "<tr> <td colspan='7' class = 'error'> Food not added yet.</td> </tr>";
     }
      ?>


   </table>
  </div>

</div>

<?php include('partials/footer.php'); ?>
