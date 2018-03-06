<?php
session_start();
include "../include/config.php";
$kodeperusahaan = $_SESSION['kodeperusahaan'];
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
			<div class="row-fluid">	
				<div class="box span12">
					<div class="box-header" "data-original-title">
					<h2><i class="halflings-icon user"></i><span class="break"></span>Tes Dynamic Dropdown+Checkbox</h2>

						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
			
					<form class="form-horizontal"  method=GET action="">
					<fieldset>
						<div class="control-group">
							<label class="control-label">Grup</label>
							<input class="input-xlarge uneditable-input" type="hidden" name="kodeperusahaan" value=" <?php echo $kodeperusahaan; ?>" />
							<input class="input-xlarge uneditable-input" type="hidden" name="grupmitra" value=" <?php echo $grupmitra; ?>" />
							
							<div class="controls">
							<select name="grupuser" onChange='this.form.submit()'>
							<option >Grup User</option>
							<?php  
								$mysql_grupuser = "select grupuser, deskripsi from m_gr_user where grupmitra = '$grupmitra' order by grupuser";
								$show_grupuser 	= mysqli_query($con,$mysql_grupuser)or die(mysqli_error($con));
								$jml_data = mysqli_num_rows($show_grupuser);
								
								for ($i=1;$i<=$jml_data;$i++) {
									while($data_grupuser = mysqli_fetch_assoc($show_grupuser)){
										$grup=$data_grupuser["grupuser"];
										$deskripsi=$data_grupuser["deskripsi"];
										if ($_GET['grupuser'] == $i) {
											echo "<option value=".$grup." selected>".$grup." | ".$deskripsi."</option>";
											}  else {
												echo "<option value=".$grup.">".$grup." | ".$deskripsi."</option>";
												}

									//echo "<option>". $grup." | ".$deskripsi ."</option>";
									
									}
								}
							?>
							</select>
							</div>
						</div>

					<?php
						if (isset($_GET['grupuser']))
						{
							//echo "Jumlah data : ".$jml_data."</br>";
							echo "<div class='control-group'>";
							echo "<label class='control-label'>Akses untuk Grup</label>"  ;
							echo "<div class='controls'>";
							echo "<input class='input-xlarge uneditable-input' name='grupuser' value=". $_GET['grupuser'] ." />";
							echo "</div>";
							echo "</div>";
							$grupuser = $_GET['grupuser'];
							
							//select from m_menu
							//if 'grupuser' already exist -> display q_akses -> checkbox = check
						 
							$mysql_grupmenu = "select distinct menuid, submenu1id, menu, submenu1 from m_menu order by menuid";
							$show_grupmenu 	= mysqli_query($con,$mysql_grupmenu)or die(mysqli_error($con));
							$jml_data = mysqli_num_rows($show_grupmenu);
							
							$mysql_aksesmenu = "select * from q_akses where grupmitra = '$grupmitra' and grupuser =  '$grupuser' ";
							$show_aksesmenu = mysqli_query($con,$mysql_aksesmenu)or die(mysqli_error($con));
							$jml_akses = mysqli_num_rows($show_aksesmenu);
							
							//for ($i=1; $i <= $jml_data; $i++) {
								while ($data_menu = mysqli_fetch_assoc($show_grupmenu)){
									$menu = $data_menu['menuid'].$data_menu['submenu1id'];
									$data_aksesmenu = mysqli_fetch_assoc($show_aksesmenu);
								?>
								<div class="control-group">
									<input class="input-xlarge uneditable-input" type="hidden" name="menuid" value="<?php echo $data_menu['menuid']; ?>" />
									
									<label class="control-label"><?php echo $data_menu['menu'];?></label>
									<div class="controls">
										<label class="checkbox inline">
											<?php
												if ($data_aksesmenu['menuid'].$data_aksesmenu['submenu1id'] == $menu){
													
													echo "<input type='checkbox' id='inlineCheckbox1' name='submenu1id[]' value=".$data_menu['menuid'].$data_menu['submenu1id']." checked>"; 
													echo $data_menu['submenu1'];
											
													} else {
														echo "<input type='checkbox' id='inlineCheckbox1' name='submenu1id[]' value=".$data_menu['menuid'].$data_menu['submenu1id'].">" ;
														echo $data_menu['submenu1'];
												}
											?>
										</label>
						
									</div>
								</div>
							<?php							
								}
							//} 							
						}
					?>
						</fieldset>
					</form>
			<!-- end: Content -->
			</div>
			</div>
			</div>
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