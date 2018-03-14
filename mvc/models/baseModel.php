<?php

/**
* 
*/
class baseModel
{
	
	function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		define("SHOW_SQL_ERROR", true);
	}

	public function connectHana()
	{

		$server 	= "192.168.91.50:39015";
		$database 	= "DIFO";
		$connect 	= odbc_connect("DBHana32", "system", "F1nn3t@hanadb",SQL_CUR_USE_ODBC);

		if (!$connect) exit("Connection Failed: " . $connect);

		return $connect;
	}

	public function connectMysql()
	{
		$servername = "www.difolestari.com";
		$username 	= "difolest_edapem";
		$password 	= "finnet2017";
		$dbname 	= "difolest_e_dapem";

		$connect = mysqli_connect( $servername, $username, $password, $dbname ) ;
		mysql_connect( $servername, $username, $password ) ;
		mysql_select_db( $dbname ) or die( "Error :".mysql_error() );

		return $connect;

	}
}