<?php include('partials/header.php')?>
<?php
//check wether the message is display or not
if(isset($_SESSION['message'])){
  ?>
  <div class="alert alert-primary alert-dismissible fade show text-white" role="alert">
   <?php echo $_SESSION['message']; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
 
  unset($_SESSION['message']);
}      

?>


<!-- main section -->
<section class="main">
    <div class="container">
        <div class="row justify-content-center">
        <h3>Dashboard</h3>
            <div class="col-2">
                <div class="purple">
                <h2>1</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
                </div>
                
            </div>
            <div class="col-2">
            <div class="purple">
                <h2>2</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            </div>
            
            </div>
             <div class="col-2">
             <div class="purple">
                <h2>3</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
             </div>
             
            </div>
            <div class="col-2">
            <div class="purple"> 
                <h2>4</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            </div>
            </div>
            <div class="col-2">
            <div class="purple">
                <h2>5</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            </div>
             
            </div>
        </div>
    </div>
</section>
<!-- end main section -->

<?php include('partials/footer.php')?>