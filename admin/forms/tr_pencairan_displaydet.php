<?php
session_start();
include "../include/config.php";
//$iduser = $_SESSION['iduser'];
$iduser = $_SESSION['email'];
$kodeperusahaan = $_SESSION['id_prshn'];
//$idmitra = $_SESSION['idmitra'];
//$grupmitra=substr($idmitra,0,2);
$grupmitra=$_SESSION['gr_mitra'];
//$shortmitra=substr($idmitra,2,4);

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
	<script>
		function myFunction() {
			var x,w, result, result2;

			// Get the value of the input field with id="pencairan"
			x = document.getElementById("pencairan").value;
			w = document.getElementById("kode_status").value;
			//y = document.getElementById("nominal").value;
			// If x is Not a Number or less than one or greater than field id="nominal"
			//if (isNaN(x) || x < 1 || x > y) {
			//	result = "0 < Nominal <= Saldo";
			//} else {
				result = x;
				result2 = w;
			//}
			//document.getElementById("demo_cair").innerHTML = result;
			document.getElementById("demo_cair").value = result;
			document.getElementById("demo_status").value = result2;
		}
		function nowFunction() {
			var d = new Date();
			var t = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
			var n = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
			//window.location.href = "http://localhost/edapem_ng/admin/forms/do_downloaddata.php?today=" + t + "&now=" + n;
			document.getElementById("tgl").innerHTML = t+"  "+n;
			document.getElementById("tgl").value = t+"  "+n;
}

</script>
</head>


<body onLoad="nowFunction()">
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
			<!-- Start Script to Connect to Database -->
					<?php
					//membuat variabel $id yg nilainya adalah dari URL GET id -> edit.php?id=userid
						$idpensiun = trim($_GET['id']);
						$saldo = trim($_GET['saldo']);
						//echo $id;
						
						$mysql_pensiun = "select * from q_dapem WHERE nopensiun='$idpensiun' " ;
						$show_pensiun 	= mysqli_query($con,$mysql_pensiun)or die(mysqli_error($con));
	
						/* -- activate below line to display array ---- 
							  echo '</br>';
							  print_r ($con);
							  echo '</br>';
		  					  print_r ($show);
					   -------------------------------------------- */
						
        			?>
			<!--- End of Script --->
			<div class="row-fluid">	
				<div class="box span12">
					<div class="box-header data-original-title">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>
							<?php 
							//cek apakah data dari hasil query ada atau tidak
							if(mysqli_num_rows($show_pensiun) > 0)
							{
								//jika data ditemukan, maka membuat variabel $data
								$data_pensiun = mysqli_fetch_assoc($show_pensiun);	//mengambil data ke database yang nantinya akan ditampilkan di form edit di bawah
								$nama = $data_pensiun['namapenerima'];
								$no_pensiun = $data_pensiun['nopensiun'];
								echo "Detail untuk ".$data_pensiun['namapenerima'];
								
							} else {
								//jika tidak ada data yg sesuai maka akan langsung di arahkan ke halaman depan atau beranda -> index.php
								/*echo '<script>window.history.back()</script>';*/
								echo "detail pensiun tidak ada";
							}
							?>
						</h2>

						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action = "#">
							<fieldset>
							  <div class="control-group">
								<label class="control-label">No.Pensiun</label>
								
								<div class="controls">
								  <span class="input-medium uneditable-input" name="nopensiun"><?php echo $data_pensiun['nopensiun'];?></span>
								  <span class="input-xlarge uneditable-input" name="nama"><?php echo $nama;?></span>
								</div>
								
							  </div>
							  <!--
							  <div class="control-group">
								<label class="control-label">Nama Pensiun</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input" name="nama"><?php //echo $nama;?></span>
								</div>
							  </div>
							  -->
							  
							 <div class="control-group">
								<label class="control-label">No.Rekening</label>
								<div class="controls">
								  <span class="input-medium uneditable-input"><?php echo $data_pensiun['norekening'];?></span>
								
								  <input class="input-xlarge uneditable-input" type="text" id="nominal" 
										 value="Rp. <?php 
											$saldo_terkini = $data_pensiun['nominal'] + $saldo;
											echo $saldo_terkini ;?>" >
								</div>
							</div>	
							
							<div class="control-group">
								<label class="control-label">Otentikasi Terakhir</label>
								<?php  
									$mysql_otentikasi 	= "select accountno, crdate from l_otentikasi where accountno = '$no_pensiun' order by crdate desc limit 1";
									$show_otentikasi 	= mysqli_query($con,$mysql_otentikasi)or die(mysqli_error($con));
									
									$data_otentikasi = mysqli_fetch_assoc($show_otentikasi);
									$tgl_terkini=$data_otentikasi["crdate"];
									
								?>
								<div class="controls">
									<span class="input-medium uneditable-input"><?php echo $tgl_terkini;?></span>
									<span class="input-xlarge uneditable-input">
										<?php 
											if (empty($tgl_terkini)){
												echo "HARUS Otentikasi";
											} else {
												echo "OK";
											}
											
										?>
									</span>
								</div>
							</div>	
							
							
							<div class="control-group">
								<label class="control-label">Nominal Pencairan</label>
								<div class="controls">
									<input class="input-medium uneditable-input" type="text" id="pencairan" name="pencairan"  
											value="Rp. <?php 
											$saldo_terkini = $data_pensiun['nominal'] + $saldo;
											echo $saldo_terkini ;?>"	>
								   <!--<input class="input-xlarge focused" type="text" id="pencairan" name="pencairan"  >
								   <input class="input-xlarge uneditable-input" type="text" id="demo" name="demo" >
								   <p id="demo"></p>-->
								
									<select class="form-control" id="kode_status" name="kode_status" >
									<option >Kode Status</option>
									<?php  
									$mysql_status 	= "select status, deskripsi from m_status_o where grupuser = '$grupuser' order by status";
									$show_status 	= mysqli_query($con,$mysql_status)or die(mysqli_error($con));
                
            						while ($data_status = mysqli_fetch_assoc($show_status)) {
            							$idstatus=$data_status["status"];
										$deskripsi=$data_status["deskripsi"];
										echo "<option>". $idstatus." | ".$deskripsi ."</option>";
										}
									?>	
									</select>
							
								</div>
							</div>
							
							<div class="form-actions">
							  <?php
								if (empty($tgl_terkini)){
								?>	
								<input type="button" class="btn "  value="Pencairan"></input>	
								<?php
									} else {
								?>
								 <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="myFunction()" name="cair" value="Pencairan"></input>
								 <?php
								}
							  ?>
							  
							 
							  
							  <input type="submit" class="btn btn-success" name="otentikasi" value="Otentikasi"></input>
							  <input action="action" type="button" class="btn" value="Kembali" onclick="history.go(-1);" />
							</div>
							
							</fieldset>
						  </form>
					
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
			<h3>Konfirmasi Pencairan untuk <?php echo $nama;  ?></h3>
		</div>
		<div class="modal-body" >
			<form class="form-horizontal" action="tr_dopencairan.php" method="post">
				<input type="hidden" name="kodeperusahaan" value=" <?php echo $kodeperusahaan; ?>" />
				<input type="hidden" name="grupmitra" value=" <?php echo $grupmitra; ?>" />
				<input type="hidden" name="notas" value=" <?php echo $data_pensiun['nopensiun']; ?>" />
				<input type="hidden" name="nama" value=" <?php echo $nama; ?>" />
				<input type="hidden" name="jubar" value=" <?php echo $data_pensiun['idjurubayar']; ?>" />
				<input type="hidden" name="norek" value=" <?php echo $data_pensiun['norekening']; ?>" />
				<input type="hidden" name="nominal" value=" <?php echo $data_pensiun['nominal']; ?>" />
				<input type="hidden" name="tgldapem" value=" <?php echo $data_pensiun['tgldapem']; ?>"/>
				<!--<input type="hidden" name="status" value=" <?php //echo $data_pensiun['status']; ?>" />-->
				<input type="hidden" name="tgl"  id="tgl" />
			<div class="control-group">
				<label class="control-label">Nominal Pencairan</label>
				<div class="controls">
					<input class="input-xlarge uneditable-input" type="text" id="demo_cair" name="nominal_cair" >
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Kode Status</label>
				<div class="controls">
					<input class="input-xlarge uneditable-input" type="text" id="demo_status" name="status_cair" >
				</div>
			</div>
			
			
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<!--<a class="btn btn-primary" href="tr_dopencairan.php" name="konfirmasi">Save changes</a>-->
			<input type="submit" class="btn btn-primary" name="konfirmasi" value="Save changes"></input>
		</div>
		</form>
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
