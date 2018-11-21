<?php require_once('Connections/Application.php'); 

if ( isset( $_GET['ID'] ) ) {
$insertSQL = sprintf("UPDATE `Application` set `read` = 1 WHERE ID=" . $_GET['ID'] ) ;

  mysql_select_db($database_Application, $Application);
  $Result1 = mysql_query($insertSQL, $Application) or die(mysql_error());
} else {
	echo 'no record specified';
	}
?>