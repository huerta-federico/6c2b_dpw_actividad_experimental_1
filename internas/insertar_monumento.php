<?php
      // proceso para guardar un nuevo registro a la base de datos
      include("config.php");
      include("class_mysqli.php");

      $nombre = $_REQUEST['nombre'];
      $tipo_de_material = $_REQUEST['tipo_de_material'];
      $altura = intval($_REQUEST['altura']);
      $ciudad = $_REQUEST['ciudad'];
      $cadena = "insert into `monumentos`( `nombre`, `tipo_de_material`,`altura_metros`, 
        `ciudad`) values ('%s', '%s', '%d', '%s');"; 
      $cadena = sprintf($cadena, $nombre, $tipo_de_material, $altura, $ciudad);
      echo $cadena;
      $miconexion= new class_mysqli;
      $miconexion->conectar(DBHOST, DBUSER, DBPASS, DBNAME);
      $miconexion-> consulta($cadena);
      
      if($miconexion){
        // si hay existo con la inserción, 
        // se realiza un redirect a index.php
        header("Location: ../index.php");
      }else{
        // si exite un error
        // se captura el error
        // se hace un redirect a nuevo.php
        // además se envía el mensaje de error
        // como parámetro
        $mensaje = $miconexion -> error;
        header("Location: nuevo_monumento.php?error=".$mensaje);
      }
?>
