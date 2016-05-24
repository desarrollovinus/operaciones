<?php
session_start();
include 'funciones.php';
$link= Conectarse();

if(isset($_SESSION["tipo"])){
    switch($_SESSION["tipo"]){
        case 1: header("location: querys.php");
        break;
        case 2: header("location: menu_insp.php");
        break;
        case 3: header("location: monitorBitacora.php");
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Gestión de Operaciones</title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="form" method="post" action="loginVal.php">
                    <!-- <h2>Sistema de Gestión de Operaciones</h2> -->
                    <div id="frm_ind">
                        <div class="titulos">Usuario:</div>
                        <div class="campos"><input type="text" id="login" name="login" placeholder="Ingrese su usuario"></div><br>
                        <div class="titulos">Contraseña</div>
                        <div class="campos"><input type="password" id="pass" name="pass" placeholder="Ingrese su contraseña"></div>
                        <div class="boton"><center><input type="submit" id="ing"  value="Ingresar" name="ing" class="bot" /></center></div>
                    </div>
                </form>
                <div id="contenido">
                <?php
                    if (isset($_SESSION["log"])) {
                        if ($_SESSION["log"]==1){
                            echo 'Usuario o contrase&ntilde;a inconrrectos';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <script language="javascript" type="text/javascript" src="js/jquery-1.7.min.js"></script>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        //Cursor
        $("#login").focus();
    })
</script>