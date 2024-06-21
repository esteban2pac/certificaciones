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
    die(json_encode(["success" => false, "message" => "Error de conexión: " . $conn->connect_error]));
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir el código de la nombramiento a eliminar
    $id = $_POST["id-nombramiento"];

    // Eliminar la nombramiento de la base de datos
    $sql = "DELETE FROM nombramiento WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Nombramiento eliminado exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar el nombramiento: " . $conn->error]);
    }
}

$conn->close();
?>

