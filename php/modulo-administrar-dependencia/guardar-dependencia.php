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
    $nombre = $_POST["nombre-dependencia"];
    $estado = 1;

    if (empty($nombre)) {
        $_SESSION['error_message_dependencias'] = "El campo 'nombre' es obligatorio.";
        header("location: ../../modulo-administrar-dependencias.php");
        exit();
    }
    
    // Verificar si el nombre de la dependencia ya existe en la base de datos
    $sql_verificar_nombre = "SELECT COUNT(*) as count FROM dependencia WHERE nombre = ?";
    $stmt_verificar_nombre = $conn->prepare($sql_verificar_nombre);
    $stmt_verificar_nombre->bind_param("s", $nombre);
    $stmt_verificar_nombre->execute();
    $result_verificar_nombre = $stmt_verificar_nombre->get_result();
    $row_verificar_nombre = $result_verificar_nombre->fetch_assoc();

    if ($row_verificar_nombre['count'] > 0) {
        $_SESSION['error_message_dependencias'] = "Ya existe una dependencia con el mismo nombre.";
        header("location: ../../modulo-administrar-dependencias.php");
        exit();
    }

    // Obtener todos los IDs existentes
    $sql_obtener_ids = "SELECT id FROM dependencia ORDER BY id";
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
    $sql = "INSERT INTO dependencia (id, nombre, estado) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $nuevo_id, $nombre, $estado);
    
    if ($stmt->execute()) {
        $_SESSION['success_message_dependencias'] = "dependencia guardado exitosamente.";
        header("location: ../../modulo-administrar-dependencias.php");
        exit();
    } else {
        $_SESSION['error_message_dependencias'] = "Error al guardar la dependencia: " . $conn->error;
        header("location: ../../modulo-administrar-dependencias.php");
        exit();
    }
}

$conn->close();
?>
