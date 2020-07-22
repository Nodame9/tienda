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
  $updateSQL = sprintf("UPDATE producto SET Nombre=%s, Disponibilidad=%s, Precio=%s, Stock=%s, Categoria=%s, Imagen=%s WHERE idProducto=%s",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Disponibilidad'], "text"),
                       GetSQLValueString($_POST['Precio'], "double"),
                       GetSQLValueString($_POST['Stock'], "int"),
                       GetSQLValueString($_POST['Categoria'], "text"),
                       GetSQLValueString($_POST['Imagen'], "text"),
                       GetSQLValueString($_POST['idProducto'], "int"));

  mysql_select_db($database_conexiondeportes, $conexiondeportes);
  $Result1 = mysql_query($updateSQL, $conexiondeportes) or die(mysql_error());

  $updateGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE producto SET Nombre=%s, Disponibilidad=%s, Precio=%s, Stock=%s, Categoria=%s, Imagen=%s WHERE idProducto=%s",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Disponibilidad'], "text"),
                       GetSQLValueString($_POST['Precio'], "double"),
                       GetSQLValueString($_POST['Stock'], "int"),
                       GetSQLValueString($_POST['Categoria'], "text"),
                       GetSQLValueString($_POST['Imagen'], "text"),
                       GetSQLValueString($_POST['idProducto'], "int"));

  mysql_select_db($database_conexiondeportes, $conexiondeportes);
  $Result1 = mysql_query($updateSQL, $conexiondeportes) or die(mysql_error());

  $updateGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

mysql_select_db($database_conexiondeportes, $conexiondeportes);
$query_ConsultaCategorias = "SELECT * FROM categoria ORDER BY categoria.Descripcion ASC";
$ConsultaCategorias = mysql_query($query_ConsultaCategorias, $conexiondeportes) or die(mysql_error());
$row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias);
$totalRows_ConsultaCategorias = mysql_num_rows($ConsultaCategorias);
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
  <script>
 function subirimagen()
 {
	 self.name = 'opener';
	 remote = open('gestionimagen.php','remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,resizable=yes,fullscreen=no, status=yes');
	 remote.focus();
	 }
  </script>
  <h1><strong>Editar Producto</strong></h1>
  <p>&nbsp;</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td width="123" align="right" nowrap="nowrap">Nombre:</td>
        <td width="283"><input type="text" name="Nombre" value="<?php echo htmlentities($row_DatosProducto['Nombre'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Disponibilidad:</td>
        <td><select name="Disponibilidad">
          <option value="Activo" <?php if (!(strcmp("Activo", htmlentities($row_DatosProducto['Disponibilidad'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Activo</option>
          <option value="Inactivo" <?php if (!(strcmp("Inactivo", htmlentities($row_DatosProducto['Disponibilidad'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Inactivo</option>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Precio:</td>
        <td><input type="text" name="Precio" value="<?php echo htmlentities($row_DatosProducto['Precio'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Stock:</td>
        <td><input type="text" name="Stock" value="<?php echo htmlentities($row_DatosProducto['Stock'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Categoria:</td>
        <td><select name="Categoria">
          <?php 
do {  
?>
          <option value="<?php echo $row_ConsultaCategorias['idCategoria']?>" <?php if (!(strcmp($row_ConsultaCategorias['idCategoria'], htmlentities($row_DatosProducto['Categoria'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>><?php echo $row_ConsultaCategorias['Descripcion']?></option>
          <?php
} while ($row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias));
?>
        </select></td>
      </tr>
      <tr> </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Imagen:</td>
        <td><input type="text" name="Imagen" value="<?php echo htmlentities($row_DatosProducto['Imagen'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
          <input type="submit" name="button" id="button" value="Subir Imagen" onclick = "javascript:subirimagen();" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Actualizar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="idProducto" value="<?php echo $row_DatosProducto['idProducto']; ?>" />
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
mysql_free_result($DatosProducto);

mysql_free_result($ConsultaCategorias);
?>
