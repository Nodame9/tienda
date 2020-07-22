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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuario SET Nombre=%s, Email=%s, Direccion=%s, Password=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['idUsuario'], "int"));

  mysql_select_db($database_conexiondeportes, $conexiondeportes);
  $Result1 = mysql_query($updateSQL, $conexiondeportes) or die(mysql_error());

  $updateGoTo = "usuario_modificacion_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varUsuario_DatosUsuario = "0";
if (isset($_SESSION["MM_idUsuario"])) {
  $varUsuario_DatosUsuario = $_SESSION["MM_idUsuario"];
}
mysql_select_db($database_conexiondeportes, $conexiondeportes);
$query_DatosUsuario = sprintf("SELECT * FROM usuario WHERE usuario.idUsuario=%s", GetSQLValueString($varUsuario_DatosUsuario, "int"));
$DatosUsuario = mysql_query($query_DatosUsuario, $conexiondeportes) or die(mysql_error());
$row_DatosUsuario = mysql_fetch_assoc($DatosUsuario);
$totalRows_DatosUsuario = mysql_num_rows($DatosUsuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Modificar</title>
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
    <h1><!-- InstanceBeginEditable name="Titulo" -->Modificar datos de usuario<!-- InstanceEndEditable --></h1>
    <p><!-- InstanceBeginEditable name="Contenido" -->Modifica tus datos...<br />
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre:</td>
      <td><input type="text" name="Nombre" value="<?php echo htmlentities($row_DatosUsuario['Nombre'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="Email" value="<?php echo htmlentities($row_DatosUsuario['Email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Direcci&oacute;n:</td>
      <td><input type="text" name="Direccion" value="<?php echo htmlentities($row_DatosUsuario['Direccion'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="password" name="Password" value="<?php echo htmlentities($row_DatosUsuario['Password'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar datos de usuario" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idUsuario" value="<?php echo $row_DatosUsuario['idUsuario']; ?>" />
</form><br />
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
mysql_free_result($DatosUsuario);
?>
