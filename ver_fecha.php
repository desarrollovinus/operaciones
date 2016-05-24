<?php
session_start();
include 'funciones.php';

$tipo_us=$_SESSION["tipo"];
$link=Conectarse();
$fecha = $_POST['fecha'];   

//Consulta que busca los involucrados con los datos de la placa ingresada en la búsqueda
$consulta = mysql_query("select * from tbl_bitacora WHERE DATE(fechahora) =  '$fecha' order by consecutivo", $link);
$result =  mysql_num_rows($consulta);
echo $result;

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Consulta de fecha</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
        <center>
            <form action="bitacora.php" name="ver_fecha" id="frmbit" enctype="multipart/form-data" method="post" >
                <div id="botonera">
                    <input type="button" id="atras" name="reg" value="Atr&aacute;s" onclick="location.href='ver_bit_insp.php'" class="button">
                    <input type="button" id="buscar_fecha" name="buscar_fecha" value="Volver a buscar" onclick="location.href='buscar_fecha.php'" class="button">
                </div>
                <table border=1 cellspacing=1 cellpading=1>
                    <tr align="center">
                        <TD>&nbsp;<b>CONSECUTIVO</b></TD>
                        <TD>&nbsp;<b>MOTIVO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>FECHA Y HORA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>ASUNTO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>ANOTACI&Oacute;N</b>&nbsp;</TD>
                    </tr>
                    <?php
                        while($row = mysql_fetch_array($consulta)){
                            printf(
                                "<tr>
                                    <td align='Right'>&nbsp;%s</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td width='150'>&nbsp;%s&nbsp;</td>
                                    <td width='600'>&nbsp;%s&nbsp;</td>
                                </tr>",
                                    $row["consecutivo"],
                                $row["motivo"],
                                $row["fechahora"],
                                utf8_decode($row["asunto"]),
                                $row["anotacion"]);
                        }//Fin while
                    ?>
                </table>
            </form>
        </center>
    </body>
</html>