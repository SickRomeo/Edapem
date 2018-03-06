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

//cek lokasi user
	$mysql_user 	 = "select EMAIL, ID_JRBYR from DIFO.M_USER where EMAIL =  '$iduser' ";
	$myquery_user = odbc_exec($con,$mysql_user);
	if (odbc_num_rows($myquery_user) > 0){
		$data_user = odbc_fetch_array($myquery_user);
		$idjurubayar = trim($data_user['ID_JRBYR']);
	}
//ambil deskripsi lokasi	
	$mysql_lokasi 	 = "select GR_MITRA, ID_JRBYR, TX_JRBYR from DIFO.M_JRBYR where ID_JRBYR =  '$idjurubayar' and GR_MITRA = '$grupmitra' ";
	$myquery_lokasi = odbc_exec($con,$mysql_lokasi);
	if (odbc_num_rows($myquery_lokasi) > 0){
		$data_lokasi = odbc_fetch_array($myquery_lokasi);
		$lokasi= $data_lokasi['TX_JRBYR']; 	
	}	
//ambil deskripsi mitra	
/* 	$mysql_mitra 	 = "select grupmitra, nama from m_mitra where grupmitra = '$grupmitra' ";
	$myquery_mitra = odbc_exec($con,$mysql_mitra)or die(mysqli_error($con));
	if (odbc_num_rows($myquery_mitra) > 0){
		$data_mitra = odbc_fetch_array($myquery_mitra);
		$mitra= $data_mitra['nama'];
	}	 */

	
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
					
						<h2><i class="halflings-icon user"></i><span class="break"></span>
							Daftar Pensiun di 
							<?php 
								/* if (!empty($lokasi)){
									echo $lokasi;
								} else {
									echo $mitra;
								} */
								echo $lokasi;
							?>
						</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						 <thead>
							  <tr>
								  <th>No. Pensiun</th>
								  <th>Nama</th>
								  <th>Kode Jiwa</th>
								  <th>Jenis Pensiun</th>
								  <th>No. Rek</th>
								  <th>Nominal Edapem</th>
								  <th>Edapem Terkini</th>
								  <th>Saldo Lalu</th>
								  <th>Operasi</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <!-- Start Script to Connect to Database -->
							<?php
							
							if (!empty($idjurubayar)){
								//select the database
								$mysql_latest 	= "select PERIODE from DIFO.Q_DAPEM where GR_MITRA = '$grupmitra' and ID_JRBYR = '$idjurubayar' order by PERIODE desc limit 1";
								$myquery_latest = odbc_exec($con,$mysql_latest);
								$data_latest = odbc_fetch_array($myquery_latest);
								
								$periode = $data_latest['PERIODE'];
								$periode_saldo = $periode - 1 ;
								
								$mysql 	 = "select distinct TGL_DAPEM, GR_MITRA, NO_PENSIUN, NAMA_PENSIUN, ID_JRBYR, ID_JIWA, JN_PENSIUN, NOMINAL, NO_REKNG 
												from DIFO.Q_DAPEM where GR_MITRA = '$grupmitra' and ID_JRBYR = '$idjurubayar' and periode = '$periode'";
												
								$myquery = odbc_exec($con,$mysql);

								$jml_data = odbc_num_rows($myquery);
				
								$baris = 0 ;
			
								if (odbc_num_rows($myquery) > 0) 
								{
									while($data = odbc_fetch_array($myquery)) 
									{ 	$baris++;
										$nopensiun = $data['NO_PENSIUN'];
										$nominal = $data['NOMINAL'];
										//echo $periode_saldo;
										$mysql_saldo 	 = "select sum (SALDO) as saldo_lalu from DIFO.Q_SALDO 
															where GR_MITRA = '$grupmitra' and ID_JRBYR = '$idjurubayar' and NO_PENSIUN = '$nopensiun' ";
										$myquery_saldo = odbc_exec($con,$mysql_saldo);
										$data_saldo = odbc_fetch_array($myquery_saldo);
										$saldo = $data_saldo['SALDO_LALU'];
							?>
							<!--- End of Script --->
								<form>
								<input type="hidden" name="id" value=" .'$nopensiun'." /> 
								<tr>
									<td><?php echo $nopensiun; ?></td>
									<td><?php echo $data['NAMA_PENSIUN'];?></td>
									<td><?php echo $data['ID_JIWA'];?></td>
									<td><?php echo $data['JN_PENSIUN'];?></td>
									<td><?php echo $data['NO_REKNG'];?></td>
									<td style="text-align:right">
										<?php 
										$nominal = (int)$data['NOMINAL'];
										echo number_format("$nominal",2,",",".");
										?></td>
									
									<td style="text-align:center"><?php echo $data['TGL_DAPEM'];?></td>
									<td style="text-align:right"><?php 
											if (empty($saldo))	
											{
												$nol = 0;
												echo number_format("$nol",2,",",".");
												$saldo = $nol;
												} else {
													echo number_format("$saldo",2,",",".");
											}
										?>
									</td>
									<td style="text-align:center">
										<a class="btn btn-success" href="tr_pencairan_displaydet.php?id=<?php echo $data['NO_PENSIUN']; ?>&saldo=<?php echo $saldo; ?>">
											<i class="halflings-icon white zoom-in"></i>  
										</a>
									</td>
								</form>	
							<?php
								}
							}
							} else 
								{
								//select the database
								$mysql_latest 	= "select distinct PERIODE	from DIFO.Q_DAPEM where GR_MITRA = '$grupmitra' order by periode desc limit 1";
								$myquery_latest = odbc_exec($con,$mysql_latest);
								$data_latest = odbc_fetch_array($myquery_latest);
								
								$periode = $data_latest['PERIODE'];
								$periode_saldo = $periode - 1 ;
								
								$mysql 	 = "select distinct TGL_DAPEM, GR_MITRA, NO_PENSIUN, NAMA_PENSIUN, ID_JRBYR, ID_JIWA, JN_PENSIUN, NOMINAL, NO_REKNG  
												from DIFO.Q_DAPEM where GR_MITRA = '$grupmitra' and PERIODE = '$periode'";
											
								$myquery = odbc_exec($con,$mysql);

								$jml_data = odbc_num_rows($myquery);
			
								$baris = 0 ;
		
								if (odbc_num_rows($myquery) > 0) 
								{
									while($data = odbc_fetch_array($myquery)) 
									{ $baris++;
										$nopensiun = $data['nopensiun'];
										$nominal = $data['nominal'];
										//echo $periode_saldo;
										
										$mysql_saldo 	 = "select sum(saldo) as saldo_lalu, periodesaldo from DIFO.Q_SALDO 
															where GR_MITRA = '$grupmitra' and NO_PENSIUN = '$nopensiun' ";
										$myquery_saldo = odbc_exec($con,$mysql_saldo);
										$data_saldo = odbc_fetch_array($myquery_saldo);
										$saldo = $data_saldo['saldo_lalu'];
							?>
									<!--- End of Script --->
									<form>
									<input type="hidden" name="id" value=" .'$data['nopensiun']'." /> 
									<tr>
										<td><?php echo $data['nopensiun']?></td>
										<td><?php echo $data['namapenerima']?></td>
										<td><?php echo $data['idjiwa']?></td>
										<td><?php echo $data['jenispensiun']?></td>
										<td><?php echo $data['norekening']?></td>
										<td style="text-align:right">
										<?php 
										$nominal = (int)$data['nominal'];
										echo number_format("$nominal",2,",",".");
										?></td>
									
									<td style="text-align:center"><?php echo $data['tgldapem'];?></td>
									<td style="text-align:right"><?php 
											if (empty($saldo))	
											{
												$nol = 0;
												echo number_format("$nol",2,",",".");
												$saldo = $nol;
												} else {
													echo number_format("$saldo",2,",",".");
											}
										?>
									</td>
									<td style="text-align:center">
										<a class="btn btn-success" href="tr_pencairan_displaydet.php?id=<?php echo $data['nopensiun']; ?>&saldo=<?php echo $saldo; ?>">
											<i class="halflings-icon white zoom-in"></i>  
										</a>
									</td>
									</form>	
							<?php	
									} 
								}
							}
							
							
							
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