<?php
      // proceso para guardar un nuevo registro a la base de datos
      include("config.php");
      include("class_mysqli.php");



      $nombre = $_REQUEST['nombre'];
      $extension = intval($_REQUEST['extension']);
      $ciudad = $_REQUEST['ciudad'];
      $anio_inauguracion = intval($_REQUEST['anio_inauguracion']);
      $barrio = $_REQUEST['barrio'];
      $cadena = "insert into `parques`( `nombre`, `extension_hectareas`,`ciudad`, 
        `anio_inauguracion`, `barrio`) values ('%s', '%d', '%s', '%d', '%s');"; 
      $cadena = sprintf($cadena, $nombre, $extension, $ciudad, $anio_inauguracion, $barrio);
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
        header("Location: nuevo_parque.php?error=".$mensaje);
      }
?>
