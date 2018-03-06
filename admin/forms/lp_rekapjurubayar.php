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
	
	.alnright { text-align: right; }
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
							Lampiran 16-A
						</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form method=GET action="">
									Tahun-Bulan :
									<select name="periode" onChange="this.form.submit()">
										<option><?php echo date("Y-m");?></option>
										<?php 
										for ($i=0; $i<=36; $i++) { 
										if (isset($_GET['periode'])) {
											echo '<option value="'.date('Y-m-d', strtotime("-$i month")).'" selected>'.date('Y-m', strtotime("-$i month")).'</option>';
											}	else {
											//echo '<option>A </option>';	
											echo '<option value="'.date('Y-m-d', strtotime("-$i month")).'" selected>'.date('Y-m', strtotime("-$i month")).'</option>';	
											}	
										}
										?>
									</select>
						</form>
						<table class="table table-striped table-bordered ">
						 <thead >
							<tr>
								<th colspan="8" style="text-align:center; ">
								<?php	
									if (isset($_GET['periode'])){
										$periode = $_GET['periode'];
										$header= strtotime($periode);
										echo "Bulan : ".date('M - Y', $header);
										$periode = str_replace("-","",$_GET['periode']);
										$periode = substr($periode,0,6);
										//echo $periode;
									} else {$periode = date("Ym",strtotime(date("Y-m")));}
								?>
								</th>
							</tr>
							<tr >
								<th rowspan="2" style="text-align:center; vertical-align:middle">No</th>
								<th rowspan="2" style="text-align:center; vertical-align:middle">Kantor Bayar / Juru Bayar</th>
								<th colspan="2" style="text-align:center">Yang Akan Dibayarkan</th>
								<th colspan="2" style="text-align:center">Yang Dibayarkan</th>
								<th colspan="2" style="text-align:center">Saldo</th>
							</tr>
							<tr>
							  <th style="text-align:center">Penerima Pensiun</th>
							  <th style="text-align:center">Jumlah Bersih</th>
							  <th style="text-align:center">Penerima Pensiun</th>
							  <th style="text-align:center">Jumlah Bersih</th>
							  <th style="text-align:center">Penerima Pensiun</th>
							  <th style="text-align:center">Jumlah Bersih</th>
							 </tr>
							 <tr>
								<th style="text-align:center">(1)</th>
								<th style="text-align:center">(2)</th>
								<th style="text-align:center">(3)</th>
								<th style="text-align:center">(4)</th>
								<th style="text-align:center">(5)</th>
								<th style="text-align:center">(6)</th>
								<th style="text-align:center">(7)</th>
								<th style="text-align:center">(8)</th>
							</tr>
						  </thead>   
						  <tbody>
						  <!-- Start Script to Connect to Database -->
							<?php
							 //select the database
							
							$mysql_jubar 	 = "select distinct GR_MITRA, ID_JRBYR, TX_JRBYR from DIFO.M_JRBYR
												where GR_MITRA = '$grupmitra' order by ID_JRBYR asc";
							$myquery_jubar = odbc_exec($con,$mysql_jubar);

							$jml_data = odbc_num_rows($myquery_jubar);
							$baris = 0 ;
							$gt_pensiun = 0;
							$gt_nominal = 0;
							$gt_pensiun_cair = 0;
							$gt_nominal_cair = 0;
							$gt_pensiun_saldo = 0;
							$gt_nominal_saldo = 0;
							if (odbc_num_rows($myquery_jubar) > 0) 
							{
								while($data_jubar = odbc_fetch_array($myquery_jubar)) 
								{ $baris++;
									$idjubar = $data_jubar["ID_JRBYR"];
									//select dropping data from q_dapem
									$mysql_dapem 	 = "select ID_JRBYR, count (NO_PENSIUN) as jml_pensiun, sum (cast (NOMINAL as int)) as total_nominal from DIFO.Q_DAPEM
														where GR_MITRA = '$grupmitra' and ID_JRBYR = '$idjubar' and PERIODE = '$periode'
														group by ID_JRBYR ";
									$myquery_dapem = odbc_exec($con,$mysql_dapem);
									$data_dapem = odbc_fetch_array($myquery_dapem);
								  
									//select withdrawal data from q_penarikan
									$mysql_cair 	 = "select  ID_JRBYR, count (NO_PENSIUN) as jml_penarikan, sum (cast (NOMINAL as int)) as total_penarikan from DIFO.Q_DAPEM
														where GR_MITRA = '$grupmitra' and ID_JRBYR = '$idjubar' and PERIODE = '$periode' and ID_STATU ='11'
														group by ID_JRBYR ";
									$myquery_cair = odbc_exec($con,$mysql_cair);
									$data_cair = odbc_fetch_array($myquery_cair);								  
								
									//select balance data from q_saldo
									/* $mysql_saldo 	 = "select distinct idjurubayar, count(nopensiun) as jml_pensiun_saldo, sum(nominal) as total_saldo from q_saldo 
														where grupmitra = '$grupmitra' and idjurubayar = '$idjubar'
														order by idjurubayar asc";
									$myquery_saldo = odbc_exec($con,$mysql_saldo)or die(mysqli_error($con));
									$data_saldo = odbc_fetch_array($myquery_saldo); */									
							
							?>
						  <!--- End of Script --->
							
							<tr>
								<td><?php echo $baris;?></td>
								<td><?php echo $data_jubar['TX_JRBYR'];?></td>
								<td style="text-align:right"><?php 
										echo $data_dapem['JML_PENSIUN']; 
										$gt_pensiun = $data_dapem['JML_PENSIUN'] + $gt_pensiun;
									?></td>
								<td style="text-align:right"><?php 
										$total_nominal = (int)$data_dapem['TOTAL_NOMINAL'];
										echo number_format("$total_nominal",2,",",".");
										$gt_nominal = $data_dapem['TOTAL_NOMINAL'] + $gt_nominal;
									?>
								</td>
								<td style="text-align:right"><?php 
										echo $data_cair['JML_PENARIKAN'];
										$gt_pensiun_cair = $data_cair['JML_PENARIKAN'] + $gt_pensiun_cair;
									?>
								</td>
								<td style="text-align:right"><?php 
										$total_cair = (int)$data_cair['TOTAL_PENARIKAN'];
										echo number_format("$total_cair",2,",",".");
										$gt_nominal_cair = $data_cair['TOTAL_PENARIKAN'] + $gt_nominal_cair;
									?>
								</td>
								<td style="text-align:right"><?php 
										//echo $data_saldo['jml_pensiun_saldo'];
										//$gt_pensiun_saldo = $data_saldo['jml_pensiun_saldo'] + $gt_pensiun_saldo;
									?>
								</td>
								<td style="text-align:right"><?php 
										//$data_saldo = (int)$data_saldo['total_saldo'];
										$total_saldo = 0;
										$total_saldo = $total_nominal - $total_cair ;
										echo number_format("$total_saldo",2,",",".");
										//echo number_format("$data_saldo",2,",",".");
										//$gt_nominal_saldo = $data_saldo['total_saldo'] + $gt_nominal_saldo;
										$gt_nominal_saldo = $total_saldo + $gt_nominal_saldo;
									?>
								</td>
							<?php
								}
							}
													else 
								{ echo "0 results";}
							?>
							</tr>
							<tr>
								<td></td>
								<td style="text-align:right">TOTAL</td>
								<td style="text-align:right"><?php echo number_format("$gt_pensiun"); 	?></td>
								<td style="text-align:right"><?php echo number_format("$gt_nominal",2,",",".");	?></td>
								<td style="text-align:right"><?php echo number_format("$gt_pensiun_cair"); ?></td>
								<td style="text-align:right"><?php echo number_format("$gt_nominal_cair",2,",","."); ?></td>
								<td style="text-align:right"><?php echo number_format("$gt_pensiun_saldo");?></td>
								<td style="text-align:right"><?php echo number_format("$gt_nominal_saldo",2,",",".");?></td>
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