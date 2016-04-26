<?php
  require_once 'Alumno.php';
  Alumno::CrearTablaAlumnos();
?>
<!doctype html>
<html lang="en-US">
<head>

  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title> Alumnos </title>

  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <link rel="stylesheet" type="text/css" href="css/animacion.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/style.css">
 
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.autocomplete.min.js"></script>
  <script type="text/javascript" src="js/funcionAutoCompletar.js"></script>
  <!--script type="text/javascript" src="js/currency-autocomplete.js"></script-->
</head>
	<body>
    <div class="CajaUno animated bounceInDown">
          <form action="gestion.php" method="post" enctype="multipart/form-data">
              <input type="text" name="numLegajo" placeholder="Legajo (solo numeros)" pattern="[0-9]{3}" required>
              <br>
              <input type="text" name="txtApellido" placeholder="Apellido" >
              <br>
              <input type="text" name="txtNombre" placeholder="Nombre" >
              <br>
              <input type="file" name="fileFoto"  > 
              <br><br>
              <input type="submit" class="MiBotonUTN" name="btn" value="Ingresar Alumno">  <br> <br> 
              <input type="submit" class="MiBotonUTNLinea" name="btn" value="Borrar Alumno">
              <input type="submit" class="MiBotonUTN"btn name="btn" value="Modificar Alumno">
          </form>
    </div>

    <div  class="CajaEnunciado animated bounceInLeft">
      <h3>Tabla de Alumnos:</h3>
      <?php  
        include 'Archivos/tablaAlumnos.php'; 
      ?>
    </div>
</body>
</html>