<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //Getting foods from database that are active and featured
            //Sql query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' ";
            //Execute query
            $res2= mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);
            //check whether the food is availble or not
            if($count2>0)
            {
              //food available
              while($row=mysqli_fetch_assoc($res2))
              {
                //Get all the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                      <?php
                      //check whether image is available or not
                      if($image_name=="")
                      {
                        //image not available
                        echo "<div class = 'error'> Image not available</div>";

                      }
                      else {
                        //image available
                        ?>
                          <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                      }

                       ?>


                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                          <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="order.php" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php

              }

            }
            else {
              //food not available
              echo "<div class= 'error'>Food not available.</div>";
            }

             ?>







            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php include('partials-front/footer.php'); ?>
