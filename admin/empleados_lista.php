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

$maxRows_DatosEmpleado = 10;
$pageNum_DatosEmpleado = 0;
if (isset($_GET['pageNum_DatosEmpleado'])) {
  $pageNum_DatosEmpleado = $_GET['pageNum_DatosEmpleado'];
}
$startRow_DatosEmpleado = $pageNum_DatosEmpleado * $maxRows_DatosEmpleado;

mysql_select_db($database_conexiondeportes, $conexiondeportes);
$query_DatosEmpleado = "SELECT * FROM empleados ORDER BY empleados.Nombre ASC";
$query_limit_DatosEmpleado = sprintf("%s LIMIT %d, %d", $query_DatosEmpleado, $startRow_DatosEmpleado, $maxRows_DatosEmpleado);
$DatosEmpleado = mysql_query($query_limit_DatosEmpleado, $conexiondeportes) or die(mysql_error());
$row_DatosEmpleado = mysql_fetch_assoc($DatosEmpleado);

if (isset($_GET['totalRows_DatosEmpleado'])) {
  $totalRows_DatosEmpleado = $_GET['totalRows_DatosEmpleado'];
} else {
  $all_DatosEmpleado = mysql_query($query_DatosEmpleado);
  $totalRows_DatosEmpleado = mysql_num_rows($all_DatosEmpleado);
}
$totalPages_DatosEmpleado = ceil($totalRows_DatosEmpleado/$maxRows_DatosEmpleado)-1;
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
  <h1><strong>Recursos Humanos</strong></h1>
  <p><a href="empleados_add.php">A&ntilde;adir empleado</a></p>
  <p>&nbsp;</p>
  <table width="100%" border="0" cellspacing="2" cellpadding="15">
    <tr>
      <td bgcolor="#FFFFCC">Nombre</td>
      <td bgcolor="#FFFFCC">id</td>
      <td bgcolor="#FFFFCC">Fecha registro</td>
      <td bgcolor="#FFFFCC">Rol</td>
      <td bgcolor="#FFFFCC">Acciones</td>
    </tr>
    <?php do { ?>
      <tr class= "brillo">
        <td><?php echo $row_DatosEmpleado['Nombre']; ?></td>
        <td><?php echo $row_DatosEmpleado['idEmpleado']; ?></td>
        <td><?php echo $row_DatosEmpleado['FechaR']; ?></td>
        <td><?php echo $row_DatosEmpleado['Rol']; ?></td>
        <td><a href="empleados_edit.php?recordID=<?php echo $row_DatosEmpleado['idEmpleado']; ?>">Editar</a></a>-<a href="empleados_delete.php?recordID=<?php echo $row_DatosEmpleado['idEmpleado']; ?>">Eliminar</a></a></td>
      </tr>
      <?php } while ($row_DatosEmpleado = mysql_fetch_assoc($DatosEmpleado)); ?>
  </table>
  <p>&nbsp;</p>
  <p><?php echo $totalRows_DatosEmpleado ?> Registro Total </p>
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
