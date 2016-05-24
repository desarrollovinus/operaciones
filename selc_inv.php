<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$id_parte = $_SESSION["id_parte"];
?>
<html>
    <head>

       <?php
       include 'funciones.php';
       $link=Conectarse();
       ?>
        <title>Modificación de Involucrados</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script language="javascript" src="js/validaciones.js" type="text/javascript"></script>
    </head>
    <body>

      <form action="mod_ambulancia.php" name="frmmodinvo" id="frmmodinvo" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>
            
            
            </div>
            <div id="contpag">
                <input type="button" name="nuevo" id="nuevo" value="Añadir Nuevo" class="bot" onclick="location.href='nuevo_inv.php'">
                  <input type="button" name="reg" id="reg" value="Terminar" class="bot" onclick="location.href='menu_insp.php'">
        <?php
        $tabla='
        <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="800px">
        <TR align="center"><TD>&nbsp;<b>NUMERO</b></TD><TD>&nbsp;<b>NOMBRE</b>&nbsp;</TD>
        <TD>&nbsp;<b>PLACA</b>&nbsp;</TD><TD>&nbsp;<b>TIPO VEHICULO</b>&nbsp;</TD>
        <TD>&nbsp;<b>ACTUALIZAR</b>&nbsp;</TD>
        </TR>';

        $cons="select * from tbl_involucrados where id_parte='$id_parte'";
        $res=mysql_query($cons,$link);
        $cont=1;
        while($row = mysql_fetch_array($res)) {

        $dato=$row["id_inv"];
        if(empty($row["placa_veh"])){ $row["placa_veh"]="&nbsp;"; }
        if(empty($row["tipo_veh"])){ $row["tipo_veh"]="&nbsp;"; }
        if(empty($row["nombre"])){ $row["nombre"]="&nbsp;"; }
        
        
        $tabla .='<tr><td>'.$cont.'</td><td>'.$row["nombre"].'</td><td>'.$row["placa_veh"].'</td><td>'.$row["tipo_veh"].'</td><td align="center"><INPUT TYPE="button" value="" style="background-image: url(images/edit.png)" onclick="asignarinv(\''.$dato.'\');"> </td></tr>';

        $cont+=1;
        }
        ?>
        <input type="hidden" id="dato" name="dato" value="">
        <?php

        echo $tabla;
        ?>
            </div>
        </form>

                </body>
                </html>
