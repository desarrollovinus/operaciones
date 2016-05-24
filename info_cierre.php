<?php
	session_start();
?>
<html>
	<head>
		<title>Informe de Cierres de Via</title>
		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
	</head>
	<body>
		<form action="info_excel.php" method="POST">
			<h1>INFORME DE CIERRES DE VIA</h1>
			<div style="padding-bottom: 20px;">
				<input type="submit" name="excel" id="bot" value="Generar Cierres en Excel" >
				<input type="button" name="regresar" id="bot" value="Regresar" onclick="location.href='informes.php'" >
			</div>
			<?php
				
				include("funciones.php");
				$link=Conectarse();
				$f_ini=$_POST['pri_fec'];
				$f_fin=$_POST['seg_fec'];
				
				$x = 1; //dias a sumar
				$fecha= date("Y-m-d", strtotime("$f_fin + ". $x ." days")); //se suman los $x dias
				
				$consulta="Select * from tbl_cierre where fechahoraini between '$f_ini' and '$fecha' order by fechahoraini";
				$result=  mysql_query($consulta,$link);
				
				$tablaexcelcie='
				<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1>
					<TR align="center">
						<TD width="5%">&nbsp;<b>CONSECUTIVO</b></TD>
						<TD width="5%">&nbsp;<b>PARTE</b>&nbsp;</TD>
						<TD width="5%">&nbsp;<b>REALIZADO POR</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>FECHA</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>HORA INICIO</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>HORA FIN</b>&nbsp;</TD>
						<TD width=" 5%">&nbsp;<b>VIA</b>&nbsp;</TD>
						<TD width="5%">&nbsp;<b>TRAMO</b>&nbsp;</TD>
						<TD width="5%">&nbsp;<b>CALZADA</b>&nbsp;</TD>
						<TD width="5%">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
						<TD width="500px" >&nbsp;<b>DESCRIPCION</b>&nbsp;</TD>
						<TD>&nbsp;<b>INSPECTOR</b>&nbsp;</TD>
						<TD>&nbsp;<b>AMBULANCIA</b>&nbsp;</TD>
						<TD>&nbsp;<b>GRUA</b>&nbsp;</TD>
						<TD>&nbsp;<b>DIRECTOR OPERACIONES</b>&nbsp;</TD>
						<TD>&nbsp;<b>AGENTES TTO</b>&nbsp;</TD>
						<TD>&nbsp;<b>POLICIA</b>&nbsp;</TD>
						<TD>&nbsp;<b>FISCALIA</b>&nbsp;</TD>
						<TD>&nbsp;<b>SEÑALIZACION</b>&nbsp;</TD>
						<TD>&nbsp;<b>BOMBEROS</b>&nbsp;</TD>
					</TR>';
				
				$cont=0;
				while($row = mysql_fetch_array($result)) {
					
					$cont++;
					$result1=mysql_query("select * from tbl_parte, tbl_usuarios where tbl_parte.usuario=tbl_usuarios.id_usuario and tbl_parte.id_parte=$row[id_parte]",$link);
					$vect_acc = mysql_fetch_assoc($result1);
					
					$result2=mysql_query("select * from tbl_parte where id_parte=$row[id_parte] ",$link);
					$row2 = mysql_fetch_assoc($result2);
					
					if($row2["motivo_parte"]=='Accidente'){
						$result3=mysql_query("select * from tbl_accidente where id_parte=$row[id_parte] ",$link);
						$row3 = mysql_fetch_assoc($result3);
					}
					if($row2["motivo_parte"]=='Incidente'){
						$result3=mysql_query("select * from tbl_incidente where id_parte=$row[id_parte] ",$link);
						$row3 = mysql_fetch_assoc($result3);
					}
					if($row2["motivo_parte"]=='Emergencia'){
						$result3=mysql_query("select * from tbl_emergencias where id_parte=$row[id_parte] ",$link);
						$row3 = mysql_fetch_assoc($result3);
					}
					if($row2["motivo_parte"]=='Otros'){
						$result3=mysql_query("select * from tbl_otros where id_parte=$row[id_parte] ",$link);
						$row3 = mysql_fetch_assoc($result3);
					}
					if(empty($vect_acc["us_nombre"])){ 
						$vect_acc["us_nombre"]="&nbsp;"; 
					}
					if(empty($row3["via"])){ 
						$row3["via"]="&nbsp;"; 
					}
					if(empty($row3["tramo"])){ 
						$row3["tramo"]="&nbsp;"; 
					}
					if(empty($row3["calzada"])){ 
						$row3["calzada"]="&nbsp;"; 
					}
					if(empty($row3["abcisa"])){ 
						$row3["abcisa"]="&nbsp;"; 
					}
					if(empty($row["amb"])){ 
						$row["amb"]="&nbsp;"; 
					}
					if(empty($row["grua_con"])){ 
						$row["grua_con"]="&nbsp;"; 
					}
					if(empty($row["dir_ope"])){ 
						$row["dir_ope"]="&nbsp;"; 
					}
					if(empty($row["agen_tran"])){ 
						$row["agen_tran"]="&nbsp;"; 
					}
					if(empty($row["pol_car"])){ 
						$row["pol_car"]="&nbsp;"; 
					}
					if(empty($row["fiscalia"])){ 
						$row["fiscalia"]="&nbsp;"; 
					}
					if(empty($row["sena"])){ 
						$row["sena"]="&nbsp;"; 
					}
					if(empty($row["bom"])){ 
						$row["bom"]="&nbsp;"; 
					}
					if(empty($row["insp_vial"])){ 
						$row["insp_vial"]="&nbsp;"; 
					}
					
					$fechas1 = explode(' ', $row["fechahoraini"]);
					$fechas2 = explode(' ', $row["fechahorafin"]);
					
					$tablaexcelcie .="
					<tr>
						<td align='center'>".$cont."</td>
						<td align='center'>".$row["id_parte"]."</td>
						<td>".$vect_acc["us_nombre"]." ".$vect_acc["us_apellido"]."</td>
						<td>".$fechas1[0]."</td>
						<td>".$fechas1[1]."</td>
						<td>".$fechas2[1]."</td>
						<td align='center'>".$row3["via"]."</td>
						<td align='center'>".$row3["tramo"]."</td>
						<td align='center'>".$row3["calzada"]."</td>
						<td align='center'>".$row3["abcisa"]."</td>
						<td >".$row["descrip"]."</td>
						<td align='center'>".$row["insp_vial"]."</td>
						<td align='center'>".$row["amb"]."</td>
						<td align='center'>".$row["grua_con"]."</td>
						<td align='center'>".$row["dir_ope"]."</td>
						<td align='center'>".$row["agen_tran"]."</td>
						<td align='center'>".$row["pol_car"]."</td>
						<td align='center'>".$row["fiscalia"]."</td>
						<td align='center'>".$row["sena"]."</td>
						<td align='center'>".$row["bom"]."</td>
					</tr>";
				}
				mysql_free_result($result);
				mysql_close($link);
				
				$tablaexcelcie .= '</TABLE>';
				echo $tablaexcelcie;
				$_SESSION["tablaexcelcie"]=$tablaexcelcie;
			?>
		</form>
	</body>
</html>