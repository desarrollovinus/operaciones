<html>
<head>
    <title>Consulta Bitacora</title>
    <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
   include("funciones.php");
   ?>
   <?php $link=Conectarse(); ?>
   <?php $fechahora= date('Y-m-d H:i:s');
                      $dia=-1;
                      $calculo= strtotime("$dia days");
                      $fecha=date('Y-m-d H:i:s', $calculo);
                      $result=mysql_query("select * from tbl_bitacora where fechahora>='$fecha' order by consecutivo desc",$link);
?>
    <center>
    <form action="#" name="form2" id="form2" enctype="multipart/form-data" method="post" >
    <select style="font-size:12px;color:#006699;font-family:verdana;background-color:#ffffff;" name="menu">
        <option value="http://localhost/operaciones/listado1.php">Todos los registros</option>
        <option value="http://localhost/operaciones/listado3.php">Ultimas 8 Horas</option>

        </select>
        <input style="font-size:12px;color:#ffffff;font-family:verdana;background-color:#006699;" type="button" onClick="location=document.form2.menu.options[document.form2.menu.selectedIndex].value;" value="Ir">
        <input style="font-size:12px;color:#ffffff;font-family:verdana;background-color:#006699;" type="button" onClick="location.href='consulta_fecha.php'" value="Consultar por fecha">
      <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="1060px">
        <TR><TD>&nbsp;<b>CONSECUTIVO</b></TD><TD>&nbsp;<b>MOTIVO</b>&nbsp;</TD>
        <TD width="13%">&nbsp;<b>FECHA Y HORA</b>&nbsp;</TD><TD>&nbsp;<b>ASUNTO</b>&nbsp;</TD>
        <TD>&nbsp;<b>ANOTACION</b>&nbsp;</TD></TR>
<?php

   while($row = mysql_fetch_array($result)) {
      printf("<tr><td>&nbsp;%s</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td></tr>",
              $row["consecutivo"],$row["motivo"],$row["fechahora"],$row["asunto"],$row["anotacion"]);
   }
   mysql_free_result($result);
   mysql_close($link);
?>
</TABLE>
    </form>
    </center>
</body>
</html>