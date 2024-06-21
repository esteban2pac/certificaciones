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

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $tipo = $_POST["tipo-nombramiento"];
    $estado = 1;

    if (empty($tipo)) {
        $_SESSION['error_message_nombramientos'] = "El campo 'tipo' es obligatorio.";
        header("location: ../../modulo-administrar-nombramientos.php");
        exit();
    }
    
    // Verificar si el tipo de la nombramiento ya existe en la base de datos
    $sql_verificar_tipo = "SELECT COUNT(*) as count FROM nombramiento WHERE tipo = ?";
    $stmt_verificar_tipo = $conn->prepare($sql_verificar_tipo);
    $stmt_verificar_tipo->bind_param("s", $tipo);
    $stmt_verificar_tipo->execute();
    $result_verificar_tipo = $stmt_verificar_tipo->get_result();
    $row_verificar_tipo = $result_verificar_tipo->fetch_assoc();

    if ($row_verificar_tipo['count'] > 0) {
        $_SESSION['error_message_nombramientos'] = "Ya existe una nombramiento con el mismo tipo.";
        header("location: ../../modulo-administrar-nombramientos.php");
        exit();
    }

    // Obtener todos los IDs existentes
    $sql_obtener_ids = "SELECT id FROM nombramiento ORDER BY id";
    $result_obtener_ids = $conn->query($sql_obtener_ids);

    $ids_existentes = array();
    while ($row = $result_obtener_ids->fetch_assoc()) {
        $ids_existentes[] = $row['id'];
    }

    // Encontrar el ID más bajo disponible
    $nuevo_id = 1;
    foreach ($ids_existentes as $id) {
        if ($id == $nuevo_id) {
            $nuevo_id++;
        } else {
            break;
        }
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO nombramiento (id, tipo, estado) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $nuevo_id, $tipo, $estado);
    
    if ($stmt->execute()) {
        $_SESSION['success_message_nombramientos'] = "Nombramiento guardado exitosamente.";
        header("location: ../../modulo-administrar-nombramientos.php");
        exit();
    } else {
        $_SESSION['error_message_nombramientos'] = "Error al guardar la nombramiento: " . $conn->error;
        header("location: ../../modulo-administrar-nombramientos.php");
        exit();
    }
}

$conn->close();
?>
