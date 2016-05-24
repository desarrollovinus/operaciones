<?php
date_default_timezone_set('America/Bogota');
session_start();

$log=$_SESSION["log"];
$tipo_usuario = $_SESSION["tipo"];

if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}

/*
 * Esta validacion se usa para impedir que el usuario tipo 2 se mueva por la url
 * hasta el menu de loa bitácora, puesto que no debe tener acceso a ese menu
 */
if ($tipo_usuario == 2){
    session_destroy();
?>
    <meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
<?php
}//Fin if
?>
     
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Consulta Bit&aacute;cora</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include("funciones.php");
        ?>
        <center>
            <form action="bitacora.php" name="frmbit" id="frmbit" enctype="multipart/form-data" method="post" >
                <div id="botonera">
                    <input type="submit" id="nueva_bit" name="nueva_bit" value="Nueva Bitacora" class="button" />
                    <a href="twitter"><img src="images/twitter.png" alt="Generar un tweet" style="vertical-align: middle"/></a>
                    <input type="button" id="imp_bit" name="imp_bit" value="Imprimir" onclick="location.href='./imp_bit.php'" class="button">
                    <input type="button" id="informes" name="informes" value="Informes" onclick="location.href='./informes.php'" class="button">
                    <input type="button" id="ver" name="ver" value="Ver todo" onclick="location.href='./bit_comp.php'" class="button">
                    <input type="button" id="ver_parte" name="ver_parte" value="Ver Parte" onclick="location.href='./ver.php'" class="button">
                    <input type="button" id="buscar_fecha" name="fecha" value="Buscar fecha" onclick="location.href='./buscar_fecha_querys.php'" class="button">
                    <input type="button" id="salir" name="salir" value="Salir" onclick="location.href='./salir.php'" class="button">
                </div>
                <?php
                if (isset($_REQUEST['pos']))
                  $inicio=$_REQUEST['pos'];
                else
                  $inicio=0;
                    $impresos=0;

                $consulta =
                "SELECT
                    b.consecutivo,
                    b.id_parte,
                    b.fechahora,
                    b.motivo,
                    b.asunto,
                    b.heridos,
                    b.reporto,
                    b.danos,
                    b.ubicacion,
                    b.emisor,
                    b.importancia,
                    b.anotacion,
                    b.usuario,
                    CONCAT(u.us_nombre, ' ', u.us_apellido) nombre_usuario
                FROM
                    tbl_bitacora AS b
                LEFT JOIN tbl_usuarios AS u ON b.usuario = u.id_usuario
                ORDER BY
                    b.consecutivo DESC
                LIMIT {$inicio},
                 200";

                $link=Conectarse();  $result=mysql_query($consulta,$link);

                $tabla=
                '<table border=1 cellspacing=1 cellpading=1 width="90%">
                    <tr align="center">
                        <td>&nbsp;<b>CONSECUTIVO</b></td>
                        <td>&nbsp;<b>MOTIVO</b>&nbsp;</td>
                        <td width="12%">&nbsp;<b>FECHA Y HORA</b>&nbsp;</td>
                        <td>&nbsp;<b>ASUNTO</b>&nbsp;</td>
                        <td>&nbsp;<b>USUARIO</b>&nbsp;</td>
                        <td>&nbsp;<b>ANOTACI&Oacute;N</b>&nbsp;</td>
                    </tr>';

                while($row = mysql_fetch_array($result)) {
                    $impresos++;
                    if(empty($row["consecutivo"])){ $row["consecutivo"]="&nbsp;"; }
                    if(empty($row["motivo"])){ $row["motivo"]="&nbsp;"; }
                    if(empty($row["fechahora"])){ $row["fechahora"]="&nbsp;"; }
                    if(empty($row["asunto"])){ $row["asunto"]="&nbsp;"; }
                    if(empty($row["nombre_usuario"])){ $row["nombre_usuario"]="&nbsp;"; }
                    if(empty($row["anotacion"])){ $row["anotacion"]="&nbsp;"; }

                    $tabla .=
                    '<tr>
                         <td align="right">'.$row["consecutivo"].'</td>
                         <td>'.$row["motivo"].'</td>
                         <td>'.$row["fechahora"].'</td>
                         <td>'.$row["asunto"].'</td>
                         <td>'.$row["nombre_usuario"].'</td>
                         <td>'.$row["anotacion"].'</td>
                     </tr>';
                }//Fin while

                mysql_close($link);

                if ($inicio==0)
                  echo "<font size='3'>Anterior </font> ";
                else
                {
                  $anterior=$inicio-200;
                  echo "<a href=\"querys.php?pos=$anterior\"><font size='3' color='dodgerblue'>Anterior </font></a>";
                }
                if ($impresos==200)
                {
                  $proximo=$inicio+200;
                  echo "<a href=\"querys.php?pos=$proximo\"><font size='3' color='dodgerblue'>Siguiente </font></a> <br>";
                }
                else
                    echo "<font size='3'>Siguiente</font> <br>";
                    echo $tabla;
                ?>
            </form>
        </center>
    </body>
</html>


