<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$id_parte=$_SESSION["id_parte"];
$tipo_us=$_SESSION["tipo"];

include 'funciones.php';
$link=Conectarse();
$consulta="SELECT * FROM tbl_parte where id_parte='$id_parte'";
$resul= mysql_query($consulta,$link);
$row = mysql_fetch_array($resul);
?>

     <html>
         <head>
             <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
             <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
			 <!--para el slider -->
			 <script src="js/jquery-1.7.min.js" type="text/javascript"></script>
			<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
			<script src="js/jquery.easing.compatibility.js" type="text/javascript"></script>
			<script src="js/jquery.slideviewer.1.2.js" type="text/javascript"></script>
			<!-- fin scripts para el slider -->
            <title>Fotos</title>
			<script type="text/javascript">
				$(window).bind("load", function() {
					$("div#mygalone").slideView({toolTip: true, ttOpacity: 0.5}) // ttOpacity can be 0.1 to 1.0
				});
			</script>
         </head>
         <body>
             <div id="con_img">
                 <div id="contenedor-logo1">
            <div class="logo1"></div>
            <div class="botonera_superior">
            <input type="button" id="reg" name="reg" value="Regresar al menu" class="bot" <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?>>
		<input type="button" id="print" name="print" value="Imprimir fotos" class="bot">
			<script type="text/javascript">
				$(document).ready(function(){
					$('#print').click(function(){
						var tabla = "<table>";
						iterator = 0;
						$('div#mygalone li').each(function(){
							if(iterator % 2 == 0) {
								tabla += "<tr>";
							}
							tabla += "<td>" + $(this).html() + "</td>";
							if(iterator % 2 == 1){
								tabla += "</tr>";
							}
							iterator++;
						});
						tabla += "</table>";
						var ventimp=window.open(' ','popimpr');
						ventimp.document.write(tabla);
						ventimp.document.close();
						ventimp.print();
						ventimp.close();
					});
				});
				
			</script>
            <br><br><br>
            <div class="datos" ><b><h3>Número del Parte: <?php echo $id_parte ?></h3></b></div>
            </div>
            
            </div>
                 <center><div id="mygalone" class="svw">
             <?php

                $dir = "files/$id_parte";
                if((is_dir($dir))==''){
                   echo '<b><h3>No existen fotos relacionadas al parte '.$id_parte.'</h3></b>';
                }else{
                    $directorio=opendir($dir);
					echo "<ul>";
					while ($archivo = readdir($directorio)) {
						
						if($archivo!= "." && $archivo != ".." && $archivo!="Thumbs.db"){
							echo "<li><img id='image$cont' alt='$archivo' src='$dir/$archivo' width='450px'></li>";
							$cont++;
						}
					}
					closedir($directorio);
					echo "</ul>";
                }
             ?>
                    </div></center>
             </div>
         </body>
     </html>