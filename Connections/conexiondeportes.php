<?php if (!isset($_SESSION)) {
  session_start();
}?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexiondeportes = "localhost";
$database_conexiondeportes = "deportes";
$username_conexiondeportes = "root";
$password_conexiondeportes = "";
$conexiondeportes = mysql_pconnect($hostname_conexiondeportes, $username_conexiondeportes, $password_conexiondeportes) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php
if (is_file("includes/funciones.php")){
include("includes/funciones.php");
}
else
{ include("../includes/funciones.php");
	}
?>