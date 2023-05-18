<?php include('partials-front/header.php')?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
        <div class="container">
        <?php
        if(isset($_GET['id'])){
            $id1=$_GET['id'];
        $sql1 = "SELECT title FROM tbl_category WHERE id= $id1";
        $query1 = mysqli_query($conn, $sql1);
        $count1 = mysqli_num_rows($query1);
        if($count1>0){
        while($rows = mysqli_fetch_assoc($query1)){
            $title = $rows['title'];
        }
    }
}
            ?>
            <h2>Foods on Your Category <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sql = "SELECT * FROM tbl_food WHERE category_id=$id";

                $query = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($query);

                if($count>0){

                   while($rows = mysqli_fetch_assoc($query)){
                       $id= $rows['id'];
                       $title=$rows['title'];
                       $category_id=$rows['category_id'];
                       $price =$rows['price'];
                       $description = $rows['description'];
                       $image = $rows['image_name'];
                       ?>
                       <div class="food-menu-box">
                       <div class="food-menu-img">
                           <?php
                           if($image != ""){
                               ?>
                            <img src="<?php echo SITE_URL;?>images/food/<?php echo $image ?>"  class="img-responsive img-curve" height="150px">
                            <?php
                           }
                           else{
                               echo "No image avialable";
                           }
                           ?>
                
                   
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                       <?php echo $description ?>
                    </p>
                    <br>

                    <a href="<?php echo SITE_URL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                       <?php
                   }
                }
            }
            else{
                header('location:'.SITE_URL.'index.php');
            }
            

            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>