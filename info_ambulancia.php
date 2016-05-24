<?php
	session_start();
?>
<html>
	<head>
		<title>Informe de Ambulancia</title>
		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
	</head>
	<body>
		<form action="info_excel.php" method="POST">
			<h1>INFORME DE AMBULANCIA</h1>
			<div style="padding-bottom: 20px;">
			<input type="submit" name="excel" id="bot" value="Generar Ambulancia en Excel" >
			<input type="button" name="regresar" id="bot" value="Regresar" onclick="location.href='informes.php'" >
			</div>
			<?php
				include("funciones.php");
				$link=Conectarse();
				$f_ini=$_POST['pri_fec'];
				$f_fin=$_POST['seg_fec'];
				
				$x = 1; //dias a sumar
				$fecha= date("Y-m-d", strtotime("$f_fin + ". $x ." days")); //se suman los $x dias
				$consulta="Select * from tbl_ambulancia where h_ped between '$f_ini' and '$fecha' order by h_ped";
				$result=  mysql_query($consulta,$link);
				
				$tablaexcelamb='
				<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="1600px">
					<TR align="center">
						<TD width="5%">&nbsp;<b>CONSECUTIVO</b></TD>
						<TD width="5%">&nbsp;<b>PARTE</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>FECHA</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>HORA</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>USUARIO</b>&nbsp;</TD>
						<TD width=" 5%">&nbsp;<b>VIA</b>&nbsp;</TD>
						<TD width="5%">&nbsp;<b>TRAMO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>CALZADA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>CAUSA QUE ORIGINA LA ATENCIÓN</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>OXIGENACION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>ASPIRACION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>RCCP</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>MONITOREO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>INMOVILIZACION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>APOYO PSICOLOGICO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>VENTILAICION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>INTUBACION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>DESFIBRILACION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>VENDAJE</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>COLLAR CERVICAL</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>ASEPCIA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>OTROS</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>DIAGNOSTICO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>HOSPITAL MARCO  FIDEL SUAREZ</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>HOSPITAL SNTA MARGARITA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>HOSPITAL SAN RAFAEL GIRARDOTA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>HOSPITAL SAN VICENTE BARBOSA </b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>HOSPITAL FRANCISCO ELADIO BARRERA DON MATIAS</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>CLINICA DEL NORTE DEL VALLE DE ABURRA NIQUIA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>SALUD TOTAL BELLO</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>OTRO CENTRO ASISTENCIAL</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>SIN TRASLADO </b>&nbsp;</TD>
						<TD width="150px" >&nbsp;<b>HORA CONOCIMIENTO</b>&nbsp;</TD>
						<TD width="150px" >&nbsp;<b>HORA ATENCION</b>&nbsp;</TD>
						<TD width="150px" >&nbsp;<b>HORA RECEPCION</b>&nbsp;</TD>
					</TR>';
				
				$cont=0;
				while($row = mysql_fetch_array($result)) {
					if(empty($row["enfer_gen"])){ 
						$row["enfer_gen"]="&nbsp;"; 
					}
					if(empty($row["collar_cervical"])){ 
						$row["collar_cervical"]="&nbsp;"; 
					}
					if(empty($row["victimas"])){ 
						$row["victimas"]="&nbsp;"; 
					}
					if(empty($row["mfs"])){ 
						$row["mfs"]="&nbsp;"; 
					}
					if(empty($row["smc"])){ 
						$row["smc"]="&nbsp;"; 
					}
					if(empty($row["srg"])){ 
						$row["srg"]="&nbsp;"; 
					}
					if(empty($row["svpb"])){ 
						$row["svpb"]="&nbsp;"; 
					}
					if(empty($row["febdm"])){ 
						$row["febdm"]="&nbsp;"; 
					}
					if(empty($row["cnvn"])){ 
						$row["cnvn"]="&nbsp;"; 
					}
					if(empty($row["stb"])){ 
						$row["stb"]="&nbsp;"; 
					}
					if(empty($row["otc"])){ 
						$row["otc"]="&nbsp;"; 
					}
					if(empty($row["st"])){ 
						$row["st"]="&nbsp;"; 
					}
					if(empty($row["oxig"])){ 
						$row["oxig"]="&nbsp;"; 
					}
					if(empty($row["Aspiracion"])){ 
						$row["Aspiracion"]="&nbsp;"; 
					}
					if(empty($row["rccp"])){ 
						$row["rccp"]="&nbsp;"; 
					}
					if(empty($row["monitoreo"])){ 
						$row["monitoreo"]="&nbsp;"; 
					}
					if(empty($row["inmov"])){ 
						$row["inmov"]="&nbsp;"; 
					}
					if(empty($row["apoyo_psic"])){ 
						$row["apoyo_psic"]="&nbsp;"; 
					}
					if(empty($row["ventilacion"])){ 
						$row["ventilacion"]="&nbsp;"; 
					}
					if(empty($row["intubacion"])){ 
						$row["intubacion"]="&nbsp;"; 
					}
					if(empty($row["desfibrilacion"])){ 
						$row["desfibrilacion"]="&nbsp;"; 
					}
					if(empty($row["vendaje"])){ 
						$row["vendaje"]="&nbsp;"; 
					}
					if(empty($row["asepsia"])){ 
						$row["asepsia"]="&nbsp;"; 
					}
					if(empty($row["oxig"])){ 
						$row["oxig"]="&nbsp;"; 
					}
					if(empty($row["Aspiracion"])){ 
						$row["Aspiracion"]="&nbsp;"; 
					}
					if(empty($row["otros_proc"])){ 
						$row["otros_proc"]="&nbsp;"; 
					}
					if(empty($row["clinica_hosp"])){ 
						$row["clinica_hosp"]="&nbsp;"; 
					}
					if(empty($row["causa_ext"])){ 
						$row["causa_ext"]="&nbsp;"; 
					}
					if(empty($row["nom_us"])){ 
						$row["nom_us"]="&nbsp;"; 
					}
					if(empty($row["diagnostico"])){ 
						$row["diagnostico"]="&nbsp;"; 
					}
					
					
					$cont++;
					$result1=mysql_query("select * from tbl_parte, tbl_usuarios where tbl_parte.usuario=tbl_usuarios.id_usuario and tbl_parte.id_parte=$row[id_parte]",$link);
					$vect_acc = mysql_fetch_assoc($result1);
					
					$fechas = explode(' ', $row["h_ped"]);
					$fechas1 = explode(' ', $row["fechahoraatencion"]);
					$fechas2 = explode(' ', $row["fechahorarecepcion"]);
					
					$tablaexcelamb .="
					<tr>
						<td align='center'>".$cont."</td>
						<td align='center'>".$row["id_parte"]."</td>
						<td>".$fechas[0]."</td>
						<td>".$fechas[1]."</td>
						<td>".$row["nom_us"]."</td>
						<td align='center'>".$row["via"]."</td>
						<td align='center'>".$row["tramo"]."</td>
						<td align='center'>".$row["calzada"]."</td>
						<td align='center'>".$row["abcisa"]."</td>
						<td align='center'>".$row["causa_ext"]."</td>
						<td align='center'>".$row["oxig"]."</td>
						<td align='center'>".$row["Aspiracion"]."</td>
						<td align='center'>".$row["rccp"]."</td>
						<td align='center'>".$row["monitoreo"]."</td>
						<td align='center'>".$row["inmov"]."</td>
						<td align='center'>".$row["apoyo_psic"]."</td>
						<td align='center'>".$row["ventilacion"]."</td>
						<td align='center'>".$row["intubacion"]."</td>
						<td align='center'>".$row["desfibrilacion"]."</td>
						<td align='center'>".$row["vendaje"]."</td>
						<td align='center'>".$row["collar_cervical"]."</td>
						<td align='center'>".$row["asepsia"]."</td>
						<td align='center'>".$row["otros_proc"]."</td>
						<td>".$row["diagnostico"]."</td>
						<td>".$row["mfs"]."</td>
						<td>".$row["smc"]."</td>
						<td>".$row["srg"]."</td>
						<td>".$row["svpb"]."</td>
						<td>".$row["febdm"]."</td>
						<td>".$row["cnvn"]."</td>
						<td>".$row["stb"]."</td>
						<td>".$row["otc"]."</td>
						<td>".$row["st"]."</td>
						<td>".$fechas[1]."</td>
						<td>".$fechas1[1]."</td>
						<td>".$fechas2[1]."</td>
					</tr>";
				}
				
				mysql_free_result($result);
				mysql_close($link);
				
				$tablaexcelamb .= '</TABLE>';
				echo $tablaexcelamb;
				$_SESSION["tablaexcelamb"]=$tablaexcelamb;
			?>
		</form>
	</body>
</html>