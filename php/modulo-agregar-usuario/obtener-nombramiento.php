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


// Obtener los nombramientos de la base de datos
$query = "SELECT id, tipo FROM nombramiento";
$result = $conn->query($query);

$nombramientos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombramientos[] = [
            'id' => $row['id'],
            'tipo' => $row['tipo']
        ];
    }
}

echo json_encode(['nombramientos' => $nombramientos]);

$conn->close();
?>
