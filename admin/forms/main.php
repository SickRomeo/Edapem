<?php
	include "../include/config.php";
	session_start();	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>E-dapem Plus (demo)</title>
	<meta name="description" content="E-dapem Plus (demo)">
	<meta name="author" content="Difo Lestari">
	<meta name="keyword" content="Dashboard, Admin, Pension, E-dapem, Finger, Fingerprint">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="../css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="../css/style-responsive.css" rel="stylesheet">
	<!--
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'> -->
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
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
					<a href="main.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
			</ul>
			
			
			<div class="row-fluid">
				
				<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<?php
						//select the database
						$sql_kota 	 = "select distinct ID_JRBYR from DIFO.Q_DAPEM where TGL_DAPEM='20180301'";
						$query_kota = odbc_exec($con,$sql_kota);

						$jml_kota = odbc_num_rows($query_kota); 
					?>
					<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
					<div class="number">
							<?php 
								echo $jml_kota; 
				
							?>
						<i class="icon-arrow-up"></i>
					</div>
					<div class="title">juru bayar</div>
					<div class="footer">
						<a href="table.php"> read full report</a>
					</div>	
				</div>
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
					<?php
						//select the database
						$sql_tglpensiun 	 = "select TGL_DAPEM from DIFO.Q_DAPEM where TGL_DAPEM between '20180101' and '20181231'";
						$query_tglpensiun = odbc_exec($con,$sql_tglpensiun);;

						$jml_tglpensiun = odbc_num_rows($query_tglpensiun); 
					?>
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number">	
						<?php  echo $jml_tglpensiun; ?><i class="icon-arrow-up"></i>
					</div>
					<div class="title">pensiun tahun ini </div>
					<div class="footer">
						<a href="table.php"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox red noMargin" onTablet="span6" onDesktop="span3">
					<?php
						//select the database
						$mysql_enroll = "select ID_STATU from DIFO.Q_DAPEM where TGL_DAPEM between '20180101' and '20181231' and ID_STATU = '99'" ;
						$myquery_enroll = odbc_exec($con,$mysql_enroll);

						$jml_enroll = odbc_num_rows($myquery_enroll); 
					?>
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number"><?php echo $jml_enroll ;?><i class="icon-arrow-up"></i>
					</div>
					<div class="title">perlu otentikasi tahun ini</div>
					<div class="footer">
						<a href="table.php"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<?php
						//select the database
					 	$mysql_confirm = "select ID_STATU from DIFO.Q_DAPEM where TGL_DAPEM between '20180101' and '20181231' and ID_STATU = '11'";
						$mysql_confirm = odbc_exec($con,$mysql_confirm);

						$jml_confirm = odbc_num_rows($mysql_confirm); 
					?>
					<div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
					<div class="number"><?php  echo $jml_confirm ;?><i class="icon-arrow-down"></i></div>
					<div class="title">
						otentikasi tahun ini
					</div>
					<div class="footer">
						<a href="table.php"> read full report</a>
					</div>
				</div>	
				
			</div>		
						<!-- sparkstats (graph view) -->
			<!--
			<div class="row-fluid">
				
				<div class="span8 widget blue" onTablet="span7" onDesktop="span8">
					
					<div id="stats-chart2"  style="height:282px" ></div>
					
				</div>
				
				<div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">

                    <ul class="unstyled">
                        
                        <li><span class="sparkLineStats3"></span> 
                            Pageviews: 
                            <span class="number">781</span>
                        </li>
                        <li><span class="sparkLineStats4"></span>
                            Pages / Visit: 
                            <span class="number">2,19</span>
                        </li>
                        <li><span class="sparkLineStats5"></span>
                            Avg. Visit Duration: 
                            <span class="number">00:02:58</span>
                        </li>
                        <li><span class="sparkLineStats6"></span>
                            Bounce Rate: <span class="number">59,83%</span>
                        </li>
                        <li><span class="sparkLineStats7"></span>
                            % New Visits: 
                            <span class="number">70,79%</span>
                        </li>
                        <li><span class="sparkLineStats8"></span>
                            % Returning Visitor: 
                            <span class="number">29,21%</span>
                        </li>

                    </ul>
					
					<div class="clearfix"></div>

                </div>

			</div> <!-- End .sparkStats -->
			
			<!--  circle stats (graph view) -->
			<!--
			<div class="row-fluid hideInIE8 circleStats">
				
				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox yellow">
						<div class="header">Disk Space Usage</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="58" class="whiteCircle" />
						</div>		
						<div class="footer">
							<span class="count">
								<span class="number">20000</span>
								<span class="unit">MB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">50000</span>
								<span class="unit">MB</span>
							</span>	
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Bandwidth</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="78" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>	
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox greenDark">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>	
						</div>
                	</div>
				</div>

				<div class="span2 noMargin" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox pink">
						<div class="header">CPU</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="83" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GHz</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">3.2</span>
								<span class="unit">GHz</span>
							</span>	
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox orange">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>	
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox greenLight">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>	
						</div>
                	</div>
				</div>
						
			</div>		-->
						
			<!--/span-->
				
				<!-- 
				<div class="widget span6 red" onTablet="span6" onDesktop="span6">
					
					<h2><span class="glyphicons pie_chart"><i></i></span> Tipe Pensiun</h2>
					
					<hr>
					
					<div class="content">
						
						<div class="browserStat big">
							<img src="img/grup_beds_big.png" alt="Beds">
							<span>34%</span>
						</div>
						<div class="browserStat big">
							<img src="img/grup_crdv_big.png" alt="Cardiovascular">
							<span>34%</span>
						</div>
						<div class="browserStat">
							<img src="img/grup_crit.png" alt="Critical Care">
							<span>34%</span>
						</div>
						<div class="browserStat">
							<img src="img/grup_dent.png" alt="Dental Equipment">
							<span>34%</span>
						</div>
						<div class="browserStat">
							<img src="img/grup_ifc.png" alt="Infection Control">
							<span>34%</span>
						</div>

								
						
					</div>
				</div>
				<!--
				<div class="widget yellow span4 noMargin" onTablet="span12" onDesktop="span4">
					<h2><span class="glyphicons fire"><i></i></span> Server Load</h2>
					<hr>
					<div class="content">
						 <div id="serverLoad2" style="height:224px;"></div>
					</div>
				</div>
				-->
			</div>
			<!-- widget view -->
			<!--
			<div class="row-fluid">
				
				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Weekly Stat</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li>
								<a href="#">
									<i class="icon-arrow-up green"></i>                               
									<strong>92</strong>
									New Comments                                    
								</a>
							</li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-down red"></i>
							  <strong>15</strong>
							  New Registrations
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-minus blue"></i>
							  <strong>36</strong>
							  New Articles                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-comment yellow"></i>
							  <strong>45</strong>
							  User reviews                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-up green"></i>                               
							  <strong>112</strong>
							  New Comments                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-down red"></i>
							  <strong>31</strong>
							  New Registrations
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-minus blue"></i>
							  <strong>93</strong>
							  New Articles                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-comment yellow"></i>
							  <strong>256</strong>
							  User reviews                                    
							</a>
						  </li>
						</ul>
					</div>
				</div><!--/span-->
				<!--
				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Last Users</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Approved             
							</li>
							<li class="yellow">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Pending                                
							</li>
							<li class="red">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Banned                                  
							</li>
							<li class="blue">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Updated                                 
							</li>
						</ul>
					</div>
				</div><!--/span
				-->
				<!--
				<div class="box black span4 noMargin" onTablet="span12" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white check"></i><span class="break"></span>To Do List</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="todo metro">
							<ul class="todo-list">
								<li class="red">
									<a class="action icon-check-empty" href="#"></a>	
									Windows Phone 8 App 
									<strong>today</strong>
								</li>
								<li class="red">
									<a class="action icon-check-empty" href="#"></a>
									New frontend layout
									<strong>today</strong>
								</li>
								<li class="yellow">
									<a class="action icon-check-empty" href="#"></a>
									Hire developers
									<strong>tommorow</strong>
								</li>
								<li class="yellow">
									<a class="action icon-check-empty" href="#"></a>
									Windows Phone 8 App
									<strong>tommorow</strong>
								</li>
								<li class="green">
									<a class="action icon-check-empty" href="#"></a>
									New frontend layout
									<strong>this week</strong>
								</li>
								<li class="green">
									<a class="action icon-check-empty" href="#"></a>
									Hire developers
									<strong>this week</strong>
								</li>
								<li class="blue">
									<a class="action icon-check-empty" href="#"></a>
									New frontend layout
									<strong>this month</strong>
								</li>
								<li class="blue">
									<a class="action icon-check-empty" href="#"></a>
									Hire developers
									<strong>this month</strong>
								</li>
							</ul>
						</div>	
					</div>
				</div>
			
			</div> -->
			
			<!-- quick button view -->
			<!--
			<div class="row-fluid">	

				<a class="quick-button metro yellow span2">
					<i class="icon-group"></i>
					<p>Users</p>
					<span class="badge">237</span>
				</a>
				<a class="quick-button metro red span2">
					<i class="icon-comments-alt"></i>
					<p>Comments</p>
					<span class="badge">46</span>
				</a>
				<a class="quick-button metro blue span2">
					<i class="icon-shopping-cart"></i>
					<p>Orders</p>
					<span class="badge">13</span>
				</a>
				<a class="quick-button metro green span2">
					<i class="icon-barcode"></i>
					<p>Products</p>
				</a>
				<a class="quick-button metro pink span2">
					<i class="icon-envelope"></i>
					<p>Messages</p>
					<span class="badge">88</span>
				</a>
				<a class="quick-button metro black span2">
					<i class="icon-calendar"></i>
					<p>Calendar</p>
				</a>
				
				<div class="clearfix"></div>
								
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
