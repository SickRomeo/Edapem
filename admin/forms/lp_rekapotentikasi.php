<?php
session_start();
include "../include/config.php";
$idmitra = $_SESSION['idmitra'];
$grupmitra=substr($idmitra,0,2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- start: CSS -->
	<link id="bootstrap-style" href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="../css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="../css/style-responsive.css" rel="stylesheet">
<!-- end: CSS -->
	<style>
	.display {
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
	section {
      	position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%) 
		}	
	p {
		text-align: center;
	}	
	</style>
</head>
	
<body>
	<!-- start: Header -->
	<?php include "../include/header.php"; ?>		
	<!-- end: Header -->
	<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php include "../include/sidebar.php"; ?>		
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header data-original-title">
						<h2><i class="halflings-icon user"></i><span class="break"></span>Daftar Otentikasi</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered datatable">
						
						  <thead>
							  <tr>
								  <th>No. Pensiun</th>
								  <th>Tanggal Otentikasi</th>
								  <th>Jam Otentikasi</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <!-- Start Script to Connect to Database -->
							<?php
							 //select the database
							
							$mysql 	 = "select * from q_otentikasi where grupmitra = '$grupmitra'";
							$myquery = mysqli_query($con,$mysql)or die(mysqli_error($con));

							 $jml_data = mysqli_num_rows($myquery);
			
							 $baris = 0 ;
		
							if (mysqli_num_rows($myquery) > 0) 
							{
								while($data = mysqli_fetch_assoc($myquery)) 
								{ $baris++;
			   	 		
							?>
							<!--- End of Script --->
							<input type="hidden" name="id" value=" .'$data['nopensiun']'." /> </td>
							<tr>
								<td><?php echo $data['nopensiun']?></td>
								<td><?php echo $data['crdate']?></td>
								<td><?php echo $data['crtime']?></td>
							<?php
								}
							} else 
							{ echo "0 results";}
							?>
							</tr>
																					
						  </tbody>
					  </table>    
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
				</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<?php include "../include/footer.php"; ?>	

	</footer>
	
		<!-- start: JavaScript-->

		<script src="../js/jquery-1.9.1.min.js"></script>
		<script src="../js/jquery-migrate-1.0.0.min.js"></script>
		<script src="../js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="../js/jquery.ui.touch-punch.js"></script>
		<script src="../js/modernizr.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery.cookie.js"></script>
		<script src='../js/fullcalendar.min.js'></script>
		<script src='../js/jquery.dataTables.min.js'></script>
		<script src="../js/excanvas.js"></script>
		<script src="../js/jquery.flot.js"></script>
		<script src="../js/jquery.flot.pie.js"></script>
		<script src="../js/jquery.flot.stack.js"></script>
		<script src="../js/jquery.flot.resize.min.js"></script>
		<script src="../js/jquery.chosen.min.js"></script>
		<script src="../js/jquery.uniform.min.js"></script>
		<script src="../js/jquery.cleditor.min.js"></script>
		<script src="../js/jquery.noty.js"></script>
		<script src="../js/jquery.elfinder.min.js"></script>
		<script src="../js/jquery.raty.min.js"></script>
		<script src="../js/jquery.iphone.toggle.js"></script>
		<script src="../js/jquery.uploadify-3.1.min.js"></script>
		<script src="../js/jquery.gritter.min.js"></script>
		<script src="../js/jquery.imagesloaded.js"></script>
		<script src="../js/jquery.masonry.min.js"></script>
		<script src="../js/jquery.knob.modified.js"></script>
		<script src="../js/jquery.sparkline.min.js"></script>
		<script src="../js/counter.js"></script>
		<script src="../js/retina.js"></script>
		<script src="../js/custom.js"></script>
	<!-- end: JavaScript-->
</body>
</html>