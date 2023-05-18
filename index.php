<?php include('partials-front/header.php')?>

<?php


//check wether the message is display or not
if(isset($_SESSION['message'])){
  ?>
  <div class="alert alert-primary alert-dismissible  show text-white" role="alert">
   <?php echo $_SESSION['message']; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
 
  unset($_SESSION['message']);
}      

?>
    <?php


//check wether the message is display or not
if(isset($_SESSION['error'])){
  ?>
  <div class="alert alert-danger alert-dismissible  show text-white" role="alert">
   <?php echo $_SESSION['error']; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
 
  unset($_SESSION['error']);
}      

?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITE_URL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

            $sql = "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 3";
            $query = mysqli_query($conn, $sql);
           $count = mysqli_num_rows($query);
           if($count>0){
               while($rows = mysqli_fetch_assoc($query)){
                   $id = $rows['id'];
                   $img = $rows['image_name'];
                   $title = $rows['title'];
                   ?>
                   <a href="<?php echo SITE_URL;?>category-foods.php?id=<?php echo $id ?>">
            <div class="box-3 float-container">
                <?php
                if($img!=""){
                    ?>
                    <img src="<?php echo SITE_URL;?>images/category/<?php echo $img; ?>"  class="img-responsive img-curve" height="400px">
                    <?php
                }
                else{
                    echo "Image not avilable";
                }
                ?>
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>
            <?php
               }
           }

            ?>
            

            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
         

            <?php

            $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            $query2= mysqli_query($conn, $sql2);

            $count = mysqli_num_rows($query2);

            if($count>0){

                while($rows = mysqli_fetch_assoc($query2)){
                    $id =$rows['id'];
                    $title=$rows['title'];
                    $description = $rows['description'];
                    $price =$rows['price'];
                    $image=$rows['image_name'];
                   ?>
                   <div class="food-menu-box">
                       <?php
                    if($image =="")
                    {
                        echo "No image uploaded";
                    }else{
                        ?>
                        <div class="food-menu-img">
                    <img src="<?php echo SITE_URL?>images/food/<?php echo $image; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" height="150px">
                    </div>
                    <?php
                    } 
                    ?>
                  <div class="food-menu-desc">
                    <h4><?php echo $title ?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                    <?php echo $description ?>
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
      
        <br>
        </div>

        <p class="text-center">
            <a href="<?php echo SITE_URL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>