<?php
// Configurar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corpamag_certificados";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    error_log("Conexión fallida: " . $conn->connect_error);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Configurar el manejo de errores
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'php-error.log'); // Cambia la ruta según tus necesidades

// Obtener las dependencias de la base de datos
$query = "SELECT id, nombre FROM dependencia";
$result = $conn->query($query);

$dependencias = [];
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dependencias[] = [
                'id' => $row['id'],
                'nombre' => $row['nombre']
            ];
        }
    }
    echo json_encode(['dependencias' => $dependencias]);
} else {
    error_log("Error en la consulta: " . $conn->error);
    echo json_encode(['error' => 'Query failed']);
}

$conn->close();
?>
