<?php
require '../../vendor/autoload.php';
use PhpOffice\PhpWord\TemplateProcessor;

// Configurar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corpamag_certificados";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del usuario desde la base de datos usando la cédula
$cedula = $_GET['cedula']; // Se pasa la cédula de la persona por la URL
$sql = "SELECT * FROM usuario WHERE cedula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $cedula);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

   // Unir el nombre completo y convertirlo a mayúsculas
   $nombreCompleto = strtoupper($row['primer_nombre'] . ' ' . 
   (!empty($row['segundo_nombre']) ? $row['segundo_nombre'] . ' ' : '') . 
   $row['primer_apellido'] . ' ' . $row['segundo_apellido']);
    // Cargar la plantilla de Word
    $templateProcessor = new TemplateProcessor('../../assets/plantilla/CERTIFICADO LABORAL.docx');

    function formatCedula($cedula) {
        return number_format($cedula, 0, '', '.');
    }
    // Determinar el mensaje de género
    $genero = strtolower($row['genero']);
    $mensajeGenero = ($genero == 'masculino') ? 'el funcionario' : 'la funcionaria';

    // Reemplazar los marcadores de posición con los datos de la persona
    $templateProcessor->setValue('{{mensaje_genero}}',htmlspecialchars($mensajeGenero));
    $templateProcessor->setValue('{{nombre}}', htmlspecialchars($nombreCompleto));
    $templateProcessor->setValue('{{cedula}}', (formatCedula($row['cedula'])));
    $templateProcessor->setValue('{{dia_vinculacion}}', htmlspecialchars($row['dia_vinculacion']));
    $templateProcessor->setValue('{{mes_vinculacion}}',htmlspecialchars($row['mes_vinculacion']));
    $templateProcessor->setValue('{{año_vinculacion}}',htmlspecialchars($row['año_vinculacion']));
    $templateProcessor->setValue('{{cargo}}', htmlspecialchars($row['cargo']));
    $templateProcessor->setValue('{{codigo}}', htmlspecialchars($row['codigo'])); 
    $templateProcessor->setValue('{{grado}}', htmlspecialchars($row['grado']));
    
    // Obtener la fecha actual y dividirla en día, mes y año
    $fechaActual = date('Y-m-d');
    list($anoActual, $mesActual, $diaActual) = explode('-', $fechaActual);

     // Mapa de los nombres de los meses
     $meses = [
        '01' => 'enero',
        '02' => 'febrero',
        '03' => 'marzo',
        '04' => 'abril',
        '05' => 'mayo',
        '06' => 'junio',
        '07' => 'julio',
        '08' => 'agosto',
        '09' => 'septiembre',
        '10' => 'octubre',
        '11' => 'noviembre',
        '12' => 'diciembre',
    ];

    // Obtener el nombre del mes
    $nombreMes = $meses[$mesActual];

    // Establecer el texto adecuado para el día actual
    $prefijoDia = ($diaActual == 1) ? " el" : " a los";

    $templateProcessor->setValue('{{prefijo_dia}}', htmlspecialchars($prefijoDia));
    $templateProcessor->setValue('{{fecha_dia_actual}}', htmlspecialchars($diaActual));
    $templateProcessor->setValue('{{fecha_mes_actual}}', htmlspecialchars($nombreMes));
    $templateProcessor->setValue('{{fecha_año_actual}}', htmlspecialchars($anoActual));

    // Guardar el documento generado
    $outputFile = 'CERTIFICADO LABORAL SIN SUELDO ' . htmlspecialchars($nombreCompleto) . '.docx';
    $templateProcessor->saveAs($outputFile);


    // Ofrecer el archivo para descargar
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($outputFile));
    ob_clean();
    flush();
    readfile($outputFile);
    unlink($outputFile); // Eliminar el archivo temporal después de la descarga
    exit;
} else {
    echo "No se encontraron datos para esta persona.";
}

$stmt->close();
$conn->close();
?>
