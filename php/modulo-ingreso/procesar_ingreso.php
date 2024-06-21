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

if (isset($_SESSION["cedula"])) {
    header("Location:../../main-page.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST["cedula"];

    $sql = "SELECT estado FROM usuario WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["cedula"] = $cedula;
        $_SESSION["estado"] = $row["estado"];
        $estado = $row["estado"];
        if ($estado == 1) {
            header("Location:../../main-page.php");
            exit();
        } else {
            $_SESSION['error_message'] = "El usuario se encuentra inactivo, para solicitar sus certificados mandar un correo a xxxxxxxxxxx@xxxxxxx.com";
            header("Location: ../../modulo-ingreso.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "No hay cedula registrada que coincida.";
        header("Location: ../../modulo-ingreso.php");
        exit();
    }
}
$conn->close();
?>
