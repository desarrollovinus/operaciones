<?php
date_default_timezone_set('America/Bogota');
require('../clases/fpdf.php');
include_once '../funciones.php';

//Definir la ruta de las fuentes
define('FPDF_FONTPATH','../fonts/');

//----------------------------------Conexión con la base de datos----------------------------------//
$link = Conectarse();
mysql_set_charset('latin1',$link);

//----------------------------------Consultas a la base de datos----------------------------------//
//Consulta que trae el número del parte
$id_parte = $_GET["parte"];
$sql = "SELECT * FROM tbl_parte where id_parte='$id_parte'";
$rs = mysql_query($sql,$link);
$parte = mysql_fetch_array($rs);

//Consulta que trae el inspector
$sql = "SELECT * FROM tbl_usuarios where id_usuario='".$parte['usuario']."'";
$rs = mysql_query($sql,$link);
$usuario = mysql_fetch_array($rs);

//Consulta que trae los datos generales
$consulta = mysql_query(
"SELECT * FROM tbl_cierre WHERE id_parte = ".$id_parte);
$row = mysql_fetch_array($consulta);

//----------------------------------Encabezado y pié de página----------------------------------//
class PDF extends FPDF {
   
    function Header(){
         //Consulta que trae el número del parte
        $id_parte = $_GET["parte"];
        $sql_parte = mysql_query(
        "SELECT * FROM tbl_parte where id_parte='$id_parte'");
        $parte = mysql_fetch_array($sql_parte);

        //Consulta que trae el inspector
        $sql_inspector = mysql_query(
        "SELECT * FROM tbl_usuarios where id_usuario=".$parte['usuario']);
        $inspector = mysql_fetch_array($sql_inspector);
    
        //Encabezado de título y logos
        $this->SetFont('arial','',20);
        $this->Image('../images/logo_backup.jpg', 15, 5, 53, 22);
        $this->SetXY(80, 15);
        $this->SetY(30);
        $this->Cell(0,10, utf8_decode('Informe del parte '.$_GET["parte"].' - Cierre de vía'),0,0,'L');
        $this->Ln();
        $this->SetFont('arial','',13);
        $this->Cell(0,0, utf8_decode('Inspector: ').$inspector['us_nombre']." ".$inspector['us_apellido'],0,0,'L');
        $this->Ln(4);
        $this->SetFont('arial','',10);
        $this->Cell(0,0, utf8_decode('Fecha de Impresión: ').date("d/m/Y"),0,0,'L');
        $this->Ln(4);
        $this->Cell(0,0, utf8_decode(''),1,0,'L');
        $this->Ln(4);
    }//Fin Header()

    //Pie de página
    function Footer(){
        //Posición: a 1 cm del final
        $this->SetY(-10);
        $this->SetFont('arial','',8);
        $this->Cell(0, 10, utf8_decode('Grupo Ejecutor Hatovial S.A.S - Página ') .$this->PageNo().' de {nb}',0,0,'R');
    }//Fin Footer()  
}//Fin Class PDF

//----------------------------------Creando la página----------------------------------//
//Crear nueva páginancon orientación vertical
$pdf=new PDF('P', 'mm', 'Letter');

//Es la función que nos declara un Alias por defecto para obtener el número de páginas máximo
$pdf->AliasNbPages();
 
//Añade nueva página
$pdf->AddPage();

//----------------------------------Contenido del reporte----------------------------------//
//Datos del cierre
$pdf->Ln(5);
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('DATOS DEL CIERRE DE VÍA'), 0, 0, 'L');
$pdf->Ln(10);

//Datos del cierre
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de inicio del cierre: '), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de fin del cierre: '), 0, 0, 'L');
$pdf->Ln(5);

$pdf->SetXY(80, 67);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0, $row['fechahoraini'], 0, 0, 'L');
$pdf->Ln(5);
$pdf->SetX(80);
$pdf->Cell(0,0, $row['fechahorafin'], 0, 0, 'L');
$pdf->Ln(10);

//Servicio presente
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('SERVICIOS PRESENTES EN EL CIERRE DE LA VÍA'), 0, 0, 'L');
$pdf->Ln(5);

//Se valida que en los campos haya una X
$pdf->SetFont('Arial','',10);
if($row["amb"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Ambulancia'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["agen_tran"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Agentes de tránsito'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["pol_nal"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Policía Nacional'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["def_civil"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Defensa civil'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["dir_ope"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Director operativo'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["insp_vial"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Inspector vial'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["mant"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Mantenimiento'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["grua_con"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Grúa de la concesión'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["sena"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Señalización'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["bom"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Bomberos'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["fiscalia"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Fiscalía'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["pol_car"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Policía de carreteras'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["pol_tran"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Policía de tránsito'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["res_ope"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Residente operativo'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["otros"]!=''){
    $pdf->Cell(0,0, utf8_decode('-'.$row["otros"]), 0, 0, 'L');
    $pdf->Ln(4);
}

//Información del usuario
$pdf->Ln(10);
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('DESCRIPCIÓN'), 0, 0, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(200,4, utf8_decode($row['descrip']), 0, 'L');







//Limpiar búferes de salida
ob_end_clean ();

$pdf->Output('Parte Nro '.$row['id_parte'].' - Cierre de vía','I');
?>