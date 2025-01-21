<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Proceso para guardar un nuevo registro a la base de datos
include("config.php");
include("class_mysqli.php");

// Verificar si los campos requeridos están establecidos
if (!isset($_POST['nombre'], $_POST['tipo_de_material'], $_POST['altura'], $_POST['ciudad'])) {
  header("Location: nuevo_monumento.php?error=" . urlencode("Todos los campos son obligatorios."));
  exit();
}

$nombre = $_POST['nombre'];
$tipo_de_material = $_POST['tipo_de_material'];
$altura = intval($_POST['altura']);
$ciudad = $_POST['ciudad'];

// Crear una nueva instancia de mysqli
$miconexion = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Verificar conexión
if ($miconexion->connect_error) {
  die("Conexión fallida: " . $miconexion->connect_error);
}

// Preparar y vincular
$stmt = $miconexion->prepare("INSERT INTO `monumentos` (`nombre`, `tipo_de_material`, `altura_metros`, `ciudad`) VALUES (?, ?, ?, ?)");
if (!$stmt) {
  $mensaje = "Error al preparar la declaración: " . $miconexion->error;
  header("Location: nuevo_monumento.php?error=" . urlencode($mensaje));
  exit();
}
$stmt->bind_param("ssis", $nombre, $tipo_de_material, $altura, $ciudad);

// Ejecutar la declaración
if ($stmt->execute()) {
  // Si hay éxito con la inserción, se realiza un redirect a index.php
  header("Location: ../index.php");
} else {
  // Si existe un error, se captura el error y se hace un redirect a nuevo_monumento.php
  // Además se envía el mensaje de error como parámetro
  $mensaje = $stmt->error;
  header("Location: nuevo_monumento.php?error=" . urlencode($mensaje));
}

// Cerrar declaración y conexión
$stmt->close();
$miconexion->close();
