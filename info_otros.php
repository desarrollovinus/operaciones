<?php
	session_start();
?>
<html>
	<head>
		<title>Informe de Otros</title>
		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
	</head>
	<body>
		<form action="info_excel.php" method="POST">
			<h1>INFORME DE OTROS</h1>
			<div style="padding-bottom: 20px;">
				<input type="submit" name="excel" id="bot" value="Generar Otros en Excel" >
				<input type="button" name="regresar" id="bot" value="Regresar" onclick="location.href='informes.php'" >
			</div>
			<?php			
				include("funciones.php");
				$link=Conectarse();
				$f_ini=$_POST['pri_fec'];
				$f_fin=$_POST['seg_fec'];
				
				$x = 1; //dias a sumar
				$fecha= date("Y-m-d", strtotime("$f_fin + ". $x ." days")); //se suman los $x dias
				
				$consulta="Select * from tbl_otros where h_ini_otros between '$f_ini' and '$fecha' order by h_ini_otros";
				$result=  mysql_query($consulta,$link);
				
				/*$tablaexcelotros='
				<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 >
				<TR aling="center">
					<TD width="5%" align="cente">&nbsp;<b>CONSECUTIVO</b></TD>
					<TD width="5%" align="center">&nbsp;<b>PARTE</b>&nbsp;</TD>
					<TD width="150px">&nbsp;<b>FECHA Y HORA INICIO</b>&nbsp;</TD>
					<TD width="150px" align="center">&nbsp;<b>FECHA Y HORA FIN</b>&nbsp;</TD>
					<TD align="center">&nbsp;<b>INSPECTOR</b>&nbsp;</TD>
					<TD width=" 5%" align="center">&nbsp;<b>VIA</b>&nbsp;</TD>
					<TD width="5%" align="center">&nbsp;<b>TRAMO</b>&nbsp;</TD>
					<TD width="5%" align="center">&nbsp;<b>CALZADA</b>&nbsp;</TD>
					<TD width="5%" align="center">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
					<TD width="500px" align="center" >&nbsp;<b>DESCRIPCION</b>&nbsp;</TD>
				</TR>';*/
				$tablaexcelotros='
				<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 >
				<TR aling="center">
					<TD width="5%" align="cente">&nbsp;<b>CONSECUTIVO</b></TD>
					<TD width="5%" align="center">&nbsp;<b>PARTE</b>&nbsp;</TD>
					<TD width="150px">&nbsp;<b>FECHA</b>&nbsp;</TD>
					<TD width="150px">&nbsp;<b>HORA INICIO</b>&nbsp;</TD>
					<TD width="150px" align="center">&nbsp;<b>HORA FIN</b>&nbsp;</TD>
					<TD align="center">&nbsp;<b>INSPECTOR</b>&nbsp;</TD>
					<TD width=" 5%" align="center">&nbsp;<b>VIA</b>&nbsp;</TD>
					<TD width="5%" align="center">&nbsp;<b>TRAMO</b>&nbsp;</TD>
					<TD width="5%" align="center">&nbsp;<b>CALZADA</b>&nbsp;</TD>
					<TD width="5%" align="center">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
					<TD width="500px" align="center" >&nbsp;<b>DESCRIPCION</b>&nbsp;</TD>
				</TR>';
				
				$cont=0;
				while($row = mysql_fetch_array($result)) {
				$cont++;
				$result1=mysql_query("select * from tbl_parte, tbl_usuarios where tbl_parte.usuario=tbl_usuarios.id_usuario and tbl_parte.id_parte=$row[id_parte]",$link);
				$vect_acc = mysql_fetch_assoc($result1);
				       
				if(empty($row["via"])){ 
					$row["via"]="&nbsp;"; 
				}
				if(empty($row["tramo"])){ 
					$row["tramo"]="&nbsp;"; 
				}
				if(empty($row["calzada"])){ 
					$row["calzada"]="&nbsp;"; 
				}
				if(empty($row["abcisa"])){ 
					$row["abcisa"]="&nbsp;"; 
				}
				if(empty($row["descrip"])){ 
					$row["descrip"]="&nbsp;"; 
				}
				if(empty($row["h_ini_otros"])){ 
					$row["h_ini_otros"]="&nbsp;"; 
				}
				if(empty($row["h_fin_otros"])){ 
					$row["h_fin_otros"]="&nbsp;"; 
				}
				
				$fechas1 = explode(' ', $row["h_ini_otros"]);
				$fechas2 = explode(' ', $row["h_fin_otros"]);
				
				//comprobando si el parte está incompleto
				$incompleto = otros_incompleto($row["id_parte"],$link);
				
				$color_fila = "";
				
				if($incompleto){
					$color_fila = "bgcolor='red'";
				}
				
				$tablaexcelotros .="
				<tr $color_fila>
					<td align='center'>".$cont."</td>
					<td align='center'>".$row["id_parte"]."</td>
					<td>".$fechas1[0]."</td>
					<td>".$fechas1[1]."</td>
					<td>".$fechas2[1]."</td>
					<td>".$vect_acc["us_nombre"]." ".$vect_acc["us_apellido"]."</td>
					<td align='center'>".$row["via"]."</td>
					<td align='center'>".$row["tramo"]."</td>
					<td align='center'>".$row["calzada"]."</td>
					<td align='center'>".$row["abcisa"]."</td>
					<td>".$row["descrip"]."</td>
				</tr>";
				}
				mysql_free_result($result);
				mysql_close($link);
				
				$tablaexcelotros .='</TABLE>';
				echo $tablaexcelotros;
				$_SESSION["tablaexcelotros"]=$tablaexcelotros;
			?>
		</form>
	</body>
</html>