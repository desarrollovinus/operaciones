<?php
// error_reporting(-1);
$fecha_inicial=$_GET['f_ini'];
$fecha_final=$_GET['f_fin'];

session_start();

include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';

include("funciones.php");
$link=Conectarse();

function configuracion($hoja){
	//Definicion de las configuraciones por defecto en todo el libro
	$hoja->getDefaultStyle()->getFont()->setName('Arial'); //Tipo de letra
	$hoja->getDefaultStyle()->getFont()->setSize(8); //Tamanio
	$hoja->getDefaultStyle()->getAlignment()->setWrapText(true);//Ajuste de texto
	$hoja->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);// Alineacion centrada

	//Se establece la configuracion de la pagina
	$hoja->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //Orientacion horizontal
	$hoja->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //Tamano oficio
	$hoja->getPageSetup()->setScale(100);

	//Se indica el rango de filas que se van a repetir en el momento de imprimir. (Encabezado del reporte)
	$hoja->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3);

	//Logo ANI
	$objDrawing2 = new PHPExcel_Worksheet_Drawing();
	$objDrawing2->setName('Logo ANI');
	$objDrawing2->setDescription('Logo de uso exclusivo de ANI');
	$objDrawing2->setPath('./images/logo_ani.jpg');
	$objDrawing2->setCoordinates('A1');
	$objDrawing2->setWidth(85);
	$objDrawing2->setOffsetX(70);
	$objDrawing2->setOffsetY(4);
	$objDrawing2->setWorksheet($hoja);

	//Logo Vinus
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('Logo Vinus');
	$objDrawing->setDescription('Logo de uso exclusivo de Vinus');
	$objDrawing->setPath('./images/logo_vinus.jpg');
	$objDrawing->setCoordinates('AK1');
	$objDrawing->setHeight(65);
	$objDrawing->setOffsetX(22);
	$objDrawing->setOffsetY(2);
	$objDrawing->getShadow()->setDirection(160);
	$objDrawing->setWorksheet($hoja);

	// Celdas a combinar
	$hoja->mergeCells('A1:D3');
	$hoja->mergeCells('E1:AJ1');
	$hoja->mergeCells('E2:AJ2');
	$hoja->mergeCells('E3:AJ3');
	$hoja->mergeCells('AK1:AN3');
	$hoja->mergeCells('AO1:AQ1');
	$hoja->mergeCells('AO2:AQ2');
	$hoja->mergeCells('AO3:AQ3');
	$hoja->mergeCells('AR1:AS1');
	$hoja->mergeCells('AR2:AS2');
	$hoja->mergeCells('AR3:AS3');

	// Definicion de la altura de las celdas
	$hoja->getRowDimension(1)->setRowHeight(20);
	$hoja->getRowDimension(2)->setRowHeight(20);
	$hoja->getRowDimension(3)->setRowHeight(20);
	$hoja->getRowDimension(4)->setRowHeight(5);

	// Encabezados
	$hoja->setCellValue('AO1', 'Código');
	$hoja->setCellValue('AO2', 'Versión');
	$hoja->setCellValue('AO3', 'Creado');
	$hoja->setCellValue('AR1', '');
	$hoja->setCellValue('AR2', 'V1.00');
	$hoja->setCellValue('AR3', '05/06/2016');
	$hoja->setCellValue('E1', 'CONCESIÓN VÍAS DEL NUS - VINUS');
	$hoja->setCellValue('E2', 'INFORME GERENCIAL');
	







	// Pié de página
	// $hoja->getHeaderFooterimplicadossetOddFooter('&L&B' .$objPHPExcel->getActiveSheet->getProperties()->getTitle() . '&RPágina &P de &N');
}



// Create new PHPExcel object
// echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

//Se establece la configuracion general
$objPHPExcel->getProperties()
	->setCreator("John Arley Cano Salinas - Concesión Vías del NUS S.A.S.")
	->setLastModifiedBy("John Arley Cano Salinas")
	->setTitle("Sistema de Gestión de Operaciones - Generado el ".formatear_fecha(date("Y-m-d")).' - '.date('h:i A'))
	->setSubject("Informe gerencial mensual")
	->setDescription("Formato Informe gerencial mensual")
	->setKeywords("informe mensual gerencial operaciones vinus")		
    ->setCategory("Reporte");

/*******************************************************
 *********************** Estilos ***********************
 *******************************************************/
$centrado = array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) ); // Alineación centrada
$bordes = array( 'borders' => array( 'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array( 'argb' => '000000' ) ), ), );
$borde_negrita_externo = array( 'borders' => array( 'outline' => array( 'style' => PHPExcel_Style_Border::BORDER_THICK, 'color' => array('argb' => '000000'), ), ), );
$tamanio8 = array ( 'font' => array( 'size' => 8 ) );
$negrita = array( 'font' => array( 'bold' => true ) );

/*******************************************************************************
**************************** Hoja de accidentalidad ****************************
********************************************************************************/
$accidentalidad = $objPHPExcel->getActiveSheet();
$accidentalidad = $objPHPExcel->getActiveSheet()->setTitle("Accidentalidad"); // Título de la hoja

$sql_accidentes="Select * from tbl_accidente where fec_con between '{$fecha_inicial}' and '{$fecha_final}' order by fec_con";
$accidentes = mysql_query($sql_accidentes,$link);

// Se declaran las configuraciones de la hoja activa
configuracion($accidentalidad);

// Encabezados
$accidentalidad->setCellValue('E3', "REGISTRO DE ATENCION DE ACCIDENTES DEL ".strtoupper(formatear_fecha($fecha_inicial))." AL ".strtoupper(formatear_fecha($fecha_final)));

// Arreglo con encabezados
$titulos = array(
	"",
	"CONSECUTIVO",
	"PARTE",
	"FECHA",
	"HORA",
	"CÓDIGO VÍA",
	"CÓDIGO TRAMO",
	"CALZADA",
	"ABSCISA",
	"VEHÍCULOS INVOLUCRADOS",
	"CONOCIMIENTO",
	"ATENCIÓN",
	"FINALIZACIÓN",
	"CHOQUE CONTRA VEHÍCULO",
	"CHOQUE CONTRA OBJETO FIJO",
	"ATROPELLO",
	"VOLCAMIENTO",
	"CAÍDA DE OCUPANTE",
	"CHOQUE CONTRA SEMOVIENTE",
	"OTROS",
	"HERIDOS",
	"VÍCTIMAS FATALES",
	"EXCESO DE VELOCIDAD",
	"IMPRUDENCIA DE PEATÓN",
	"IMPRUDENCIA DE CONDUCTOR",
	"FALTA DE PRECAUCIÓN",
	"EMBRIAGUEZ",
	"FALLAS MECÁNICAS",
	"NO MANTENER DISTANCIA",
	"SEMOVIENTE EN LA VÍA",
	"ADELANTAR",
	"OTROS",
	"MOTOCICLETA (CONDUCTOR)",
	"MOTOCICLETA (PARRILLERO)",
	"VEHÍCULO (CONDUCTOR)",
	"VEHÍCULO (PASAJEROS)",
	"PEATÓN",
	"CICLISTA",
	"MOTOCICLETA (CONDUCTOR)",
	"MOTOCICLETA (PARRILLERO)",
	"VEHÍCULO (CONDUCTOR)",
	"VEHÍCULO (PASAJEROS)",
	"PEATÓN",
	"CICLISTA",
	"TIEMPO DE REACCIÓN",
	"TIEMPO DE ASISTENCIA",
);
	
// Declaración de fila y columna inicial
$columna = "A";
$fila = 4;
$fila++;

// Celdas a combinar
$accidentalidad->mergeCells("B{$fila}:I{$fila}");
$accidentalidad->mergeCells("J{$fila}:L{$fila}");
$accidentalidad->mergeCells("M{$fila}:S{$fila}");
$accidentalidad->mergeCells("T{$fila}:U{$fila}");
$accidentalidad->mergeCells("V{$fila}:AE{$fila}");
$accidentalidad->mergeCells("AF{$fila}:AK{$fila}");
$accidentalidad->mergeCells("AL{$fila}:AQ{$fila}");
$accidentalidad->mergeCells("AR{$fila}:AS{$fila}");

// Definicion de la altura de las filas
$accidentalidad->getRowDimension($fila)->setRowHeight(30);

// Encabezados
$accidentalidad->setCellValue("B{$fila}", "DATOS DEL ACCIDENTE");
$accidentalidad->setCellValue("J{$fila}", "HORAS");
$accidentalidad->setCellValue("M{$fila}", "TIPO DE ACCIDENTE");
$accidentalidad->setCellValue("V{$fila}", "HIPÓTESIS");
$accidentalidad->setCellValue("AF{$fila}", "HERIDOS");
$accidentalidad->setCellValue("AL{$fila}", "VÍCTIMAS FATALES");
$accidentalidad->setCellValue("AR{$fila}", "TIEMPOS DE RESPUESTA");

$fila_titulos = $fila + 1;

// Recorrido de columnas
for ($i=1; $i <= 45 ; $i++) {
	// Tamaño de columnas
	$accidentalidad->getColumnDimension($columna)->setWidth(3.5);

	// Si hay valor en el arreglo para la columna
	if (isset($titulos[$i])) {
		// Encabezado
		$accidentalidad->setCellValue("{$columna}{$fila_titulos}", $titulos["$i"]);
	}



	$columna++;
} // for

// Definición de altura de las filas
$accidentalidad->getRowDimension($fila_titulos)->setRowHeight(140);

// Estilos
$objPHPExcel->getActiveSheet()->getStyle("A1:AS3")->applyFromArray($bordes);
$objPHPExcel->getActiveSheet()->getStyle("A1:{$columna}{$fila_titulos}")->applyFromArray($centrado);


// AUmento de fila
$fila = $fila_titulos + 1;

$columna = "A";

$consecutivo = 1;

// Declaración de contadores
$ch_contra_veh = 0;
$ch_contra_obj = 0;
$atropello = 0;
$volcamiento = 0;
$caida_del_ocu = 0;
$ch_contra_sem = 0;
$otros_acc = 0;
$exc_vel = 0;
$imp_peat = 0;
$imp_con = 0;
$falta_pre = 0;
$embri = 0;
$fallas = 0;
$no_dis = 0;
$sem_via = 0;
$ade_proh = 0;
$hip_otros = 0;

while($accidente = mysql_fetch_array($accidentes)) {
	// Datos del accidente
	$accidentalidad->setCellValue("A{$fila}", $consecutivo);
	$accidentalidad->setCellValue("B{$fila}", $accidente["id_parte"]);
	$accidentalidad->setCellValue("C{$fila}", date("d-m-Y", strtotime($accidente["fec_pro"])));
	$accidentalidad->setCellValue("D{$fila}", date("h:i", strtotime($accidente["fec_pro"])));
	$accidentalidad->setCellValue("E{$fila}", $accidente["via"]);
	$accidentalidad->setCellValue("F{$fila}", $accidente["tramo"]);
	$accidentalidad->setCellValue("G{$fila}", $accidente["calzada"]);
	$accidentalidad->setCellValue("H{$fila}", $accidente["abcisa"]);
	$accidentalidad->setCellValue("I{$fila}", numero_involucrados($accidente["id_parte"]));

	// Horas
	$accidentalidad->setCellValue("J{$fila}", date("h:i", strtotime($accidente["fec_con"])));
	$accidentalidad->setCellValue("K{$fila}", date("h:i", strtotime($accidente["fechahora_ini"])));
	$accidentalidad->setCellValue("L{$fila}", date("h:i", strtotime($accidente["fechahora_fin"])));

	// Tipo de accidente
	if($accidente["ch_contra_veh"] == "X"){$ch_contra_veh++;}
	if($accidente["ch_contra_obj"] == "X"){$ch_contra_obj++;}
	if($accidente["atropello"] == "X"){$atropello++;}
	if($accidente["volcamiento"] == "X"){$volcamiento++;}
	if($accidente["caida_del_ocu"] == "X"){$caida_del_ocu++;}
	if($accidente["ch_contra_sem"] == "X"){$ch_contra_sem++;}
	if(strlen($accidente["hip_otros"]) > 1){$otros_acc++;}
	
	$accidentalidad->setCellValue("M{$fila}", $accidente["ch_contra_veh"]);
	$accidentalidad->setCellValue("N{$fila}", $accidente["ch_contra_obj"]);
	$accidentalidad->setCellValue("O{$fila}", $accidente["atropello"]);
	$accidentalidad->setCellValue("P{$fila}", $accidente["volcamiento"]);
	$accidentalidad->setCellValue("Q{$fila}", $accidente["caida_del_ocu"]);
	$accidentalidad->setCellValue("R{$fila}", $accidente["ch_contra_sem"]);
	if(strlen($accidente["otros_acc"]) > 1 ) { $accidentalidad->setCellValue("S{$fila}", "X");}

	// Heridos y víctimas fatales
	$accidentalidad->setCellValue("T{$fila}", numero_heridos($accidente["id_parte"]));
	$accidentalidad->setCellValue("U{$fila}", numero_victimas($accidente["id_parte"]));
	
	// Hipótesis
	if($accidente["exc_vel"] == "X"){$exc_vel++;}
	if($accidente["imp_peat"] == "X"){$imp_peat++;}
	if($accidente["imp_con"] == "X"){$imp_con++;}
	if($accidente["falta_pre"] == "X"){$falta_pre++;}
	if($accidente["embri"] == "X"){$embri++;}
	if($accidente["fallas"] == "X"){$fallas++;}
	if($accidente["no_dis"] == "X"){$no_dis++;}
	if($accidente["sem_via"] == "X"){$sem_via++;}
	if($accidente["ade_proh"] == "X"){$ade_proh++;}
	if(strlen($accidente["hip_otros"]) > 1 ) { $hip_otros++;}


	$accidentalidad->setCellValue("V{$fila}", $accidente["exc_vel"]);
	$accidentalidad->setCellValue("W{$fila}", $accidente["imp_peat"]);
	$accidentalidad->setCellValue("X{$fila}", $accidente["imp_con"]);
	$accidentalidad->setCellValue("Y{$fila}", $accidente["falta_pre"]);
	$accidentalidad->setCellValue("Z{$fila}", $accidente["embri"]);
	$accidentalidad->setCellValue("AA{$fila}", $accidente["fallas"]);
	$accidentalidad->setCellValue("AB{$fila}", $accidente["no_dis"]);
	$accidentalidad->setCellValue("AC{$fila}", $accidente["sem_via"]);
	$accidentalidad->setCellValue("AD{$fila}", $accidente["ade_proh"]);
	if(strlen($accidente["hip_otros"]) > 1 ) { $accidentalidad->setCellValue("AE{$fila}", "X");}

	// Heridos
	$accidentalidad->setCellValue("AF{$fila}", numero_heridos_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AG{$fila}", numero_heridos_parrillero_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AH{$fila}", numero_heridos_conductor($accidente["id_parte"]));
	$accidentalidad->setCellValue("AI{$fila}", numero_heridos_pasajero($accidente["id_parte"]));
	$accidentalidad->setCellValue("AJ{$fila}", numero_heridos_peaton($accidente["id_parte"]));
	$accidentalidad->setCellValue("AK{$fila}", numero_heridos_ciclista($accidente["id_parte"]));

	// Víctimas fatales
	$accidentalidad->setCellValue("AL{$fila}", numero_victimas_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AM{$fila}", numero_victimas_parrillero_moto($accidente["id_parte"]));
	$accidentalidad->setCellValue("AN{$fila}", numero_victimas_conductor($accidente["id_parte"]));
	$accidentalidad->setCellValue("AO{$fila}", numero_victimas_pasajero($accidente["id_parte"]));
	$accidentalidad->setCellValue("AP{$fila}", numero_victimas_peaton($accidente["id_parte"]));
	$accidentalidad->setCellValue("AQ{$fila}", numero_victimas_ciclista($accidente["id_parte"]));

	// Tiempos de respuesta
	$accidentalidad->setCellValue("AR{$fila}", "=MINUTE(K{$fila}-J{$fila})");
	$accidentalidad->setCellValue("AS{$fila}", "=MINUTE(L{$fila}-K{$fila})");





	
$consecutivo++;
	$fila++;
} // while

$fila_suma_inicial = $fila_titulos+1;
$fila_suma_final = $fila-1;

// Celdas a combinar
$accidentalidad->mergeCells("A{$fila}:l{$fila}");


// Totales
$objPHPExcel->getActiveSheet()->setCellValue("A{$fila}", "TOTALES");

// Tipo de accidente
$objPHPExcel->getActiveSheet()->setCellValue("M{$fila}", $ch_contra_veh);
$objPHPExcel->getActiveSheet()->setCellValue("N{$fila}", $ch_contra_obj);
$objPHPExcel->getActiveSheet()->setCellValue("O{$fila}", $atropello);
$objPHPExcel->getActiveSheet()->setCellValue("P{$fila}", $volcamiento);
$objPHPExcel->getActiveSheet()->setCellValue("Q{$fila}", $caida_del_ocu);
$objPHPExcel->getActiveSheet()->setCellValue("R{$fila}", $ch_contra_sem);
$objPHPExcel->getActiveSheet()->setCellValue("S{$fila}", $otros_acc);

// Heridos y víctimas fatales
$objPHPExcel->getActiveSheet()->setCellValue("T{$fila}", "=SUM(T{$fila_suma_inicial}:T{$fila_suma_final})");
$objPHPExcel->getActiveSheet()->setCellValue("U{$fila}", "=SUM(U{$fila_suma_inicial}:U{$fila_suma_final})");

// Hipótesis
$objPHPExcel->getActiveSheet()->setCellValue("V{$fila}", $exc_vel);
$objPHPExcel->getActiveSheet()->setCellValue("W{$fila}", $imp_peat);
$objPHPExcel->getActiveSheet()->setCellValue("X{$fila}", $imp_con);
$objPHPExcel->getActiveSheet()->setCellValue("Y{$fila}", $falta_pre);
$objPHPExcel->getActiveSheet()->setCellValue("Z{$fila}", $embri);
$objPHPExcel->getActiveSheet()->setCellValue("AA{$fila}", $fallas);
$objPHPExcel->getActiveSheet()->setCellValue("AB{$fila}", $no_dis);
$objPHPExcel->getActiveSheet()->setCellValue("AC{$fila}", $sem_via);
$objPHPExcel->getActiveSheet()->setCellValue("AD{$fila}", $ade_proh);
$objPHPExcel->getActiveSheet()->setCellValue("AE{$fila}", $hip_otros);

// Columna
$columna = "AF";

// Recorrido para ahorrar columnas
for ($i=1; $i <= 12; $i++) { 
	// Heridos y víctimas fatales motocicletaqs, vehículos, peatones y ciclistas
	$objPHPExcel->getActiveSheet()->setCellValue("{$columna}{$fila}", "=SUM({$columna}{$fila_suma_inicial}:{$columna}{$fila_suma_final})");
	
	// Aumento de columna
	$columna++;
} // for


// Totales
// $accidentalidad->setCellValue("A15", "=COUNTIFS(M{$fila_titulos}:M{$fila};'X')");


// Estilos
$objPHPExcel->getActiveSheet()->getStyle("A5:AS{$fila}")->applyFromArray($bordes);
$objPHPExcel->getActiveSheet()->getStyle("A{$fila}:AS{$fila}")->applyFromArray($negrita);



// Tamaños de ciertas columnas
$accidentalidad->getColumnDimension("B")->setWidth(7);
$accidentalidad->getColumnDimension("C")->setWidth(13);
$accidentalidad->getColumnDimension("D")->setWidth(7);
$accidentalidad->getColumnDimension("E")->setWidth(7);
$accidentalidad->getColumnDimension("H")->setWidth(7);
$accidentalidad->getColumnDimension("J")->setWidth(7);
$accidentalidad->getColumnDimension("K")->setWidth(7);
$accidentalidad->getColumnDimension("L")->setWidth(7);
$accidentalidad->getColumnDimension("AR")->setWidth(8);
$accidentalidad->getColumnDimension("AS")->setWidth(8);

// Estilos
$objPHPExcel->getActiveSheet()->getStyle("A6:AS6")->getAlignment()->setTextRotation(90); // Rotar el texto
$objPHPExcel->getActiveSheet()->getStyle("A6:AS6")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM); // Alineación



// Fila de inicio
$fila = 6;






/********************************************************************************
****************************** Hoja de incidencias ******************************
*********************************************************************************/
$incidencias = $objPHPExcel->createSheet(); //Nueva hoja
$incidencias->setTitle("Incidencias");//Titulo de la hoja

// Se declaran las configuraciones de la hoja activa
configuracion($incidencias);






/********************************************************************************
*********************************** Implicados ***********************************
*********************************************************************************/
$implicados = $objPHPExcel->createSheet(); //Nueva hoja
$implicados->setTitle("Implicados");//Titulo de la hoja

// Se declaran las configuraciones de la hoja activa
configuracion($implicados);






// /**********************************************************************************
// ********************************** Grúa planchón **********************************
// ***********************************************************************************/
// $hoja = $objPHPExcel->createSheet(); //Nueva hoja
// $hoja->setTitle("Grúa planchón");//Titulo de la hoja

// // Se declaran las configuraciones de la hoja activa
// configuracion($objPHPExcel);











/*********************************************************************************
*********************************** Grúa pluma ***********************************
**********************************************************************************/
$pluma = $objPHPExcel->createSheet(); //Nueva hoja
$pluma->setTitle("Grúa pluma");//Titulo de la hoja

// Se declaran las configuraciones de la hoja activa
configuracion($pluma);









/*********************************************************************************
********************************** Señalización **********************************
**********************************************************************************/
$planchon = $objPHPExcel->createSheet(); //Nueva hoja
$planchon->setTitle("Señalización");//Titulo de la hoja

// Se declaran las configuraciones de la hoja activa
configuracion($planchon);















//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename='informe.xlsx'");

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>