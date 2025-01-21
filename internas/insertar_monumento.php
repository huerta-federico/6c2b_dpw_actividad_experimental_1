<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Proceso para guardar un nuevo registro a la base de datos
include("config.php");
include("class_mysqli.php");

// Variables para guardar mensajes
$error = "";
$success = "";

// Verificar si los campos requeridos están establecidos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sanitizaciones
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $tipo_de_material = htmlspecialchars($_POST['tipo_de_material'], ENT_QUOTES, 'UTF-8');
    $altura = filter_input(INPUT_POST, 'altura', FILTER_VALIDATE_INT);
    $ciudad = htmlspecialchars($_POST['ciudad'], ENT_QUOTES, 'UTF-8');
    
    if (!$nombre || !$tipo_de_material || !$altura || !$ciudad) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Crear una nueva instancia de mysqli
        $miconexion = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        // Verificar conexión
        if ($miconexion->connect_error) {
            die("Conexión fallida: " . $miconexion->connect_error);
        }

        // Preparar y vincular
        $stmt = $miconexion->prepare("INSERT INTO `monumentos` (`nombre`, `tipo_de_material`, `altura_metros`, `ciudad`) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            $error = "Error al preparar la declaración: " . $miconexion->error;
        } else {
            $stmt->bind_param("ssis", $nombre, $tipo_de_material, $altura, $ciudad);

            // Ejecutar la declaración
            if ($stmt->execute()) {
                $success = "Monumento registrado satisfactoriamente.";
                header("Location: ../index.php");
                exit();
            } else {
                $error = "Error al registrar el monumento: " . $stmt->error;
            }

            // Cerrar declaración y conexión
            $stmt->close();
        }

        $miconexion->close();
    }
}

// Mostrar mensajes de error o éxito
if ($error) {
    echo "<p style='color:red;'>$error</p>";
}

if ($success) {
    echo "<p style='color:green;'>$success</p>";
}
?>
