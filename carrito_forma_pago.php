<?php require_once('Connections/conexiondeportes.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Forma de pago</title>
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
    <h1><!-- InstanceBeginEditable name="Titulo" -->Selecciona la forma de pago<!-- InstanceEndEditable --></h1>
    <p><!-- InstanceBeginEditable name="Contenido" -->
      <p>Elige una forma de pago: </p>
      <form id="form1" name="form1" method="post" action="carrito_finalizacion.php">
        <p>
          <input name="radio2" type="radio" id="radio2" value="1" checked="checked" />
          <label for="radio2"></label>
          PayPal        </p>
        <p>
  <input type="radio" name="radio2" id="radio" value="2" />
          <label for="radio"></label>
          Transferencia</p>
        <p>
          <input type="radio" name="radio2" id="radio3" value="3" />
          <label for="radio3"></label> 
          VISA/Mastercard
</p>
<p>
          <input type="submit" name="button" id="button" value="Pagar" />
          </p>
      </form>
        <p><br />
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
