<?php
session_start();
include "../include/config.php";

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
					
			<!-- start: Content -->
			<div id="content" class="span10">
			<img src="../img/Work_In_Progress.png" class="display">
			</br>
			<p><a href="main.php">Ke Halaman Utama</a></p>
			
			
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
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