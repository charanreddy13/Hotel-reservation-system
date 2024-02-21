<?php include('includes/myheader.php'); 
?>
    <!-- breadcrumb -->
	<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">	
			<ul>
				<li><a href="index.php">Home</a> <i> /</i></li>
				<li>Rooms</li>
			</ul>
		</div>
	</div>
<!-- //breadcrumb -->
	<!-- /plans -->
      <div class="plans-section" >
				 <div class="container">
				 <h3 class="w3l-inner-h-title">Rates and Booking</h3>
						<div class="priceing-table-main">
				 <div class="col-md-3 price-grid">
					<div class="price-block agile">
						<div class="price-gd-top pric-clr1">
							<h4>SINGLE ROOM</h4>
							<h3><span>&#8377</span>1000</h3>
						</div>
						<div class="price-gd-bottom">
							   <div class="price-list">
								
				
									 <h6 class="bed"><i class="fa fa-bed" aria-hidden="true"></i></h6>
							</div>
							<div class="price-selet pric-sclr1">		    			  <?php if(!empty($_SESSION['clogin'])){
    ?>
<a href="booking?id=1"  >Book Now</a>
<?php }else{ ?> <a href="login"  >Book Now</a><?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 price-grid ">
					<div class="price-block agile">
						<div class="price-gd-top pric-clr2">
							<h4>Luxury Room</h4>
							<h3><span>&#8377</span>2500</h3>
						</div>
						<div class="price-gd-bottom">
							<div class="price-list">
								
								<h6 class="bed two"><i class="fa fa-bed" aria-hidden="true"></i></h6>
								
							</div>
							<div class="price-selet pric-sclr2">
							<?php if(!empty($_SESSION['clogin'])){
    ?>
<a href="booking?id=2"  >Book Now</a>
<?php }else{ ?> <a href="login"  >Book Now</a><?php } ?>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 price-grid lost">
					<div class="price-block agile">
						<div class="price-gd-top pric-clr3">
							<h4>GUEST HOUSE</h4>
							<h3><span>&#8377</span>1500</h3>
						</div>
						<div class="price-gd-bottom">
							<div class="price-list">
								
								<h6 class="bed three"><i class="fa fa-bed" aria-hidden="true"></i></h6>
							</div>
							<div class="price-selet pric-sclr3">
								<?php if(!empty($_SESSION['clogin'])){
    ?>
<a href="booking?id=3"  >Book Now</a>
<?php }else{ ?> <a href="login"  >Book Now</a><?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 price-grid wthree lost">
					<div class="price-block agile">
						<div class="price-gd-top pric-clr4">
							<h4>Deluxe Room</h4>
							<h3><span>&#8377</span>2000</h3>
							
						</div>
						<div class="price-gd-bottom">
							<div class="price-list">
								
								<h6 class="bed four"><i class="fa fa-bed" aria-hidden="true"></i></h6>
							</div>
							<div class="price-selet pric-sclr4">
								<?php if(!empty($_SESSION['clogin'])){
    ?>
<a href="booking?id=4"  >Book Now</a>
<?php }else{ ?> <a href="login"  >Book Now</a><?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

<?php include('includes/footer.php'); ?>