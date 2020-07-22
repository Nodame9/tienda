<?php require_once('../Connections/conexiondeportes.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE empleados SET Nombre=%s, Rol=%s, FechaR=%s WHERE idEmpleado=%s",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Rol'], "text"),
                       GetSQLValueString($_POST['FechaR'], "date"),
                       GetSQLValueString($_POST['idEmpleado'], "int"));

  mysql_select_db($database_conexiondeportes, $conexiondeportes);
  $Result1 = mysql_query($updateSQL, $conexiondeportes) or die(mysql_error());

  $updateGoTo = "empleados_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varEmpleado_DatosEmpleado = "0";
if (isset($_GET["recordID"])) {
  $varEmpleado_DatosEmpleado = $_GET["recordID"];
}
mysql_select_db($database_conexiondeportes, $conexiondeportes);
$query_DatosEmpleado = sprintf("SELECT * FROM empleados WHERE empleados.idEmpleado=%s", GetSQLValueString($varEmpleado_DatosEmpleado, "int"));
$DatosEmpleado = mysql_query($query_DatosEmpleado, $conexiondeportes) or die(mysql_error());
$row_DatosEmpleado = mysql_fetch_assoc($DatosEmpleado);
$totalRows_DatosEmpleado = mysql_num_rows($DatosEmpleado);$varEmpleado_DatosEmpleado = "0";
if (isset($_GET["recordID"])) {
  $varEmpleado_DatosEmpleado = $_GET["recordID"];
}
mysql_select_db($database_conexiondeportes, $conexiondeportes);
$query_DatosEmpleado = sprintf("SELECT * FROM empleados WHERE empleados.idEmpleado=%s", GetSQLValueString($varEmpleado_DatosEmpleado, "int"));
$DatosEmpleado = mysql_query($query_DatosEmpleado, $conexiondeportes) or die(mysql_error());
$row_DatosEmpleado = mysql_fetch_assoc($DatosEmpleado);
$totalRows_DatosEmpleado = mysql_num_rows($DatosEmpleado);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/BaseAdmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administraci&oacute;n Principal Tienda Deportes</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../estilo/twoColFixLtHdr.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header">
    <p><img src="../images/LOGO.png" width="281" height="103" alt="Administracion" /></p>
  </div>
  <div class="sidebar1">
  <?php include("../includes/cabeceraadmin.php")?>
   
  <!-- end .sidebar1 --></div>
  <div class="content"><!-- InstanceBeginEditable name="Contenido" -->
  <h1><strong>Editar Empleado</strong></h1>
  <p>&nbsp;</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nombre:</td>
        <td><input type="text" name="Nombre" value="<?php echo htmlentities($row_DatosEmpleado['Nombre'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Rol:</td>
        <td><input type="text" name="Rol" value="<?php echo htmlentities($row_DatosEmpleado['Rol'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Fecha de Registro:</td>
        <td><input type="text" name="FechaR" value="<?php echo htmlentities($row_DatosEmpleado['FechaR'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Actualizar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="idEmpleado" value="<?php echo $row_DatosEmpleado['idEmpleado']; ?>" />
</form>
  <p>&nbsp;</p>
  <!-- InstanceEndEditable -->
   </p>
  <!-- end .content --></div>
  <div class="footer">
    <p>Administraci&oacute;n Tienda Deportes</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosEmpleado);
?>
