<?php require_once('Connections/conexiondeportes.php'); ?>
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

$varProducto_DatosProducto = "0";
if (isset($_GET["recordID"])) {
  $varProducto_DatosProducto = $_GET["recordID"];
}
mysql_select_db($database_conexiondeportes, $conexiondeportes);
$query_DatosProducto = sprintf("SELECT * FROM producto WHERE producto.idProducto=%s", GetSQLValueString($varProducto_DatosProducto, "int"));
$DatosProducto = mysql_query($query_DatosProducto, $conexiondeportes) or die(mysql_error());
$row_DatosProducto = mysql_fetch_assoc($DatosProducto);
$totalRows_DatosProducto = mysql_num_rows($DatosProducto);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Producto</title>
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
    <h1><!-- InstanceBeginEditable name="Titulo" --><?php echo $row_DatosProducto['Nombre']; ?><!-- InstanceEndEditable --></h1>
    <p><!-- InstanceBeginEditable name="Contenido" --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="documentos/productos/<?php echo $row_DatosProducto['Imagen']; ?>" width="450" height="450" /></td>
    <td valign="top"><p><?php echo $row_DatosProducto['Nombre']; ?></p>
      <p><?php echo $row_DatosProducto['Precio']; ?></p>
      <?php if ((isset($_SESSION['MM_idUsuario'])) &&($_SESSION['MM_idUsuario'])!="")      {?>
      <p><a href="carrito_add.php?recordID=<?php echo $row_DatosProducto['idProducto']; ?>">Comprar</a></p>
      <?php }
	  else 
	  {?>
      Necesitas <a href="alta_usuario.php">darte de alta</a> para comprar. Es gratuito.
<?php }?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<br />
      <br />
    <!-- InstanceEndEditable --></p>
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
mysql_free_result($DatosProducto);
?>
