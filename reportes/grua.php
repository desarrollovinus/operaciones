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
$sql = "SELECT * FROM tbl_grua where id_parte='$id_parte'";
$rs = mysql_query($sql,$link);
$parte = mysql_fetch_array($rs);

//Consulta que trae el inspector
$sql = "SELECT * FROM tbl_usuarios where id_usuario='".$parte['usuario']."'";
$rs = mysql_query($sql,$link);
$usuario = mysql_fetch_array($rs);

//Consulta que trae los datos generales
$consulta = mysql_query(
"SELECT * FROM tbl_grua WHERE id_parte = ".$id_parte);
$row = mysql_fetch_array($consulta);

//Sacar la abscisa
$abscisa = trim($temp["abcisa"]);
$metros = substr($row['abcisa'], -3);
$kms = substr($row['abcisa'], 0, strlen($abscisa) - 3);
if($kms == ""){
    $kms = "0";
}
$abs =  "Km ".$kms." + ".$metros;

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
        $this->Cell(0,10, utf8_decode('Informe del parte '.$_GET["parte"].' - Grúa'),0,0,'L');
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
//Títulos Datos iniciales
$pdf->SetXY(10, 55);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,7, utf8_decode('VÍA'), 1, 0, 'C');
$pdf->Cell(45,7, utf8_decode('TRAMO'), 1, 0, 'C');
$pdf->Cell(45,7, utf8_decode('CALZADA'), 1, 0, 'C');
$pdf->Cell(45,7, utf8_decode('ABSCISA'), 1, 0, 'C');
$pdf->Ln();

//Contenido datos iniciales
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,7, $row['via'], 1, 0, 'R');//Vía
$pdf->Cell(45,7, 'Tramo '.$row['tramo'], 1, 0, 'L');//Tramo
$pdf->Cell(45,7, $row['calzada'], 1, 0, 'L');//Calzada
$pdf->Cell(45,7, $abs, 1, 0, 'R');//Abscisa
$pdf->Ln(20);

//Datos de la grúa
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('DATOS DE LA GRÚA'), 0, 0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de pedido: '), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de inicio: '), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de fin: '), 0, 0, 'L');
$pdf->Ln(5);

$pdf->SetXY(80, 92);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0, $row['h_ped'], 0, 0, 'L');//Fecha de pedido
$pdf->Ln(5);
$pdf->SetX(80);
$pdf->Cell(0,0, $row['fechahorainicio'], 0, 0, 'L');//Fecha de inicio
$pdf->Ln(5);
$pdf->SetX(80);
$pdf->Cell(0,0, $row['fechahorafin'], 0, 0, 'L');//Fecha de fin
$pdf->Ln(15);

//Información del usuario
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('INFORMACIÓN DEL VEHÍCULO'), 0, 0, 'L');
$pdf->Ln(5);

//Títulos Tabla vehiculo
$pdf->SetFont('Arial','B',9);
$pdf->Cell(35,7, utf8_decode('CONDUCTOR'), 1, 0, 'C');
$pdf->Cell(20,7, utf8_decode('CÉDULA'), 1, 0, 'C');
$pdf->Cell(20,7, utf8_decode('TELÉFONO'), 1, 0, 'C');
$pdf->Cell(14,7, utf8_decode('PLACA'), 1, 0, 'C');
$pdf->Cell(20,7, utf8_decode('COLOR'), 1, 0, 'C');
$pdf->Cell(27,7, utf8_decode('MARCA'), 1, 0, 'C');
$pdf->Cell(30,7, utf8_decode('SERVICIO'), 1, 0, 'C');
$pdf->Cell(27,7, utf8_decode('TIPO'), 1, 0, 'C');
$pdf->Ln();

//Datos de la tabla vehiculo
$pdf->SetFont('Arial','',8);
$pdf->Cell(35,5, substr(utf8_decode($row['nom_us']),0,18), 1, 0, 'L');//Nombre
$pdf->Cell(20,5, number_format($row['ced_us'],0,",","."), 1, 0, 'R');//Cedula
$pdf->Cell(20,5, $row['tel_us'], 1, 0, 'R');//Teléfono
$pdf->Cell(14,5, $row['placa_veh'], 1, 0, 'L');//Placa
$pdf->Cell(20,5, utf8_decode($row['color_veh']), 1, 0, 'L');//Color
$pdf->Cell(27,5, utf8_decode($row['marca_veh']), 1, 0, 'L');//Marca
$pdf->Cell(30,5, utf8_decode($row['serv_veh']), 1, 0, 'L');//Servicio
$pdf->Cell(27,5, utf8_decode($row['tipo_veh']), 1, 0, 'L');//Tipo
$pdf->Ln(15);

//Motivos del servicio
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Motivo del servicio: '), 0, 0, 'L');
$pdf->Ln(4);

//Se valida que en los campos haya una X
$pdf->SetFont('Arial','',10);
if($row["acc"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Accidentado'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["varado"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Varado'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["inmovilizado"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Inmovilizado'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["apoyo_mot"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Apoyo'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["otros_mot"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Otros motivos'), 0, 0, 'L');
    $pdf->Ln(4);
}
$pdf->Ln(5);

//Servicio prestado
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Servicio prestado: '), 0, 0, 'L');
$pdf->Ln(4);

//Se valida que en los campos haya una X
$pdf->SetFont('Arial','',10);
if($row["traslado"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Traslado'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["sena"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Señalización'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["apoyo_pres"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Apoyo'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["otros_pres"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Otros servicios'), 0, 0, 'L');
    $pdf->Ln(4);
}
$pdf->Ln(5);

//Otra información
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('OTRA INFORMACIÓN'), 0, 0, 'L');
$pdf->Ln(5);

//Cabecera tabla otra informacion
$pdf->SetFont('Arial','B',9);
$pdf->Cell(35,7, utf8_decode('Autoriza movimiento'), 1, 0, 'C');
$pdf->Cell(22,7, utf8_decode('En calidad de'), 1, 0, 'C');
$pdf->Cell(65,7, utf8_decode('Lugar de finalización'), 1, 0, 'C');
$pdf->Cell(20,7, utf8_decode('Tipo de grúa'), 1, 0, 'C');
$pdf->Cell(35,7, utf8_decode('Operador de grúa'), 1, 0, 'C');
$pdf->Cell(25,7, utf8_decode('Calif. Servicio'), 1, 0, 'C');
$pdf->Ln();

//Datos tabla otra información
$pdf->SetFont('Arial','',8);
$pdf->Cell(35,7, substr(utf8_decode($row['autoriza_mov']),0, 18), 1, 0, 'L');//Autoriza movimiento
$pdf->Cell(22,7, substr(utf8_decode($row['en_calidad_de']),0,12), 1, 0, 'L');//En calidad de
$pdf->Cell(65,7, substr(utf8_decode($row['lug_fin']),0,37), 1, 0, 'L');//Lugar finalización
$pdf->Cell(20,7, substr(utf8_decode($row['tipo_grua']),0,42), 1, 0, 'L');//Tipo de grúa
$pdf->Cell(35,7, substr(utf8_decode($row['oper_grua']),0,19), 1, 0, 'L');//Operador
$pdf->Cell(25,7, substr(utf8_decode(''),0,42), 1, 0, 'L');//Excelente
//Calificación servicio
if($row["excelente"]=='X'){
    $pdf->SetX(187);
    $pdf->Cell(25,7, substr(utf8_decode('Excelente'),0,42), 0, 0, 'L');//Excelente
}
if($row["bueno"]=='X'){
    $pdf->SetX(187);
    $pdf->Cell(25,7, substr(utf8_decode('Bueno'),0,42), 0, 0, 'L');//Bueno
}
if($row["regular"]=='X'){
    $pdf->SetX(187);
    $pdf->Cell(25,7, substr(utf8_decode('Regular'),0,42), 0, 0, 'L');//Regular
}
if($row["malo"]=='X'){
    $pdf->SetX(187);
    $pdf->Cell(25,7, substr(utf8_decode('Malo'),0,42), 0, 0, 'L');//Malo
}
$pdf->Ln(10);

//Descripcion
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('DESCRIPCIÓN'), 0, 0, 'L');
$pdf->Ln(5);

//Descripción
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(200,4, utf8_decode($row['desc_grua']), 0, 'L'); 

//Limpiar búferes de salida
ob_end_clean ();

$pdf->Output('Parte Nro '.$row['id_parte'].' - Grúa','I');
?>
