<?php include('partials-front/header.php')?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
             <?php

            $sql = "SELECT * FROM tbl_category WHERE  active='Yes'";
            $query = mysqli_query($conn, $sql);
           $count = mysqli_num_rows($query);
           if($count>0){
               while($rows = mysqli_fetch_assoc($query)){
                   $id = $rows['id'];
                   $img = $rows['image_name'];
                   $title = $rows['title'];
                   ?>
                   <a href="<?php echo SITE_URL?>category-foods.php?id=<?php echo $id?>">
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


    <?php include('partials-front/footer.php')?>