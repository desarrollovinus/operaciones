<?php
	session_start();
?>
<html>
	<head>
		<title>Informe de Gruas</title>
		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
	</head>
	<body>
		<form action="info_excel.php" method="POST">
			<h1>INFORME DE GRUAS</h1>
			<div style="padding-bottom: 20px;">
				<input type="submit" name="excel" id="bot" value="Generar Gruas en Excel" >
				<input type="button" name="regresar" id="bot" value="Regresar" onclick="location.href='informes.php'" >
			</div>
			<?php
			
				include("funciones.php");
				$link=Conectarse();
				$f_ini=$_POST['pri_fec'];
				$f_fin=$_POST['seg_fec'];
				
				$x = 1; //dias a sumar
				$fecha= date("Y-m-d", strtotime("$f_fin + ". $x ." days")); //se suman los $x dias
				
				$consulta="Select * from tbl_grua where h_ped between '$f_ini' and '$fecha' order by tipo_grua, h_ped";
				$result=  mysql_query($consulta,$link);
				
				/*$tablaexcelgruas='
				<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="1600px">
					<TR align="center">
						<TD width="5%">&nbsp;<b>CONSECUTIVO</b></TD>
						<TD width="5%">&nbsp;<b>PARTE</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>FECHA Y HORA</b>&nbsp;</TD>
						<TD width=" 5%">&nbsp;<b>VIA</b>&nbsp;</TD>
						<TD width="5%">&nbsp;<b>TRAMO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>CALZADA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
						<TD width="350px">&nbsp;<b>LUGAR DE FINALIZACION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>TIPO GRUA</b>&nbsp;</TD>
						<TD width="5px" >&nbsp;<b>MOTIVO SERVICIO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>SERVICIO PRESTADO</b>&nbsp;</TD>
						<TD width="350px">&nbsp;<b>PERSONA QUE AUTORIZA</b>&nbsp;</TD>
						<TD width="350px">&nbsp;<b>EN CALIDAD DE</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>FECHA Y HORA PEDIDO</b>&nbsp;</TD>
						<TD width="150px" >&nbsp;<b>FECHA HORA INICIO</b>&nbsp;</TD>
						<TD width="150px" >&nbsp;<b>FECHA HORA FIN</b>&nbsp;</TD>
					</TR>';*/
				$tablaexcelgruas='
				<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="1600px">
					<TR align="center">
						<TD width="5%">&nbsp;<b>CONSECUTIVO</b></TD>
						<TD width="5%">&nbsp;<b>PARTE</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>FECHA</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>HORA</b>&nbsp;</TD>
						<TD width=" 5%">&nbsp;<b>VIA</b>&nbsp;</TD>
						<TD width="5%">&nbsp;<b>TRAMO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>CALZADA</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>ABSCISA</b>&nbsp;</TD>
						<TD width="350px">&nbsp;<b>LUGAR DE FINALIZACION</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>TIPO GRUA</b>&nbsp;</TD>
						<TD width="5px" >&nbsp;<b>MOTIVO SERVICIO</b>&nbsp;</TD>
						<TD width="5px">&nbsp;<b>SERVICIO PRESTADO</b>&nbsp;</TD>
						<TD width="350px">&nbsp;<b>PERSONA QUE AUTORIZA</b>&nbsp;</TD>
						<TD width="350px">&nbsp;<b>EN CALIDAD DE</b>&nbsp;</TD>
						<TD width="150px">&nbsp;<b>HORA PEDIDO</b>&nbsp;</TD>
						<TD width="150px" >&nbsp;<b>HORA INICIO</b>&nbsp;</TD>
						<TD width="150px" >&nbsp;<b>HORA FIN</b>&nbsp;</TD>
					</TR>';
				
				$cont=0;
				while($row = mysql_fetch_array($result)) {
					if(empty($row["mot_serv"])){ 
						$row["mot_serv"]="&nbsp;"; 
					}
					if(empty($row["serv_pres"])){ 
						$row["serv_pres"]="&nbsp;"; 
					}
					if(empty($row["autoriza_mov"])){ 
						$row["autoriza_mov"]="&nbsp;"; 
					}
					if(empty($row["en_calidad_de"])){ 
						$row["en_calidad_de"]="&nbsp;"; 
					}
					if(empty($row["lug_fin"])){ 
						$row["lug_fin"]="&nbsp;"; 
					}
					if(empty($row["tipo_grua"])){ 
						$row["tipo_grua"]="&nbsp;"; 
					}
					if(empty($row["abcisa"])){ 
						$row["abcisa"]="&nbsp;"; 
					}
					
					$cont++;
					$result1=mysql_query("select * from tbl_parte, tbl_usuarios where tbl_parte.usuario=tbl_usuarios.id_usuario and tbl_parte.id_parte=$row[id_parte]",$link);
					$vect_acc = mysql_fetch_assoc($result1);
					
					$fecha1 = explode(' ', $row["h_ped"]);
					$fecha2 = explode(' ', $row["fechahorainicio"]);
					$fecha3 = explode(' ', $row["fechahorafin"]);
					
					$tablaexcelgruas .= "
					<tr>
						<td align='center'>".$cont."</td>
						<td align='center'>".$row["id_parte"]."</td>
						<td>".$fecha1[0]."</td>
						<td>".$fecha1[1]."</td>
						<td align='center'>".$row["via"]."</td>
						<td align='center'>".$row["tramo"]."</td>
						<td align='center'>".$row["calzada"]."</td>
						<td align='center'>".$row["abcisa"]."</td>
						<td>".$row["lug_fin"]."</td>
						<td >".$row["tipo_grua"]."</td>
						<td align='center'>".$row["mot_serv"]."</td>
						<td align='center'>".$row["serv_pres"]."</td>
						<td>".$row["autoriza_mov"]."</td>
						<td>".$row["en_calidad_de"]."</td>
						<td>".$fecha1[1]."</td>
						<td>".$fecha2[1]."</td>
						<td>".$fecha3[1]."</td>
					</tr>";
				}
				mysql_free_result($result);
				mysql_close($link);
				
				$tablaexcelgruas .= '</TABLE>';
				echo $tablaexcelgruas;
				$_SESSION["tablaexcelgruas"]=$tablaexcelgruas;
			?>
		</form>
	</body>
</html>