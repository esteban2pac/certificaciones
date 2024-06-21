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

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null) {
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$documento = $data['documento'];
$cargo = $data['cargo'];
$primerNombre = $data['primerNombre'];
$segundoNombre = $data['segundoNombre'];
$primerApellido = $data['primerApellido'];
$segundoApellido = $data['segundoApellido'];

// Construir la consulta SQL con parámetros dinámicos
$query = "SELECT * FROM usuario WHERE 1=1";
$params = [];

if (!empty($documento)) {
    $query .= " AND cedula = ?";
    $params[] = $documento;
}
if (!empty($cargo) && $cargo != "Seleccione un cargo...") {
    $query .= " AND cargo = ?";
    $params[] = $cargo;
}
if (!empty($primerNombre)) {
    $query .= " AND primer_nombre LIKE ?";
    $params[] = '%' . $primerNombre . '%';
}
if (!empty($segundoNombre)) {
    $query .= " AND segundo_nombre LIKE ?";
    $params[] = '%' . $segundoNombre . '%';
}
if (!empty($primerApellido)) {
    $query .= " AND primer_apellido LIKE ?";
    $params[] = '%' . $primerApellido . '%';
}
if (!empty($segundoApellido)) {
    $query .= " AND segundo_apellido LIKE ?";
    $params[] = '%' . $segundoApellido . '%';
}

$stmt = $conn->prepare($query);

if ($stmt === false) {
    error_log("Error preparando la consulta: " . $conn->error);
    echo json_encode(['error' => 'Query preparation failed']);
    exit;
}

if (count($params) > 0) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $estado = $row['estado'] == 1 ? 'Activo' : 'Inactivo';
        $usuarios[] = [
            'apellidos' => $row['primer_apellido'] . ' ' . $row['segundo_apellido'],
            'nombres' => $row['primer_nombre'] . ' ' . (!empty($row['segundo_nombre']) ? $row['segundo_nombre'] . ' ' : ''),
            'numero_documento' => $row['cedula'],
            'fecha_vinculacion' => $row['dia_vinculacion'].'-'.$row['mes_vinculacion'].'-'.$row['año_vinculacion'],
            'cargo' => $row['cargo'],
            'estado' => $estado
        ];
    }
}

echo json_encode($usuarios);
?>
