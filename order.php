<?php include('partials-front/header.php')?>

<?php
        if(isset($_GET['food_id'])){
            $id= $_GET['food_id'];
           $sql = "SELECT * FROM tbl_food WHERE id=$id";
           $query=mysqli_query($conn, $sql);
           $count= mysqli_num_rows($query);
           if($count==1){
               $rows = mysqli_fetch_assoc($query);
               $image=$rows['image_name'];
               $title=$rows['title'];
               $price = $rows['price'];
              ?>
              <?php
           }
       }  
    //    else{
    //        header('location:'.SITE_URL);
    //    }             
 ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="post">
                <fieldset>
                    <legend>Selected Food</legend>
                   
                    <div class="food-menu-img">
                        <?php
                        if($image!=""){
                            ?>
                            <img src="<?php echo SITE_URL;?>images/food/<?php echo $image ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        else{
                            echo "No image";
                        }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>">
                        <p class="food-price">$<?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="fullname" placeholder="Enter your full name" class="input-responsive" >

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter your phone number" class="input-responsive" >

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter your email" class="input-responsive" >

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter your address" class="input-responsive" ></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php')?>

    <?php
    if(isset($_POST['submit'])){
        $qty = $_POST['qty'];
        $food = $_POST['food'];
        $price=$_POST['price'];
        $total = $qty*$price;
        $status="Ordered";
        $order_date=date("Y-m-d h:i:sa");
        $fullname=$_POST['fullname'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $contact=$_POST['contact'];

        $sql2="INSERT INTO tbl_order SET
                food='$food',
                price='$price',
                qty='$qty',
                total='$total',
                order_date='$order_date',
                status='$status',
                customer_name='$fullname',
                customer_address='$address',
                customer_email='$email',
                customer_contact='$contact'
               ";
        $query2=mysqli_query($conn, $sql2) or die(mysqli_error($conn));

        if($query2==true){
            $_SESSION['message']="Order has done successfully";
            echo"<script>window.location.href='index.php'</script>";
        }
        else{
            $_SESSION['error']="Your order is denied";
            header('location:'.SITE_URL);
        }
    }