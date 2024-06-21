<?php
require '../../vendor/autoload.php';

use Mpdf\Mpdf;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;


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
    $templateProcessor = new TemplateProcessor('../../assets/plantilla/CERTIFICADO LABORAL CON SALARIO.docx');

    function formatCedula($cedula) {
        return number_format($cedula, 0, '', '.');
    }

    // Determinar el mensaje de género
    $genero = strtolower($row['genero']);
    $mensajeGenero = ($genero == 'masculino') ? 'el funcionario' : 'la funcionaria';
    $identificacionGenero = ($genero == 'masculino') ? 'identificado' : 'identificada';
    function numberToWords($num) {
        $ones = array(
            0 => "CERO",
            1 => "UN",
            2 => "DOS",
            3 => "TRES",
            4 => "CUATRO",
            5 => "CINCO",
            6 => "SEIS",
            7 => "SIETE",
            8 => "OCHO",
            9 => "NUEVE",
            10 => "DIEZ",
            11 => "ONCE",
            12 => "DOCE",
            13 => "TRECE",
            14 => "CATORCE",
            15 => "QUINCE",
            16 => "DIECISÉIS",
            17 => "DIECISIETE",
            18 => "DIECIOCHO",
            19 => "DIECINUEVE"
        );
    
        $tens = array(
            2 => "VEINTE",
            3 => "TREINTA",
            4 => "CUARENTA",
            5 => "CINCUENTA",
            6 => "SESENTA",
            7 => "SETENTA",
            8 => "OCHENTA",
            9 => "NOVENTA"
        );
    
        $hundreds = array(
            1 => "CIENTO",
            2 => "DOSCIENTOS",
            3 => "TRESCIENTOS",
            4 => "CUATROCIENTOS",
            5 => "QUINIENTOS",
            6 => "SEISCIENTOS",
            7 => "SETECIENTOS",
            8 => "OCHOCIENTOS",
            9 => "NOVECIENTOS"
        );
    
        if ($num < 20) {
            return $ones[$num];
        } elseif ($num < 100) {
            return $tens[floor($num / 10)] . ($num % 10 != 0 ? ' Y ' . $ones[$num % 10] : '');
        } elseif ($num < 1000) {
            return $num == 100 ? "CIEN" : $hundreds[floor($num / 100)] . ' ' . ($num % 100 != 0 ? numberToWords($num % 100) : '');
        } elseif ($num < 1000000) {
            return numberToWords(floor($num / 1000)) . ' MIL' . ($num % 1000 != 0 ? ' ' . numberToWords($num % 1000) : '');
        } elseif ($num < 2000000) {
            return 'UN MILLÓN' . ($num % 1000000 != 0 ? ' ' . numberToWords($num % 1000000) : '');
        } elseif ($num < 1000000000) {
            return numberToWords(floor($num / 1000000)) . ' MILLONES' . ($num % 1000000 != 0 ? ' ' . numberToWords($num % 1000000) : '');
        }
    
        return $num;
    }

    // Convertir el salario a palabras
    $salarioEnPalabras = numberToWords($row['salario']);
    $salarioEnPalabras .= " PESOS."; // Concatenar " PESOS." al final
    $salarioEnPalabras = strtoupper($salarioEnPalabras); // Convertir a mayúsculas

    
    // Generar el mensaje de salario
    $mensajeSalario = '';
    if ($row['coordinacion'] == 1) {
        $extraEnPalabras = numberToWords($row['salario'] *0.2);
        $extraEnPalabras .= " PESOS"; // Concatenar " PESOS." al final
        $extraEnPalabras = strtoupper($extraEnPalabras); // Convertir a mayúsculas
        $mensajeSalario = ', Más una coordinacion del 20% '.$extraEnPalabras.'. (' . number_format($row['salario'] * 0.2, 2, ',', '.') . ')';
    } elseif ($row['primas_tecnicas'] == 1) {
        if($row['PTS'] == 1){
        $extraEnPalabras = numberToWords($row['salario'] *0.5);
        $extraEnPalabras .= " PESOS"; // Concatenar " PESOS." al final
        $extraEnPalabras = strtoupper($extraEnPalabras); // Convertir a mayúsculas
        $mensajeSalario = ', Más una prima técnica salarial del 50% '.$extraEnPalabras.'. (' . number_format($row['salario'] * 0.5, 2, ',', '.') . ')';
        }else{
        $extraEnPalabras = numberToWords($row['salario'] *0.5);
        $extraEnPalabras .= " PESOS"; // Concatenar " PESOS." al final
        $extraEnPalabras = strtoupper($extraEnPalabras); // Convertir a mayúsculas
        $mensajeSalario = ', Más una prima técnica no salarial del 50% '.$extraEnPalabras.'. (' . number_format($row['salario'] * 0.5, 2, ',', '.') . ')';
        }
        
    }

    

    // Reemplazar los marcadores de posición con los datos de la persona
    $templateProcessor->setValue('{{mensaje_genero}}', htmlspecialchars($mensajeGenero));
    $templateProcessor->setValue('{{nombre}}', htmlspecialchars($nombreCompleto));
    $templateProcessor->setValue('{{identificacion}}', htmlspecialchars($identificacionGenero));
    $templateProcessor->setValue('{{cedula}}', formatCedula($row['cedula']));
    $templateProcessor->setValue('{{dia_vinculacion}}', htmlspecialchars($row['dia_vinculacion']));
    $templateProcessor->setValue('{{mes_vinculacion}}', htmlspecialchars($row['mes_vinculacion']));
    $templateProcessor->setValue('{{año_vinculacion}}', htmlspecialchars($row['año_vinculacion']));
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
    $templateProcessor->setValue('{{salario_letras}}', htmlspecialchars($salarioEnPalabras));
    $templateProcessor->setValue('{{salario}}','(' . number_format($row['salario'], 2, ',', '.') .')' );
    $templateProcessor->setValue('{{mensaje_salario}}', htmlspecialchars($mensajeSalario));
    

    $outputFile = 'CERTIFICADO LABORAL ' . htmlspecialchars($nombreCompleto) . '.docx';
    $templateProcessor->saveAs($outputFile);

    Settings::setPdfRendererName(Settings::PDF_RENDERER_MPDF);
    Settings::setPdfRendererPath('../../vendor/mpdf/mpdf');

    $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => [216, 356]]);
    $mpdf = IOFactory::load($outputFile, 'Word2007');
    $pdfFile = 'CERTIFICADO LABORAL ' . htmlspecialchars($nombreCompleto) . '.pdf';
    $mpdf->setDefaultFontName('Arial');
    
    $mpdf->save($pdfFile, 'PDF');

    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($pdfFile) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pdfFile));
    ob_clean();
    flush();
    readfile($pdfFile);
    unlink($pdfFile);
    unlink($outputFile);
    exit;
} else {
    echo "No se encontraron datos para esta persona.";
}

$stmt->close();
$conn->close();

?>
