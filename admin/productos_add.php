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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO producto (Nombre, Disponibilidad, Precio, Stock, Categoria,Imagen) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Disponibilidad'], "text"),
                       GetSQLValueString($_POST['Precio'], "double"),
                       GetSQLValueString($_POST['Stock'], "int"),
                       GetSQLValueString($_POST['Categoria'], "text"),
					   GetSQLValueString($_POST['Imagen'], "text"));

  mysql_select_db($database_conexiondeportes, $conexiondeportes);
  $Result1 = mysql_query($insertSQL, $conexiondeportes) or die(mysql_error());

  $insertGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
  
  <h1><strong>A&ntilde;adir Producto</strong></h1>
  <p>&nbsp;</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nombre:</td>
        <td><span id="sprytextfield1">
          <input type="text" name="Nombre" value="" size="32" />
          <span class="textfieldRequiredMsg">Necesario.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Disponibilidad:</td>
        <td><select name="Disponibilidad">
          <option value="Activo" <?php if (!(strcmp("Activo", ""))) {echo "SELECTED";} ?>>Activo</option>
          <option value="Inactivo" <?php if (!(strcmp("Inactivo", ""))) {echo "SELECTED";} ?>>Inactivo</option>
          </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Precio:</td>
        <td><span id="sprytextfield2">
          <input type="text" name="Precio" value="" size="32" />
          <span class="textfieldRequiredMsg">Necesario.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Stock:</td>
        <td><span id="sprytextfield3">
          <input type="text" name="Stock" value="" size="32" />
          <span class="textfieldRequiredMsg">Necesario.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Imagen</td>
        <td><label for="Imagen"></label>
          <input type="text" name="Imagen" id="Imagen" />
          <input type="submit" name="button" id="button" value="Subir Imagen" onclick ="javascript:subirimagen();" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Categoria:</td>
        <td><label for="Categoria"></label>
          <select name="Categoria" id="Categoria">
            <?php
do {  
?>
            <option value="<?php echo $row_ConsultaCategorias['idCategoria']?>"><?php echo $row_ConsultaCategorias['Descripcion']?></option>
            <?php
} while ($row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias));
  $rows = mysql_num_rows($ConsultaCategorias);
  if($rows > 0) {
      mysql_data_seek($ConsultaCategorias, 0);
	  $row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias);
  }
?>
          </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Insertar producto" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <p>&nbsp;</p>
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
  </script>
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
mysql_free_result($ConsultaCategorias);
?>
