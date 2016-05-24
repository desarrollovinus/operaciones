<?php
// Funciones de PDF
require('../clases/fpdf.php');
include_once '../funciones.php';

//Se define la zona horaria
date_default_timezone_set('America/Bogota');

//Definir la ruta de las fuentes
define('FPDF_FONTPATH','../fonts/');

//----------------------------------Conexión con la base de datos----------------------------------//
$link = Conectarse();

mysql_set_charset('latin1',$link);

//----------------------------------Encabezado y pié de página----------------------------------//
class PDF extends FPDF {
    function Header(){
        //Encabezado de título y logos
        $this->SetFont('arial','',20);
        $this->Image('../images/logo_backup.jpg', 15, 5, 40, NULL);
        $this->SetY(30);
        $this->Cell(0,10, utf8_decode("Partes sin atención"),0,0,'C');
        $this->Ln();
        $this->SetFont('arial','',14);
    }//Fin Header()

    //Pie de página
    function Footer(){
        //Posición: a 1 cm del final
        $this->SetY(-10);
        $this->SetFont('arial','',8);
        $this->Cell(0, 10, utf8_decode('Sistema de gestión de Operaciones - Hatovial S.A.S. - Página ') .$this->PageNo().' de {nb}',0,0,'R');
    }//Fin Footer()
}//Fin Class PDF

// Fechas y motivo de parte
$fecha_inicio = date("Y-m-d", strtotime($_POST['pri_fec']));
$fecha_final = date("Y-m-d", strtotime($_POST['seg_fec']));
$motivo_parte = $_POST['motivo_parte'];

$motivo_condicion = "";

// Si hay un motivo específico
if ($motivo_parte != "0") {
	// Se agrega la condición
	$motivo_condicion = "AND p.motivo_parte = '{$motivo_parte}'";
}

//---------------------------------- Consulta ----------------------------------//
// Consulta que lista los motivos de no atención que existan entre el rango de fechas seleccionado
$sql_motivos =
"(
	SELECT
	mi.id,
	mi.nombre
FROM
	tbl_parte AS p
INNER JOIN tbl_motivo_inasistencia AS mi ON p.id_motivo_atencion = mi.id
WHERE
	p.id_motivo_atencion IS NOT NULL
AND p.atendido = 0
AND Date_format(p.fechahora, '%Y-%m-%d') BETWEEN '{$fecha_inicio}' AND '{$fecha_final}'
{$motivo_condicion}
GROUP BY
	p.id_motivo_atencion
ORDER BY
	mi.nombre ASC
)
UNION
	(SELECT 0, 'Sin especificar')";

$rs_motivos = mysql_query($sql_motivos,$link);

//----------------------------------Creando la página----------------------------------//
//Crear nueva páginancon orientación horizontal
$pdf = new PDF('P', 'mm', 'Letter');

//Es la función que nos declara un Alias por defecto para obtener el número de páginas máximo
$pdf->AliasNbPages();
 
//Añade nueva página
$pdf->AddPage();

// $pdf->MultiCell(100,6, utf8_decode($sql_motivos),0,'C');

// Recorrido de los motivos de no atención
while($motivo = mysql_fetch_array($rs_motivos)){
	// Fuente
	$pdf->SetFont("Arial",'B',12);

	// Título del motivo
	$pdf->Cell(200,6, utf8_decode($motivo["nombre"]),1, 0, 'C', 0);
	$pdf->Ln();

	$pdf->Cell(25,6, utf8_decode('Parte'),1, 0, 'C', 0);
	$pdf->Cell(40,6, utf8_decode('Motivo'),1, 0, 'C', 0);
	$pdf->Cell(70,6, utf8_decode('Inspector'),1, 0, 'C', 0);
	$pdf->Cell(40,6, utf8_decode('Fecha'),1, 0, 'L', 0);
	$pdf->Cell(25,6, utf8_decode('Hora'),1, 0, 'L', 0);
	$pdf->Ln();

	// Consulta de los partes por cada motivo
	$sql_parte =
	"SELECT
		p.id_parte,
		p.fechahora,
		p.motivo_parte,
		CONCAT(
			u.us_nombre,
			' ',
			u.us_apellido
		) AS inspector
	FROM
		tbl_parte AS p
	INNER JOIN tbl_usuarios AS u ON p.usuario = u.id_usuario
	WHERE
		p.atendido IS NOT NULL
	AND p.atendido = 0
	AND p.id_motivo_atencion = {$motivo['id']}
	AND Date_format(p.fechahora, '%Y-%m-%d') BETWEEN '{$fecha_inicio}' AND '{$fecha_final}'
	{$motivo_condicion}
	ORDER BY
		p.id_parte DESC";

	$rs_partes = mysql_query($sql_parte,$link);

	// Recorrido de los partes
	while($parte = mysql_fetch_array($rs_partes)){
		// Fuente
		$pdf->SetFont("Arial",'',10);

		$pdf->Cell(25,6, utf8_decode($parte["id_parte"]),1, 0, 'R', 0);
		$pdf->Cell(40,6, utf8_decode($parte["motivo_parte"]),1, 0, 'L', 0);
		$pdf->Cell(70,6, utf8_decode($parte["inspector"]),1, 0, 'L', 0);
		$pdf->Cell(40,6, utf8_decode(date("Y-m-d", strtotime($parte['fechahora']))),1, 0, 'L', 0);
		$pdf->Cell(25,6, utf8_decode(date("h:i", strtotime($parte['fechahora']))),1, 0, 'L', 0);

		$pdf->Ln();
	} // while

	$pdf->Ln();
} // while

//Limpiar búferes de salida
ob_end_clean();

$pdf->Output();
?>
