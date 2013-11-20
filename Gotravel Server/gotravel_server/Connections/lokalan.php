<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_lokalan = "localhost";
$database_lokalan = "kuliah_gotravel";
$username_lokalan = "root";
$password_lokalan = "";
$lokalan = mysql_pconnect($hostname_lokalan, $username_lokalan, $password_lokalan) or trigger_error(mysql_error(),E_USER_ERROR); 
?>