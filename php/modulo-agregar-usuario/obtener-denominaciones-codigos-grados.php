<?php
header('Content-Type: application/json');

// Configurar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corpamag_certificados";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Obtener denominaciones
$denominaciones = [];
$result = $conn->query("SELECT * FROM Denominaciones");
while ($row = $result->fetch_assoc()) {
    $denominaciones[] = $row;
}

// Obtener códigos
$codigos = [];
$result = $conn->query("SELECT * FROM Codigos");
while ($row = $result->fetch_assoc()) {
    $codigos[] = $row;
}

// Obtener grados
$grados = [];
$result = $conn->query("SELECT * FROM Grados");
while ($row = $result->fetch_assoc()) {
    $grados[] = $row;
}

echo json_encode(['denominaciones' => $denominaciones, 'codigos' => $codigos, 'grados' => $grados]);
?>
