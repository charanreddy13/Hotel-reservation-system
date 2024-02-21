<?php include('includes/myheader.php'); 
session_start();
    if(empty($_SESSION['clogin'])){
    header('location:index.php');
}
        $msg="";
      $email=$_SESSION['clogin'];
    if(isset($_POST['submit']))
    {
    $fname=$_POST['fname'];
    $phno=$_POST['phno'];
    $sql="update tblusers set FName=:fname,MobileNumber=:phno where EmailId=:email";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':fname', $fname, PDO::PARAM_STR);
    $query-> bindParam(':phno', $phno, PDO::PARAM_STR);
    $query->execute();
    $msg="Details Updated Successfully";
}
?>
    <!-- breadcrumb -->
	<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">	
			<ul>
				<li><a href="index.php">Home</a> <i> /</i></li>
				<li>Profile</li>
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
                        <div class="card-header">
                            <h3>User Information</h3><br>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" method="post">
                                <?php if ($msg != ""){ ?><div class="alert alert-warning alert-dismissible "><button type="button" class="close" data-dismiss="alert">&times;</button> <?php echo $msg ?></div><?php } ?>

<?php       
                                $email=$_SESSION['clogin']; 
                                $sql = "SELECT * from tblusers where EmailId=:email";
                                $query = $dbh -> prepare($sql);
                            $query-> bindParam(':email', $email, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {				?>	
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Full Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo htmlentities($result->FName);?>" name="fname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="email" value="<?php echo htmlentities($result->EmailId);?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Mobile</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="<?php echo htmlentities($result->MobileNumber);?>" name="phno" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" maxlength="10" minlength="10">
                                    </div>
                                </div>  <?php  }} ?>             
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
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