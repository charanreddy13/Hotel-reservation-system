<?php include('includes/myheader.php'); 
session_start();
    if(empty($_SESSION['clogin'])){
    header('location:index.php');
}
        $msg="";
      $email=$_SESSION['clogin'];
   
        if(isset($_POST['submit']))
        {
            $password=md5($_POST['cpass']);
            $newpassword=md5($_POST['npass']);
            $username=$_SESSION['clogin'];
                $sql ="SELECT Password FROM tblusers WHERE EmailId=:username and Password=:password";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':username', $username, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);
            if($query -> rowCount() > 0)
            {
            $con="update tblusers set Password=:newpassword where EmailId=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
                 $msg="Your Password succesfully changed";
            }
            else {
                 $msg="Your current password is wrong";
            }
}
?>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.npass.value!= document.chngpwd.cnpass.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.cnpass.focus();
return false;
}
return true;
}
</script>    
<!-- breadcrumb -->
	<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">	
			<ul>
				<li><a href="index.php">Home</a> <i> /</i></li>
				<li>Settings</li>
			</ul>
		</div>
	</div>
<!-- //breadcrumb -->

            <div class="container" style="padding:2em">
                
         <div class="row">
     <h3>Change Password</h3><br>
<div class="col-lg">
      <?php if ($msg != ""){ ?><div class="alert alert-warning alert-dismissible "><button type="button" class="close" data-dismiss="alert">&times;</button> <?php echo $msg ?></div><?php } ?>
<form class="form-horizontal" method="post" name="chngpwd" onSubmit="return valid();">
<fieldset>
	
<div class="form-group">
  <label class="col-md-4 control-label" for="Name (Full name)">Current Passsword</label>  
  <div class="col-md-4">
 <div class="input-group">
       <input id="pwd" name="cpass" type="password" placeholder="Current Passsword" class="form-control"  required value="">
      </div>

    
  </div>

  
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Employee Id">New Password</label>  
  <div class="col-md-4">

  <div class="input-group">
       <input id="npass" name="npass" type="password" placeholder="New Password" class="form-control input-md" required value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
      </div>
  
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Email Address">Confirm Password</label>  
  <div class="col-md-4">
  <div class="input-group">
    <input id="cnpass" name="cnpass" type="password" placeholder="Confirm Password" class="form-control input-md" required value="">
    
      </div>
  
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" ></label>  
  <div class="col-md-4">
  <button class="btn btn-success" name="submit" type="submit"><span class="glyphicon glyphicon-thumbs-up"></span> Submit</button>
  <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove-sign"></span> Clear</button>
    
  </div>
</div>

</fieldset>
</form>
</div> 
    
</div>
            </div>

<?php include('includes/footer.php'); ?>