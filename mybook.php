<?php include('includes/myheader.php'); 
session_start();
    if(empty($_SESSION['clogin'])){
    header('location:index.php');
}
 if(isset($_REQUEST['pid']))
	{
        $status="Not Confirm";
     $id=intval($_GET['pid']);
        $sql = "SELECT * from roombook where id=:id and stat=:status";
     $query = $dbh->prepare($sql);
     $query-> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> execute();
     if($query->rowCount() > 0)
    {
           echo "<script>alert('Your Application is still pending.')</script>";
     }
 }
 if(isset($_REQUEST['cid']))
	{
    
         
        $id=intval($_GET['cid']);
        $status="Cancelled";
        $sql = "UPDATE roombook SET stat=:status WHERE  id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query-> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
         echo "<script>alert('Booking Successfully Cancelled!')</script>";
       
     }
?>
    <!-- breadcrumb -->
	<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">	
			<ul>
				<li><a href="index.php">Home</a> <i> /</i></li>
				<li>My Booking Details</li>
			</ul>
		</div>
	</div>
<!-- //breadcrumb -->

<div class="container" style="margin-top:3em; margin-bottom:3em">
	<div class="row">
		<div class="table-responsive table-bordered">
            <table class="table movie-table table-hover table-striped ">
                  <thead class="thead">
                  <tr class= "movie-table-head ">
                      <th>Booking Id</th>  
                      <th>Name</th>  
                      <th>Room Type</th>  
                      <th>Bed</th>  
                      <th>No. Room</th>  
                      <th>Meal</th>
                      <th>Check In</th>
                      <th>Check Out</th>
                      <th>Status</th>
                      <th>Reg Date</th>
                      <th class="text-center">Cancel</th>
                      <th class="text-center">Pay</th>
                  </tr>
              </thead>   
              <tbody>
                  
<?php $sql = "SELECT * from roombook where Email=:email";
                            $query = $dbh -> prepare($sql);
                            $query -> bindParam(':email',$_SESSION['clogin'], PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {
                               
                  ?>		
                <tr class= "dark-row">
                    <td><?php echo htmlentities($result->id);?></td>
                    <td><?php echo htmlentities($result->FName);?> <?php echo htmlentities($result->LName);?></td>
    
                    <td><?php echo htmlentities($result->TRoom);?></td>
                    <td><?php echo htmlentities($result->Bed);?></td>
                    <td><?php echo htmlentities($result->NRoom);?></td>
                    <td><?php echo htmlentities($result->Meal);?></td>
                    <td><?php echo htmlentities($result->cin);?></td>
                    <td><?php echo htmlentities($result->cout);?></td>
                    <td><b><?php
                            if(strcmp($result->stat,"Cancelled")==0)
                            {
                                echo "Cancelled";
                            }elseif(strcmp($result->stat,"Not Confirm")==0){
                                echo "Not Confirm";
                            }else{
                                echo "Confirm";
                            }
                            
                           ?></b></td>  
                    <td><?php echo htmlentities($result->RegDate);?></td>
                    <?php
                            if(strcmp($result->stat,"Cancelled")==0)
                            {?>
                    <td class="text-center">Cancelled </td> <?php }else { ?>
                    <td class="text-center"><a class='btn btn-success btn-sm' href="mybook.php?cid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel this ')"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a> </td><?php } ?>
                    <?php
                            if(strcmp($result->stat,"Cancelled")==0)
                            {?>
                    <td class="text-center">Cancelled </td><?php }elseif(strcmp($result->stat,"Not Confirm")==0)
                            {?>
                     <td class="text-center"><a class='btn btn-primary btn-sm' href="mybook.php?pid=<?php echo htmlentities($result->id);?>" ><span class="glyphicon glyphicon-credit-card"></span> Pay</a> </td>
                    <?php }else { 
                    $sql = "SELECT * from tbltransaction where bookid='$result->id'";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                                echo "<td>Paid</td>";
                            }else{
                    ?>
                    <td class="text-center"><a class='btn btn-primary btn-sm' href="payadvance.php?bid=<?php echo htmlentities($result->id);?>" ><span class="glyphicon glyphicon-credit-card"></span> Pay</a> </td>
                    
                     <?php } } ?>
                </tr>

                
						 <?php } }?>
  
              </tbody>
            </table>
            </div>
	</div>
</div>

<?php include('includes/footer.php'); ?>