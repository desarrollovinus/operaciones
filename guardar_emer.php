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
$derra_sust=$_POST['derra_sust'];
$per_banca=$_POST['per_banca'];
$derr_via=$_POST['derr_via'];
$fuga_gas=$_POST['fuga_gas'];
$pro_orden=$_POST['pro_orden'];
$cai_puente=$_POST['cai_puente'];
$des_quebrada=$_POST['des_quebrada'];
$inundacion=$_POST['inundacion'];
$incendio=$_POST['incendio'];
$otros_em=$_POST['otros_em'];
$desc_eme=$_POST['desc_eme'];
$h_ini_emer=$_POST['h_ini_emer'];
$h_fin_emer=$_POST['h_fin_emer'];

$nuevo_regi="insert into tbl_parte values ('','','".$fechahora."','Emergencia','0','0','0','".$ced."')";
$resultado1= mysql_query($nuevo_regi,$link);

//Se lee el registro que se acaba de insertar
$consulta="SELECT * FROM tbl_parte where fechahora='$fechahora'";
$resul= mysql_query($consulta,$link);
$row = mysql_fetch_array($resul);
$id_parte=$row[id_parte];
$_SESSION[id_parte]=$id_parte;


 $nuevo_reg="insert into tbl_emergencias values ('','".$id_parte."','".$via."','".$tramo."','".$calzada."','".$abcisa."','".$h_ini_emer."','".$h_fin_emer."','".$derra_sust."','".$per_banca."','".$pro_orden."','".$des_quebrada."','".$incendio."','".$derr_via."','".$fuga_gas."','".$cai_puente."','".$inundacion."','".$otros_em."','".$desc_eme."')";
 $res= mysql_query($nuevo_reg,$link);

 $cons="select * from tbl_parte where id_parte=$id_parte";
 $query= mysql_query($cons,$link);
 $vect_in = mysql_fetch_assoc($query);

 if($vect_in['motivo_parte']==''){

 $crea_parte="update tbl_parte set motivo_parte='Emergencia' where id_parte=$id_parte ";
 $result= mysql_query($crea_parte,$link);
 }



?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">
