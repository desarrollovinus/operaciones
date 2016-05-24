<?php
session_start();
include 'funciones.php';
$link=Conectarse();
$ced=$_SESSION["ced"];


$fechahora=$_POST['fecha'];
$id_parte=$_POST['id_parte'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];
$nom_inv=$_POST['nom_inv'];
$color_veh=$_POST['color_veh'];
$ced_inv=$_POST['ced_inv'];
$marca_veh=$_POST['marca_veh'];
$tel_inv=$_POST['tel_inv'];
$servicio_veh=$_POST['servicio_veh'];
$placa_veh=$_POST['placa_veh'];
$tipo_veh=$_POST['tipo_veh'];
$antendido=$_POST['atendido'];
$motivo_atencion=$_POST['motivo_atencion'];

            //Campos no utulizados pero con datos en B.D
            $acc_trab=$_POST['acc_trab'];
            $escom_via=$_POST['escom_via'];
            $per_muerta=$_POST['per_muerta'];
            $obs_via=$_POST['obs_via'];
            $pri_aux=$_POST['pri_aux'];
            $sem_muerto=$_POST['sem_muerto'];
            $veh_abandonado=$_POST['veh_abandonado'];
            $veh_varado=$_POST['veh_varado'];
            $veh_inmov=$_POST['veh_inmov'];
            $serv_inc=$_POST['serv_inc'];
            //--------------------------------------------

$tipo_inc=$_POST['tipo_inc'];
$desc_inc=$_POST['desc_inc'];
$h_ini_inc=$_POST['h_ini_inc'];
$h_fin_inc=$_POST['h_fin_inc'];



$nuevo_regi="insert into tbl_parte values ('','','".$fechahora."','Incidente','0','0','0','".$ced."', '".$antendido."', '".$motivo_atencion."')";
$resultado1= mysql_query($nuevo_regi,$link);

//Se lee el registro que se acaba de insertar
$consulta="SELECT * FROM tbl_parte where fechahora='$fechahora'";
$resul= mysql_query($consulta,$link);
$row = mysql_fetch_array($resul);
$id_parte=$row["id_parte"];

$_SESSION[id_parte]=$id_parte;




 $nuevo_reg="insert into tbl_incidente values ('','".$id_parte."','".$via."','".$tramo."','".$calzada."','".$abcisa."','".$h_ini_inc."','".$h_fin_inc."','".$nom_inv."','".$ced_inv."',
                                                '".$tel_inv."','".$placa_veh."','".$color_veh."','".$marca_veh."','".$servicio_veh."','".$tipo_veh."','".$acc_trab."','".$per_muerta."',
                                                '".$pri_aux."','".$veh_abandonado."','".$veh_inmov."','".$escom_via."','".$obs_via."','".$sem_muerto."','".$veh_varado."','".$serv_inc."',
                                                '".$tipo_inc."','".$desc_inc."')";
 $res= mysql_query($nuevo_reg,$link);

 $cons="select * from tbl_parte where id_parte=$id_parte";
 $query= mysql_query($cons,$link);
 $vect_in = mysql_fetch_assoc($query);
 
 if($vect_in['motivo_parte']==''){

 $crea_parte="update tbl_parte set motivo_parte='Incidente', usuario='$ced' where id_parte=$id_parte ";
 $result= mysql_query($crea_parte,$link);
 }
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">
