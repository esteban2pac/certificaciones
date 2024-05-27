<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "corpamag_certificados";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombreCompleto = '';

if (isset($_SESSION["cedula"])) {
    $cedula = $_SESSION["cedula"];
    $sql = "SELECT primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM usuario WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombreCompleto = $row["primer_nombre"] . ' ' . $row["segundo_nombre"] . ' ' . $row["primer_apellido"] . ' ' . $row["segundo_apellido"];
    }
}

$conn->close();
?>
