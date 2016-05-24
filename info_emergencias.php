<?php
session_start();
?>
<html>
    <head>
        <title>Informe de Emergencias</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>
        <form action="info_excel.php" method="POST">
        <h1>INFORME DE EMERGENCIAS</h1>
        <div style="padding-bottom: 20px;">
        <input type="submit" name="excel" id="bot" value="Generar Emergencias en Excel" >
        <input type="button" name="regresar" id="bot" value="Regresar" onclick="location.href='informes.php'" >
        </div>
<?php

include("funciones.php");
$link=Conectarse();
$f_ini=$_POST['pri_fec'];
$f_fin=$_POST['seg_fec'];

$x = 1; //dias a sumar
$fecha= date("Y-m-d", strtotime("$f_fin + ". $x ." days")); //se suman los $x dias


$consulta="Select * from tbl_emergencias where h_ini_emer between '$f_ini' and '$fecha' order by h_ini_emer";
$result=  mysql_query($consulta,$link);


$tablaexcelemer='
        <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>
        <TR align="center"><TD width="5%">&nbsp;<b>CONSECUTIVO</b></TD><TD width="5%">&nbsp;<b>PARTE</b>&nbsp;</TD>
        <TD width="150px">&nbsp;<b>FECHA Y HORA INICIO</b>&nbsp;</TD><TD width="150px">&nbsp;<b>FECHA Y HORA FIN</b>&nbsp;</TD>
        <TD>&nbsp;<b>INSPECTOR</b>&nbsp;</TD><TD width=" 5%">&nbsp;<b>VIA</b>&nbsp;</TD><TD width="5%">&nbsp;<b>TRAMO</b>&nbsp;</TD>
        <TD width="5%">&nbsp;<b>CALZADA</b>&nbsp;</TD><TD width="5%">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
        <TD width="500px" >&nbsp;<b>DESCRIPCION</b>&nbsp;</TD></TR>';

    $cont=0;
    while($row = mysql_fetch_array($result)) {
       
       $cont++;
       $result1=mysql_query("select * from tbl_parte, tbl_usuarios where tbl_parte.usuario=tbl_usuarios.id_usuario and tbl_parte.id_parte=$row[id_parte]",$link);
       $vect_acc = mysql_fetch_assoc($result1);
        if(empty($vect_acc["us_nombre"])){ $vect_acc["us_nombre"]="&nbsp;"; }

       $tablaexcelemer .="<tr><td align='center'>".$cont."</td><td align='center'>".$row["id_parte"]."</td><td>".$row["h_ini_emer"]."</td><td>".$row["h_fin_emer"]."</td><td>".$vect_acc["us_nombre"]." ".$vect_acc["us_apellido"]."</td>
           <td align='center'>".$row["via"]."</td><td align='center'>".$row["tramo"]."</td><td align='center'>".$row["calzada"]."</td><td align='center'>".$row["abcisa"]."</td><td >".$row["descrip"]."</td></tr>";

   }
   mysql_free_result($result);
   mysql_close($link);

       $tablaexcelemer .='</TABLE>';
       echo $tablaexcelemer;
       $_SESSION["tablaexcelemer"]=$tablaexcelemer;
?>
        </form>
    </body>
</html>