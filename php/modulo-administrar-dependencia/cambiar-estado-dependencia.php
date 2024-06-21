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

// Verificar si se recibió el ID de la dependencia a cambiar
if (isset($_POST['id'])) {
    $dependenciaId = $_POST['id'];
    
    // Consultar el estado actual de la dependencia
    $sql_estado = "SELECT estado FROM dependencia WHERE id = ?";
    $stmt_estado = $conn->prepare($sql_estado);
    $stmt_estado->bind_param("i", $dependenciaId);
    $stmt_estado->execute();
    $result_estado = $stmt_estado->get_result();
    
    if ($result_estado->num_rows > 0) {
        $row = $result_estado->fetch_assoc();
        $estadoActual = $row['estado'];
        
        // Cambiar el estado de la dependencia (de 0 a 1 o de 1 a 0)
        $nuevoestado = $estadoActual == 0 ? 1 : 0;
        
        // Actualizar el estado en la base de datos
        $sql_actualizar = "UPDATE dependencia SET estado = ? WHERE id = ?";
        $stmt_actualizar = $conn->prepare($sql_actualizar);
        $stmt_actualizar->bind_param("ii", $nuevoestado, $dependenciaId);
        
        $stmt_actualizar->execute();
    }
}

$conn->close();
?>
