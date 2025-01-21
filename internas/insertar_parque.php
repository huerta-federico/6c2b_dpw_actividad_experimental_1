<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Proceso para guardar un nuevo registro a la base de datos
include("config.php");
include("class_mysqli.php");

// Verificar si los campos requeridos están establecidos
if (!isset($_POST['nombre'], $_POST['extension'], $_POST['ciudad'], $_POST['anio_inauguracion'], $_POST['barrio'])) {
  header("Location: nuevo_parque.php?error=" . urlencode("Todos los campos son obligatorios."));
  exit();
}

$nombre = $_POST['nombre'];
$extension = intval($_POST['extension']);
$ciudad = $_POST['ciudad'];
$anio_inauguracion = intval($_POST['anio_inauguracion']);
$barrio = $_POST['barrio'];

// Crear una nueva instancia de mysqli
$miconexion = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Verificar conexión
if ($miconexion->connect_error) {
  die("Conexión fallida: " . $miconexion->connect_error);
}

// Preparar y vincular
$stmt = $miconexion->prepare("INSERT INTO `parques` (`nombre`, `extension_hectareas`, `ciudad`, `anio_inauguracion`, `barrio`) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
  $mensaje = "Error al preparar la declaración: " . $miconexion->error;
  header("Location: nuevo_parque.php?error=" . urlencode($mensaje));
  exit();
}
$stmt->bind_param("sisss", $nombre, $extension, $ciudad, $anio_inauguracion, $barrio);

// Ejecutar la declaración
if ($stmt->execute()) {
  // Si hay éxito con la inserción, se realiza un redirect a index.php
  header("Location: ../index.php");
} else {
  // Si existe un error, se captura el error y se hace un redirect a nuevo_parque.php
  // Además se envía el mensaje de error como parámetro
  $mensaje = $stmt->error;
  header("Location: nuevo_parque.php?error=" . urlencode($mensaje));
}

// Cerrar declaración y conexión
$stmt->close();
$miconexion->close();
