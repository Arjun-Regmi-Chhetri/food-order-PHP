<?php include('partials/header.php')?>

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

<section class="main">
<div class="container">
        <div class="wrapper d-flex justify-content-between mb-4">
			<h2>Food Page</h2>
			<a href="<?php echo SITE_URL?>Admin/add_food.php" class="p-2 text-white bg-primary fs-5 add_admin" style="border-radius: 10px; text-decoration: none;">Add Food</a>
		</div>
    <table class="table table-striped">
			 <thead>
				    <tr>
				      <th scope="col">S.N</th>
				      <th scope="col">Title</th>
					  <th scope="col">Price</th>
				      <th scope="col">Image</th>
					  <th scope="col">Category_id</th>
				      <th scope="col">Featured</th>
				      <th scope="col">Active</th>
				      <th scope="col">Action</th>
				    </tr>
			  </thead>
			  <tbody>
				  <?php
				    $sql = "SELECT * FROM tbl_food";
					$query = mysqli_query($conn, $sql);

					$count = mysqli_num_rows($query);

					$sn=1;
					if($count>0){

						while($rows = mysqli_fetch_assoc($query)){
							$id=$rows['id'];
						$title=$rows['title'];
						$price = $rows['price'];
						$image = $rows['image_name'];
						$category_id = $rows['category_id'];
						$featured = $rows['featured'];
						$active = $rows['active'];
						?>
						<tr>
						<th scope="row"><?php echo $sn++ ;?></th>
					 <td><?php echo $title;?></td>
					 <td><span>$</span><?php echo $price;?></td>
					 <td>
						<?php
						if($image != ""){
						?>
						 <img src="<?php echo SITE_URL;?>images/food/<?php echo $image ?>" alt="" width="100px" height="100px">
						 <?php
						 } else{
							 echo "Image not uploaded";
						 }
						 ?>
						 
					</td>
					 <td><?php echo $category_id ;?></td>
					 <td><?php echo $featured ;?></td>
					 <td><?php echo $active ;?></td>
					 <td>
						      	<a href="<?php echo SITE_URL?>Admin/update_food.php?id=<?php echo $id; ?>" class="btn btn-primary">Update</a>
						      	<a href="<?php echo SITE_URL?>Admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="btn btn-danger">Delete</a>
						      </td>
							  
					 </tr>
                       <?php

						}

						
					}
					else{
						echo"No Food has been Added";
					}
				  ?>
				   
            </tbody>
   </table>
</div>
</section>

<?php include('partials/footer.php')?>
