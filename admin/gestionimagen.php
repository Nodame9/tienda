<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Subir Imagen</title>
</head>

<body>

<?php if ((isset($_POST["enviado"])) && ($_POST["enviado"] == "form1")) {
	$nombre_archivo = $_FILES['userfile']['name']; 
	move_uploaded_file($_FILES['userfile']['tmp_name'], "../documentos/productos/".$nombre_archivo);
	
	?>
    <script>
		opener.document.form1.Imagen.value="<?php echo $nombre_archivo; ?>";
		self.close();
	</script>
    <?php
}
else
{?>


<form action="gestionimagen.php" method="post" enctype="multipart/form-data" id="form1">

  <p>
    <input name="userfile" type="file" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Subir Imagen" />
  </p>
  <input type="hidden" name="enviado" value="form1" />
</form>
<?php }?>
</body>
</html>