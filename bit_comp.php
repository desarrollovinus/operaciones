<?php
session_start();

$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}

?>

<html>
<head>
    <title>Consulta Bitacora Completa</title>
    <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
</head>
<body>
<?php
   include("funciones.php");
   ?>
   <?php $link=Conectarse(); ?>
   <?php $result=mysql_query("select * from tbl_bitacora order by consecutivo desc",$link);


?>
    <center>

    <form action="bitacora.php" name="frmbit" id="frmbit" enctype="multipart/form-data" method="post" >


    <div id="botonera">
     <input type="button" id="reg" name="reg" value="Regresar" onclick="location.href='./querys.php'" class="button">
    </div>
      <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>
        <TR><TD>&nbsp;<b>CONSECUTIVO</b></TD><TD>&nbsp;<b>MOTIVO</b>&nbsp;</TD>
        <TD>&nbsp;<b>FECHA Y HORA</b>&nbsp;</TD><TD>&nbsp;<b>ASUNTO</b>&nbsp;</TD>
        <TD>&nbsp;<b>ANOTACION</b>&nbsp;</TD></TR>
<?php

   while($row = mysql_fetch_array($result)) {
      printf("<tr><td>&nbsp;%s</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td width='150'>&nbsp;%s&nbsp;</td><td width='600'>&nbsp;%s&nbsp;</td></tr>",
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