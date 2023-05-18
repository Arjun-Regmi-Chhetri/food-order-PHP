<?php include('partials-front/header.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
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

            $sql = "SELECT * FROM tbl_food WHERE featured='Yes' ";

            $query = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($query);

            if($count>0){
                while($rows = mysqli_fetch_assoc($query)) {
                    $id =$rows['id'];
                    $title=$rows['title'];
                    $description = $rows['description'];
                    $price =$rows['price'];
                    $image=$rows['image_name'];
                    ?>
                     <div class="food-menu-box">
                    <?php
                    if($image !=""){
                        ?>
                        
                        <div class="food-menu-img">
                           <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image; ?>"  class="img-responsive img-curve" height="150px">
                        </div>
                          
                    <?php
                    }
                    else{
                        echo "No Image uploaded";
                    }
                    ?>
                        

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                    <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITE_URL;?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
                }
            }
            

            ?>

           

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>