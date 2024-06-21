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
    $iddependencia = $_GET['id'];

    $sql = "SELECT nombre, id FROM dependencia WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $iddependencia);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $datosdependencia = array(
            'id' => $row['id'],
            'nombre' => $row['nombre']
        );
        echo json_encode($datosdependencia);
    } else {
        echo json_encode(array('error' => 'No se encontró la dependencia'));
    }
} else {
    echo json_encode(array('error' => 'No se proporcionó el código de la dependencia'));
}

$conn->close();
?>
