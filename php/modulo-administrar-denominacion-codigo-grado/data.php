<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corpamag_certificados";

$response = array('status' => '', 'data' => array(), 'message' => '');

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT d.id as denominacion_id, d.nombre as denominacion_nombre, d.estado as denominacion_estado,
                   c.id as codigo_id, c.codigo as codigo_codigo, c.estado as codigo_estado,
                   g.id as grado_id, g.grado as grado_grado, g.estado as grado_estado
            FROM denominaciones d
            LEFT JOIN codigos c ON d.id = c.denominacion_id
            LEFT JOIN grados g ON c.id = g.codigo_id";

    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    $response['status'] = 'success';
    $response['data'] = $data;
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
} finally {
    if ($conn) {
        $conn->close();
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
