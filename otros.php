<?php
date_default_timezone_set('America/Bogota');
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$ced=$_SESSION["ced"];
?>
<html>
    <head>
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Otros</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<script src="js/jquery-1.7.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#tramo").change(function () {
					$("#tramo option:selected").each(function () {
						elegido=$(this).val();
						$("#punto").val("");
						$("#punto").attr("title","");
						$("#nom_tramo").val("");
						$("#via").val("");
						$("#abscisa").html("");
						if(elegido=="Seleccione"){
							return false;
						}
						$.post("tramo.php", { elegido: elegido }, function(data){
							$("#abscisa").html("");
							array_datos = data.split('|');
							longitud = array_datos.length;
							$("#nom_tramo").val(array_datos[0]);
							$("#via").val(array_datos[1]);
							/*select_abscisas = "<option value='Seleccione'>Seleccione</option>";
							for(i = 2; i < longitud; i+=2){
								id=array_datos[i];
								abscisa=array_datos[i+1];
								select_abscisas += "<option value="+ id + ">" + abscisa + "</option>";
							}
							$("#abscisa").html(select_abscisas);*/
						});
					});
				});
				/*$("#abscisa").change(function () {
					$("#abscisa option:selected").each(function () {
						elegido=$(this).val();
						$("#punto").val("");
						$("#punto").attr("title","");
						if(elegido=="Seleccione"){
							return false;
						}
						$.post("abscisa.php", { elegido: elegido }, function(data){
							$("#punto").val(data);
							$("#punto").attr("title",data);
						});			
					});
				});*/
			});
		</script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <body>
           
            <div id="contenedor_otros_ins">
                <form action="guardar_otros.php" name="frm_ot_insp" id="frm_ot_insp" enctype="multipart/form-data" method="post" >
             <?php
             //Inserta un nuevo registro con el timestamp y la cÃ©dula
            $fechahora= date('Y-m-d H:i:s');
           ?>
            <div id="contenedor-logo">
            <div class="logo"></div>
            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                    
                    </div>
                    <div class="campos">
                        <input type="hidden" id="fecha" name="fecha" value="<?php echo $fechahora;?>" >
                        
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <input type="text" class="sen-class" readonly="readonly" id="via"></input>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Tramo</b>
                    </div>
                    <div class="campos">
                        <select id="tramo" name="tramo" class="sen-class">
							<option value="" selected></option>
							<?php
								$consulta = "select * from tbl_tramos order by id";
								$resultado = mysql_query($consulta,$link);
								while($tramo = mysql_fetch_assoc($resultado)){
									echo "<option value='".$tramo["id"]."'>Tramo ".$tramo["id"]."</option>";
								}
							?>
						</select>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Calzada</b>
                    </div>
                    <div class="campos">
                        <select id="calzada" name="calzada" class="sen-class">
                            <optgroup label="Seleccione">
                            <option value=""></option>
                            <option value="W">W</option>
                            <option value="E">E</option>
                            <option value="N/A">N/A</option>
                            <option value="W/E">W/E</option>
                            </optgroup>
                            </select>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Abscisa</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="abcisa" name="abcisa" class="sen-class">
                    </div>
                </div>
                </div>
                    <div class="encabezado2">
                <div class="cie_horas">
                <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $id_parte;?>" >
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">

                    <div class="titulo_cie">Fecha y Hora Inicio:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                    <div class="campos_cie"><input type="text" id="h_ini_otros" name="h_ini_otros" class="sen-class1"></div>
                    <div class="titulo_cie">Fecha y Hora Fin:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                    <div class="campos_cie"><input type="text" id="h_fin_otros" name="h_fin_otros" class="sen-class1"></div>
					<script type="text/javascript">//<![CDATA[

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: true
						  });
						  cal.manageFields("cal_1", "h_ini_otros", "%Y-%m-%d %H:%M");
						  cal.manageFields("cal_2", "h_fin_otros", "%Y-%m-%d %H:%M");

					//]]></script>
                </div>
            </div>
                 <div class="desc">
                     <div class="titulo_otr"><b>DESCRIPCION</b></div>
                     <textarea id="desc_otros" name="desc_otros" class="text_otros_des"></textarea>
                     <div class="boton_otros">
                     <input type="submit" id="guardar" name="guargar" Value="Guardar" class="bot">
                     <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                 </div>
                </div>




       

                    </form>
                  </div>
                </body>
                </html>