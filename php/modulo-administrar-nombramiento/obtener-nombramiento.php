<?php
session_start();
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corpamag_certificados";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $idnombramiento = $_GET['id'];

    $sql = "SELECT tipo, id FROM nombramiento WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $idnombramiento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $datosnombramiento = array(
            'id' => $row['id'],
            'tipo' => $row['tipo']
        );
        echo json_encode($datosnombramiento);
    } else {
        echo json_encode(array('error' => 'No se encontró la nombramiento'));
    }
} else {
    echo json_encode(array('error' => 'No se proporcionó el código de la nombramiento'));
}

$conn->close();
?>
