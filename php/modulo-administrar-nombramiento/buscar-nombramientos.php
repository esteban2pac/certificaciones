<?php
session_start();
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corpamag_certificados";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Parámetros de paginación
$por_pagina = 7;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($pagina - 1) * $por_pagina;

// Parámetro de búsqueda
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Consulta SQL para obtener las nombramientos de esta página con opción de búsqueda
if (!empty($busqueda)) {
    // Si hay una cadena de búsqueda, ajustar la consulta SQL
    $sql = "SELECT id, tipo, estado FROM nombramiento WHERE tipo LIKE ? LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $busqueda_like = $busqueda . '%';
    $stmt->bind_param("sii", $busqueda_like, $offset, $por_pagina);
} else {
    // Si no hay una cadena de búsqueda, utilizar la consulta SQL estándar
    $sql = "SELECT id, tipo, estado FROM nombramiento LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $offset, $por_pagina);
}

// Ejecutar la consulta preparada
$stmt->execute();
$result = $stmt->get_result();

// Array para almacenar las nombramientos encontradas
$nombramientos = [];

// Procesar resultados
while ($row = $result->fetch_assoc()) {
    $nombramientos[] = $row;
}

// Consulta SQL para obtener el total de registros (considerando la búsqueda si la hay)
$sql_total = "SELECT COUNT(*) AS total FROM nombramiento";
if (!empty($busqueda)) {
    // Si hay una cadena de búsqueda, ajustar la consulta SQL
    $sql_total .= " WHERE tipo LIKE ?";
}
$stmt_total = $conn->prepare($sql_total);
if (!empty($busqueda)) {
    // Si hay una cadena de búsqueda, añadir el parámetro de búsqueda
    $stmt_total->bind_param("s", $busqueda_like);
}
$stmt_total->execute();
$result_total = $stmt_total->get_result();
$total_registros = $result_total->fetch_assoc()['total'];

// Calcular el total de páginas
$total_paginas = ceil($total_registros / $por_pagina);

// Devolver los resultados y el total de páginas como JSON
echo json_encode(array(
    'nombramientos' => $nombramientos,
    'total_paginas' => $total_paginas,
    'total_registros' => $total_registros
));

$conn->close();
?>
