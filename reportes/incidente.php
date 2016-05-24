
<?php
require('../clases/fpdf.php');
include_once '../funciones.php';

//Definir la ruta de las fuentes
define('FPDF_FONTPATH','../fonts/');

//----------------------------------Conexión con la base de datos----------------------------------//
$link = Conectarse();
mysql_set_charset('latin1',$link);

//Se reciben las variables
$id_parte = $_GET["parte"];

//----------------------------------Encabezado y pié de página----------------------------------//
class PDF extends FPDF {
   
    function Header(){
        //Encabezado de título y logos
        $this->SetFont('arial','',20);
        $this->Image('../images/logo_backup.jpg', 15, 5, 53, 22);
        $this->SetXY(15, 35);
        $this->Cell(0,0, utf8_decode('Informe del parte '.$_GET["parte"]),0,0,'L');
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
//Crear nueva páginancon orientación horizontal
$pdf=new PDF('P', 'mm', 'Letter');

//Es la función que nos declara un Alias por defecto para obtener el número de páginas máximo
$pdf->AliasNbPages();
 
//Añade nueva página
$pdf->AddPage();
            
//Limpiar búferes de salida
ob_end_clean ();

$pdf->Output();
?>
