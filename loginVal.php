<?php
session_start();

include 'funciones.php';
require_once("datas.php");
$link=Conectarse();

$_SESSION["log"]=0;

$usuario=ReplaceChar($_POST['login']);
$contrasena=ReplaceChar($_POST['pass']);
$query="SELECT id_usuario, us_tipo FROM tbl_usuarios WHERE us_user='".$usuario."' and us_pass='".md5($contrasena)."' ";
$exequery=mysql_query($query,$link);
$row=mysql_fetch_assoc($exequery);

$_SESSION["ced"]=$row["id_usuario"];
              

if($row==''){
    $_SESSION["log"]=1;
    header("location: index.php");
}else{
    $_SESSION["log"]=2;
    $_SESSION["tipo"]=$row["us_tipo"];
    
    switch($row["us_tipo"]){
        case 1: header("location: querys.php");
        break;
        case 2: header("location: menu_insp.php");
        break;
        case 3: header("location: monitorBitacora.php");
        break;
    }
}
?>
