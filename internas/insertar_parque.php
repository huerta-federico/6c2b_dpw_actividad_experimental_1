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
    $extension = filter_input(INPUT_POST, 'extension', FILTER_VALIDATE_INT);
    $ciudad = htmlspecialchars($_POST['ciudad'], ENT_QUOTES, 'UTF-8');
    $anio_inauguracion = filter_input(INPUT_POST, 'anio_inauguracion', FILTER_VALIDATE_INT);
    $barrio = htmlspecialchars($_POST['barrio'], ENT_QUOTES, 'UTF-8');
    
    if (!$nombre || !$extension || !$ciudad || !$anio_inauguracion || !$barrio) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Crear una nueva instancia de mysqli
        $miconexion = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        // Verificar conexión
        if ($miconexion->connect_error) {
            die("Conexión fallida: " . $miconexion->connect_error);
        }

        // Preparar y vincular
        $stmt = $miconexion->prepare("INSERT INTO `parques` (`nombre`, `extension_hectareas`, `ciudad`, `anio_inauguracion`, `barrio`) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            $error = "Error al preparar la declaración: " . $miconexion->error;
        } else {
            $stmt->bind_param("sisss", $nombre, $extension, $ciudad, $anio_inauguracion, $barrio);

            // Ejecutar la declaración
            if ($stmt->execute()) {
                $success = "Parque registrado satisfactoriamente.";
                header("Location: ../index.php");
                exit();
            } else {
                $error = "Error al registrar el parque: " . $stmt->error;
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
