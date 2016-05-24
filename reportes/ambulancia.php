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
"SELECT * FROM tbl_ambulancia WHERE id_parte = ".$id_parte);
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
        $this->Cell(0,10, utf8_decode('Informe del parte '.$_GET["parte"].' - Ambulancia'),0,0,'L');
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

//Datos de la ambulancia
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('DATOS DE LA AMBULANCIA'), 0, 0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de pedido: '), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de llegada: '), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de atención: '), 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(0,0, utf8_decode('Fecha y hora de de recepción: '), 0, 0, 'L');

$pdf->SetXY(80, 92);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0, $row['h_ped'], 0, 0, 'L');
$pdf->Ln(5);
$pdf->SetX(80);
$pdf->Cell(0,0, $row['fechahorallegada'], 0, 0, 'L');
$pdf->Ln(5);
$pdf->SetX(80);
$pdf->Cell(0,0, $row['fechahoraatencion'], 0, 0, 'L');
$pdf->Ln(5);
$pdf->SetX(80);
$pdf->Cell(0,0, $row['fechahorarecepcion'], 0, 0, 'L');
$pdf->Ln(15);

//Información del usuario
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('INFORMACIÓN DEL USUARIO'), 0, 0, 'L');
$pdf->Ln(5);

//Títulos Tabla usuario
$pdf->SetFont('Arial','B',9);
$pdf->Cell(35,7, utf8_decode('NOMBRE'), 1, 0, 'C');
$pdf->Cell(20,7, utf8_decode('CÉDULA'), 1, 0, 'C');
$pdf->Cell(20,7, utf8_decode('TELÉFONO'), 1, 0, 'C');
$pdf->Cell(14,7, utf8_decode('PLACA'), 1, 0, 'C');
$pdf->Cell(27,7, utf8_decode('DIRECCIÓN'), 1, 0, 'C');
$pdf->Cell(27,7, utf8_decode('ASEGUADORA'), 1, 0, 'C');
$pdf->Cell(30,7, utf8_decode('ACOMPAÑANTE'), 1, 0, 'C');
$pdf->Cell(20,7, utf8_decode('TELÉFONO'), 1, 0, 'C');
$pdf->Ln();

//Datos de la tabla usuario
$pdf->SetFont('Arial','',8);
$pdf->Cell(35,5, substr(utf8_decode($row['nom_us']),0,18), 1, 0, 'L');//Nombre
$pdf->Cell(20,5, substr($row['ced_us'], 0, 10), 1, 0, 'L');//Cedula
$pdf->Cell(20,5, $row['tel_us'], 1, 0, 'R');//Teléfono
$pdf->Cell(14,5, substr($row['placa_veh'], 0, 7), 1, 0, 'L');//Placa
$pdf->Cell(27,5, substr(utf8_decode($row['dir_us']),0,13), 1, 0, 'L');//Direccion
$pdf->Cell(27,5, substr(utf8_decode($row['aseguradora']),0,14), 1, 0, 'L');//Aseguradora
$pdf->Cell(30,5, substr(utf8_decode($row['nom_acom']),0,15), 1, 0, 'L');//Acompañante
$pdf->Cell(20,5, substr(utf8_decode($row['tel_acom']),0,10), 1, 0, 'L');//Teléfono acompañante
$pdf->Ln(15);

//Información del usuario
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Causa externa que origina la atención: '), 0, 0, 'L');
$pdf->Ln(4);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0, $row['causa_ext'], 0, 0, 'L');
$pdf->Ln(10);

//Antecedentes personales
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Antecedentes personales:'), 0, 0, 'L');
$pdf->Ln(4);

//Se valida que en los campos haya una X
$pdf->SetFont('Arial','',10);
if($row["alergias"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Alergias'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["patologias"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Patologías'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["medicacion_ant"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Medicación'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["liq_alim"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Líquidos y alimentos'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["liq_alim"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Líquidos y alimentos'), 0, 0, 'L');
    $pdf->Ln(4);
}

//Examen Físico
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Examen Físico:'), 0, 0, 'L');
$pdf->Ln(4);

$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0, utf8_decode('Frecuencia cardíaca:         ').$row['frec_card'], 0, 0, 'L');
$pdf->Ln(4);
$pdf->Cell(0,0, utf8_decode('Frecuencia respiratoria:     ').$row['frec_resp'], 0, 0, 'L');
$pdf->Ln(4);
$pdf->Cell(0,0, utf8_decode('Presión arterial:                 ').$row['presion'], 0, 0, 'L');
$pdf->Ln(4);
$pdf->Cell(0,0, utf8_decode('Temperatura:                       ').$row['temp'], 0, 0, 'L');
$pdf->Ln(4);

//Procedimientos
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('Procedimientos:'), 0, 0, 'L');
$pdf->Ln(4);

//Se valida que en los campos haya una X
$pdf->SetFont('Arial','',10);
if($row["oxig"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Oxigenación'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["aspiracion"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Aspiración'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["rccp"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Reanimación cardio cerebro pulmonar (RCCP)'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["monitoreo"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Monitoreo'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["inmov"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Inmovilización'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["apoyo_psic"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Apoyo psicológico'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["liquidos"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Líquidos'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["medicacion_proc"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Medicación'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["ventilacion"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Ventilación'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["intubacion"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Intubación'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["desfibrilacion"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Desfibrilación'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["vendaje"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Vendaje'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["collar_cervical"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Collar cervical'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["asepsia"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Asepsia'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["otros_proc"]!=''){
    $pdf->Cell(0,0, utf8_decode('-'.$row['otros_proc']), 0, 0, 'L');
    $pdf->Ln(4);
}

//Descripción de hallazgos
$pdf->Ln(10);
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('DESCRIPCIÓN DE HALLAZGOS'), 0, 0, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(200,4, utf8_decode($row['des_hallazgos']), 0, 'L');

//Diagnóstico
$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0, utf8_decode('DIAGNÓSTICO'), 0, 0, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(200,4, utf8_decode($row['diagnostico']), 0, 'L'); 

//Hospital de traslado
$pdf->Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('HOSPITAL O CLÍNICA DE TRASLADO'), 0, 0, 'L');
$pdf->Ln(5);

//Se valida que en los campos haya una X
$pdf->SetFont('Arial','',10);
if($row["mfs"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Hospital Marco Fidel Suárez - Niquía'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["smc"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Hospital Santa Margarita - Copacabana'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["srg"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Hospital San Rafael - Girardota'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["svpb"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Hospital San Vicente de Paúl - Barbosa'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["febdm"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Hospital Francisco Eladio Barrera - Donmatías'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["cnvn"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Clínica del Norte del Valle del Aburrá - Niquía'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["clinica_hosp"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-'.$row["clinica_hosp"]), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["stb"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Salud Total - Bello'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["otc"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Otro centro asistencial'), 0, 0, 'L');
    $pdf->Ln(4);
}
if($row["stb"]=='X'){
    $pdf->Cell(0,0, utf8_decode('-Sin traslado'), 0, 0, 'L');
    $pdf->Ln(4);
}

//Otra información
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0, utf8_decode('OTRA INFORMACIÓN'), 0, 0, 'L');
$pdf->Ln(5);

//Cabecera tabla otra información
$pdf->SetFont('Arial','B',9);
$pdf->Cell(35,7, utf8_decode('Operador Ambulancia'), 1, 0, 'C');
$pdf->Cell(35,7, utf8_decode('Tripulante auxiliar'), 1, 0, 'C');
$pdf->Cell(30,7, utf8_decode('Ambulancia No.'), 1, 0, 'C');
$pdf->Cell(30,7, utf8_decode('EPS'), 1, 0, 'C');
$pdf->Cell(35,7, utf8_decode('Estado de Entrega'), 1, 0, 'C');
$pdf->Cell(35,7, utf8_decode('Médico que recibe'), 1, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Arial','',8);
$pdf->Cell(35,7, utf8_decode($row['oper_amb']), 1, 0, 'L');//Operador ambulancia
$pdf->Cell(35,7, utf8_decode($row['aux_amb']), 1, 0, 'L');//Tripulante Auxiliar
$pdf->Cell(30,7, utf8_decode($row['num_amb']), 1, 0, 'R');//Número ambulancia
$pdf->Cell(30,7, substr(utf8_decode($row['nom_eps']), 0, 19), 1, 0, 'L');//EPS
$pdf->Cell(35,7, utf8_decode($row['estado_ent']), 1, 0, 'L');//Estado de entrega
$pdf->Cell(35,7, substr(utf8_decode($row['medico']),0, 19), 1, 0, 'L');//Médico
  
//Limpiar búferes de salida
ob_end_clean ();

$pdf->Output('Parte Nro '.$row['id_parte'].' - Ambulancia','I');
?>