<?php
session_start();
include 'funciones.php';
$link=Conectarse();
$ced=$_SESSION["ced"];

$fechahora=$_POST['fecha'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];
$desc_otros=$_POST['desc_otros'];
$h_ini_otros=$_POST['h_ini_otros'];
$h_fin_otros=$_POST['h_fin_otros'];


$cons="select * from tbl_parte where id_parte=$id_parte";
 $query= mysql_query($cons,$link);
 $vect_in = mysql_fetch_assoc($query);

 if($vect_in['motivo_parte']==''){

 $crea_parte="update tbl_parte set motivo_parte='Otros', usuario='$ced' where id_parte=$id_parte ";
 $result= mysql_query($crea_parte,$link);
 }

$nuevo_regi="insert into tbl_parte values ('','','".$fechahora."','Otros','0','0','0','".$ced."')";
$resultado1= mysql_query($nuevo_regi,$link);

//Se lee el registro que se acaba de insertar
$consulta="SELECT * FROM tbl_parte where fechahora='$fechahora'";
$resul= mysql_query($consulta,$link);
$row = mysql_fetch_array($resul);
$id_parte=$row[id_parte];
$_SESSION[id_parte]=$id_parte;
$fecha=$row[fechahora];


 $nuevo_reg="insert into tbl_otros values ('','".$id_parte."','".$via."','".$tramo."','".$calzada."','".$abcisa."','".$h_ini_otros."','".$h_fin_otros."','".$desc_otros."')";
 $res= mysql_query($nuevo_reg,$link);



?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">