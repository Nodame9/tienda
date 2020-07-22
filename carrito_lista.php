<?php require_once('Connections/conexiondeportes.php'); ?>
<?php require_once('Connections/conexiondeportes.php'); 
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


$varUsuario_DatosCarrito = "0";
if (isset($_SESSION["MM_idUsuario"])) {
  $varUsuario_DatosCarrito = $_SESSION["MM_idUsuario"];
}
mysql_select_db($database_conexiondeportes, $conexiondeportes);
$query_DatosCarrito = sprintf("SELECT * FROM carrito WHERE carrito.idUsuario=%s AND carrito.TransaccionEfectuada=0", GetSQLValueString($varUsuario_DatosCarrito, "int"));
$DatosCarrito = mysql_query($query_DatosCarrito, $conexiondeportes) or die(mysql_error());
$row_DatosCarrito = mysql_fetch_assoc($DatosCarrito);
$totalRows_DatosCarrito = mysql_num_rows($DatosCarrito);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Carrito</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="estilo/principal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><div class="headerinterior"><img src="images/LOGO1.png" width="273" height="63" /></div></div>
  <div class="subcontenedor">
  <div class="sidebar1">
    <?php include("includes/catalogo.php"); ?>
  <!-- end .sidebar1 --></div>
  <div class="content">
    <h1><!-- InstanceBeginEditable name="Titulo" -->En carrito<!-- InstanceEndEditable --></h1>
    <p>
    <!-- InstanceBeginEditable name="Contenido" -->
    <?php if ($totalRows_DatosCarrito == 0) { // Show if recordset empty ?>
      El carrito est&aacute; vac&iacute;o.
  <?php } // Show if recordset empty ?>
    <br />
    <?php if ($totalRows_DatosCarrito > 0) { // Show if recordset not empty ?>
      <br />
      <table width="100%" cellpadding="15" cellspacing="2">
        <tr >
          <td width="38" bgcolor="#FFFFCC">Producto</td>
          <td width="38" bgcolor="#FFFFCC">Unidades</td>
          <td width="38" bgcolor="#FFFFCC">Precio</td>
          <td width="38" bgcolor="#FFFFCC">Acciones</td>
          <?php  $preciototal=0;?>
        </tr>
        <?php do { ?>
          <tr class="brillo">
            <td><?php echo ObtenerNombreProducto ($row_DatosCarrito['idProducto']); ?></td>
            <td><?php echo $row_DatosCarrito['Cantidad']; ?></td>
            <td><?php echo ObtenerPrecioProducto ($row_DatosCarrito['idProducto']); ?> Pesos</td>
            <td><a href="carrito_delete.php?recordID=<?php echo $row_DatosCarrito['intContador']; ?>">Eliminar</a></td>
          </tr>
          <?php $preciototal = $preciototal + ObtenerPrecioProducto ($row_DatosCarrito['idProducto']);?>
          <?php } while ($row_DatosCarrito = mysql_fetch_assoc($DatosCarrito)); ?>
        <tr>
          <td>&nbsp;</td>
          <td align="right">Total:</td>
          <td><?php echo $preciototal;?>Pesos</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <a href="carrito_forma_pago.php">Forma de pago </a>
      <?php } // Show if recordset not empty ?>
    <!-- InstanceEndEditable -->
    </p>
    <!-- end .content --></div>
     <!-- end .subcontenedor --></div>
    </div>
  <div class="footer">
    <p>P&aacute;gina Principal</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosCarrito);
?>
