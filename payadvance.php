<?php 
error_reporting(0);
session_start();
include('includes/config.php');
if(empty($_GET['bid'])){
    header('location:index.php');
}
//Checking amount to pay
$bid=intval($_GET['bid']);
 $sql = "SELECT * from bookedroom where bookid='$bid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
    $amount = $result->fintot;
}
}

 if(isset($_POST['submit']))
{
    
    $chname=$_POST['chname'];
    $cno=$_POST['cno'];
    $pamt=$_POST['pamt'];
    $sql="INSERT INTO tbltransaction (bookid,CHName,CardNumber,Amount) VALUES (:cid,:chname,:cno,:pamt)";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':cid', $bid, PDO::PARAM_STR);
    $query-> bindParam(':chname', $chname, PDO::PARAM_STR);
    $query-> bindParam(':cno', $cno, PDO::PARAM_STR);
    $query-> bindParam(':pamt', $pamt, PDO::PARAM_STR);
    $query-> execute();
    $lastInsertId = $dbh->lastInsertId();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
          echo "<script>alert('Paid Successfully, Thank you for paying, we are waiting to serve you!')</script>";
           echo "<script type='text/javascript'> window.location='admin/print.php?pid=".$bid."'</script>";
     }
 }
   include('includes/myheader.php');
?>
    <!-- breadcrumb -->
	<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">	
			<ul>
				<li><a href="index.php">Home</a> <i> /</i></li>
				<li>Pay</li>
			</ul>
		</div>
	</div>
<!-- //breadcrumb -->

            <div class="container" style="padding:2em">
                
	<div class="row">
		 <div class="col-md-9">
                    <span class="anchor" id="formUserEdit"></span>
                   <!-- form user info -->
                    <div class="card card-outline-secondary">
                       
                        <div class="card-body"><form method="post">
                            <h3 class="text-center">Credit Card Payment</h3>
                            <hr>
                            
                                <div class="form-group">
                                    <label for="cc_name">Card Holder's Name</label>
                                    <input type="text" class="form-control" id="cc_name" pattern="\w+ \w+.*" title="First and last name" required="required" name="chname">
                                </div>
                                <div class="form-group">
                                    <label>Card Number</label>
                                    <input type="text" class="form-control" autocomplete="off" maxlength="16" pattern="\d{16}" title="Credit card number" required="" name="cno">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12">Card Exp. Date</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="cc_exp_mo" size="0">
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="cc_exp_yr" size="0">
                                            <option>2019</option>
                                            <option>2020</option>
                                            <option>2021</option>
                                            <option>2022</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" placeholder="CVC">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-12">Amount</label>
                                </div>
                                <div class="form-inline">
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="font-size:1.5em"><span class="input-group-text">$ <label class="inline"><?php echo $amount ?></label></span></div>
                                        
                                        <input type="hidden" class="form-control text-right"  value="<?php echo $amount ?>" name="pamt" >
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default btn-lg btn-block">Reset</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->

                </div>
	</div>
            </div>

<?php include('includes/footer.php'); ?>