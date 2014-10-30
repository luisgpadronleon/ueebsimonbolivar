<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_puertoLab = "localhost";
$database_puertoLab = "sistema_escolar";
$username_puertoLab = "root";
$password_puertoLab = "Sofia1340";
$puertoLab = mysql_pconnect($hostname_puertoLab, $username_puertoLab, $password_puertoLab) or trigger_error(mysql_error(),E_USER_ERROR); 
?>