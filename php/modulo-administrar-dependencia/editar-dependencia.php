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
    $viejo_id = $_POST["viejo-id"]; // Obtener el id anterior

    // Verificar si el nombre está vacío
    if (empty($nombre)) {
        $_SESSION['error_message_dependencias'] = "Debe llenar el campo nombre.";
        header("location: ../../modulo-administrar-dependencias.php");
        exit();
    }

    // Verificar si el nombre de la dependencia ya existe en la base de datos (excepto para esta dependencia)
    $sql_verificar_nombre = "SELECT COUNT(*) as count FROM dependencia WHERE nombre = ? AND id != ?";
    $stmt_verificar_nombre = $conn->prepare($sql_verificar_nombre);
    $stmt_verificar_nombre->bind_param("si", $nombre, $viejo_id); // Usar el id anterior
    $stmt_verificar_nombre->execute();
    $result_verificar_nombre = $stmt_verificar_nombre->get_result();
    $row_verificar_nombre = $result_verificar_nombre->fetch_assoc();

    if ($row_verificar_nombre['count'] > 0) {
        $_SESSION['error_message_dependencias'] = "Ya existe un dependencia con el mismo nombre.";
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
        if ($viejo_id == $nuevo_id){
            break;
        }
        else if ($id == $nuevo_id) {
            $nuevo_id++;
        } else {
            break;
        }
    }

    // Actualizar los datos en la base de datos
    $sql = "UPDATE dependencia SET nombre = ?, id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nombre, $nuevo_id, $viejo_id); // Usar el id anterior y el nuevo id

    if ($stmt->execute()) {
        $_SESSION['success_message_dependencias'] = "dependencia editado exitosamente.";
        header("location: ../../modulo-administrar-dependencias.php");
        exit();
    } else {
        $_SESSION['error_message_dependencias'] = "Error al editar el dependencia: " . $conn->error;
        header("location: ../../modulo-administrar-dependencias.php");
        exit();
    }
}

$conn->close();
?>
