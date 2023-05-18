<?php include('partials/header.php') ?>


<?php 
if(isset($_SESSION['message'])){
	?>
	<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
     <?php echo $_SESSION['message'];?>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

	<?php
	unset($_SESSION['message']);
}
?>
<?php 
if(isset($_SESSION['error'])){
	?>
	<div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
     <?php echo $_SESSION['error'];?>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

	<?php
	unset($_SESSION['error']);
}
?>

<div class="container p-3">
	<!-- setting message -->

		<div class="wrapper d-flex justify-content-between">
			<h2>Category Page</h2>
			<a href="add_category.php" class="p-2 text-white bg-primary fs-5 add_admin" style="border-radius: 10px; text-decoration: none;">Add Category</a>
		</div>

		<table class="table table-striped">
			 <thead>
				    <tr>
				      <th scope="col">S.N</th>
				      <th scope="col">Title</th>
				      <th scope="col">Image</th>
				      <th scope="col">Featured</th>
				      <th scope="col">Active</th>
				      <th scope="col">Action</th>
				    </tr>
			  </thead>
			  <tbody>
			  	<?php 

			  	//create sql query to check wether the data are avilable or not
			  	$sql ="SELECT * FROM tbl_category";

			  	//execute query
			  	$query = mysqli_query($conn, $sql) or die(mysqli_error());

			  	//check wether the query exist or not
			  	if($query==true){
			  		//query exists

			  		//count the rows of the tbl_admin
			  		$count = mysqli_num_rows($query);
			  		$sn=1;
			  		//check wether the count has value or not
			  		if($count>0){
			  			while($rows = mysqli_fetch_assoc($query)){

			  				//get the data from database
			  				$id = $rows['id'];
			  				$title = $rows['title'];
			  				$image_name = $rows['image_name'];
			  				$featured = $rows['featured'];
			  				$active = $rows['active'];
			  				?>
								<tr>
						      <th scope="row"><?php echo $sn++ ;?></th>
						      <td><?php echo $title ;?></td>

						      <td>
						      	<?php 
						      	if($image_name!=""){
						      		?>
						      		<div class="image_category">
						      			<img src="<?php echo SITE_URL;?>images/category/<?php echo $image_name?>">
						      		</div>	
						      		<?php
						      	}
						      	else{
						      		echo "Image not uploaded";
						      	}
						      	
						      	?>
						      		
						      </td>

						      <td><?php echo $featured;?></td>
						      <td><?php echo $active; ?></td>
						      <td>
						      	<a href="<?php echo SITE_URL?>Admin/update_category.php?id=<?php echo $id; ?>" class="btn btn-primary">Update</a>
						      	<a href="<?php echo SITE_URL?>Admin/delete_category.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?>" class="btn btn-danger">Delete</a>
						      </td>
				    	  </tr>
			  				<?php
			  			}
			  		}
			  	}
			  	else{
			  		//no user are added yet
			  	}
			  	?>
				    
              </tbody>
        </table>

	</div>
</div>

<?php include('partials/footer.php') ?>