<?php include('partials/header.php')?>

<section class="main_order py-3">
<div class="container">
    <div class="row">
        <h3>Order</h3>
    </div>
    <table class="table table-striped my-3">
         <thead>
				    <tr>
				      <th scope="col">S.N</th>
				      <th scope="col">Food</th>
					  <th scope="col">Price</th>
				      <th scope="col">Qty</th>
					  <th scope="col">Total</th>
				      <th scope="col">Status</th>
				      <th scope="col">Ordered Date</th>
				      <th scope="col">Customer Name</th>
                      <th scope="col">Customer Email</th>
                      <th scope="col">Customer Address</th>
                      <th scope="col">Customer Contact</th>
				    </tr>
			  </thead>
			<tbody>
				
				<?php
				$sql = "SELECT * FROM tbl_order ORDER BY id DESC";
				$query= mysqli_query($conn,$sql);
				$count=mysqli_num_rows($query);
				$sn=1;
				if($count>0){
					while($rows=mysqli_fetch_assoc($query)){
						$food = $rows['food'];
						$price=$rows['price'];
						$qty=$rows['qty'];
						$total=$rows['total'];
						$status=$rows['status'];
						$order_date=$rows['order_date'];
						$name=$rows['customer_name'];
						$email=$rows['customer_email'];
						$address=$rows['customer_address'];
						$contact=$rows['customer_contact'];
						?>
						<tr>
						<td><?php echo $sn++;?></td>
						<td><?php echo $food;?></td>
						<td>$<?php echo $price;?></td>
						<td><?php echo $qty;?></td>
						<td>$<?php echo $total;?></td>
						<td><?php echo $status;?></td>
						<td><?php echo $order_date?></td>
						<td><?php echo $name;?></td>
						<td><?php echo $email;?></td>
						<td><?php echo $address;?></td>
						<td><?php echo $contact;?></td>
						</tr>
						<?php
					}
					}
					else{
						echo"No order has been done yet";
					}
				
				?>
				
           </tbody> 
             
     </table>
</div>
</section>

<?php include('partials/footer.php')?>
