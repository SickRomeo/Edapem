<?php
	//$idmitra = $_SESSION['idmitra'];
	include "../include/config.php";
	$grupmitra  = $_SESSION['gr_mitra'];
	$grupuser = $_SESSION['gr_user'];

?>

<div id="sidebar-left" class="span2">
	<div class="nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">

<?php
	/* echo $_SESSION['iduser']."</br>";
	echo $grupuser ; */
		
	$i = 0;
	//$result = mysql_query("SELECT * FROM q_akses WHERE grupmitra='$grupmitra' AND grupuser='$grupuser' GROUP BY menuid, submenu1id")
	//	or die(mysql_error($con));
	$sql = "SELECT * FROM DIFO.Q_AKSES WHERE GR_MITRA= '$grupmitra' AND GR_USER= '$grupuser' 	";
	$result = odbc_exec($con,$sql);
		
	$menuid = "";
	$submenu1 = "";
	

	while($dataMenu =odbc_fetch_array($result)){
		//var_dump($dataMenu);	
		if ( $menuid != $dataMenu['ID_MENU'] ) {
			
			echo '<li><a class="dropmenu" href="#"><i class="icon-dashboard">';
			/* $query = mysql_query("SELECT * FROM m_menu WHERE menuid='".$dataMenu['menuid']."' AND 	
				submenu1id='".$dataMenu['submenu1id']."' AND submenu2id='".$dataMenu['submenu2id']."'") 
	  			or die(mysql_error($con)); */
			$query = "SELECT * FROM DIFO.m_menu WHERE id_menu='".$dataMenu['ID_MENU']."' AND 	
				id_sbmn1='".$dataMenu['ID_SBMN1']."' AND id_sbmn2='".$dataMenu['ID_SBMN2']."'";
	  			$result_menu=odbc_exec($con,$query);
			while($dataHeader = odbc_fetch_array($result_menu)) {
				echo '</i><span class="hidden-tablet">'.$dataHeader['TX_MENU'].'</a></span>';
	 		}
		}
		
		if ($dataMenu['ID_SBMN2'] == '1') {
				echo '<ul>';
	        	$query = "SELECT * FROM DIFO.m_menu WHERE id_menu = '".$dataMenu['ID_MENU']."' AND 	
				id_sbmn1 = '".$dataMenu['ID_SBMN1']."' AND id_sbmn2 = '".$dataMenu['ID_SBMN2']."'";
	  			$result_menu2=odbc_exec($con,$query);
				
			while($dataHeader2 = odbc_fetch_array($result_menu2)) {
				
	      			echo '<li><a class="submenu" href="'.$dataHeader2['LN_SBMN1'].'"><i class="icon-file-alt"></i><span class="hidden-tablet">'.
	      				$dataHeader2['TX_SBMN1'].'</span></a></li>';
	      		}  
	      		echo '</ul>';  
					//echo '</li>'; 		
	       	}	
			
		$menuid = $dataMenu['ID_MENU'];
		
		$i++;
	}
	
?>

		<!--
			<li><a href="main.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>				
                        <li><a href="messages.html"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
                        <li><a href="tasks.php"><i class="icon-tasks"></i><span class="hidden-tablet"> Tasks</span></a></li>
			<li><a href="ui.php"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
                        <li><a href="widgets.php"><i class="icon-dashboard"></i><span class="hidden-tablet"> Widgets</span></a></li>
			<li><a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i>
			<span class="hidden-tablet"> Dropdown</span><span class="label label-important"> 3 </span></a>
			<ul>
				<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
				<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
				<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
			</ul>	
			</li>
                        
			<li><a href="form.php"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
                        <li><a href="form2.php"><i class="icon-edit"></i><span class="hidden-tablet"> Forms II</span></a></li>		
                        <li><a href="chart.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
			<li><a href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
			<li><a href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
                        <li><a href="table.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
                        <li><a href="calendar.php"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
                        <li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
                        <li><a href="icon.html"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
			<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
		-->

		</ul>
	</div>
</div>