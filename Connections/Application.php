<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Application = "foxhillapp.db.7634333.hostedresource.com";
$database_Application = "foxhillapp";
$username_Application = "foxhillapp";
$password_Application = "fx08701Hill";
$Application = mysql_pconnect($hostname_Application, $username_Application, $password_Application) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
