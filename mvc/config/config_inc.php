<?php
	date_default_timezone_set('Asia/Jakarta');
	define("SHOW_SQL_ERROR", true);
	define('DB_DRIVER', "hana");

	if( DB_DRIVER == 'hana')
	{		
		$server = "192.168.91.50:39015";
		$database = "DIFO";

		$con = odbc_connect("DBHana32", "system", "F1nn3t@hanadb",SQL_CUR_USE_ODBC);

		if (!$con) exit("Connection Failed: " . $con);

	}else{

		$servername = "www.difolestari.com";
		$username 	= "difolest_edapem";
		$password 	= "finnet2017";
		$dbname 	= "difolest_e_dapem";

		$con = mysqli_connect( $servername, $username, $password, $dbname ) ;
		mysql_connect( $servername, $username, $password ) ;
		mysql_select_db( $dbname ) or die( "Error :".mysql_error() );

	}
?>