<?php
$server = "192.168.91.50:39015";
$database = "DIFO";

$con=odbc_connect("DBHana32", "system", "F1nn3t@hanadb",SQL_CUR_USE_ODBC);
if (!$con)
  {exit("Connection Failed: " . $con);}

?>