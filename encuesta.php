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

<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
		include 'funciones.php';
		$link=Conectarse();
		?>

		<meta charset="UTF-8">
		<title>Registro de encuesta</title>

		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<script src="js/jquery-1.7.min.js"></script>

		<script>
			$(document).ready(function(){

			});
		</script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
	</head>
	<body>
        <div id="contenedor_us_inc">
			<!-- Logo -->
			<div id="contenedor-logo">
	            <div class="logo"></div>
	        </div>

			<!-- Encabezados -->
	        <div class="encabezado">
            	<!-- Id del parte -->
	            <div class="global">
					<div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="id_parte" name="id_parte" class="sen-class" autofocus>
                    </div>
	        	</div>
	        	
            	<!-- Nombre del usuario -->
	            <div class="global">
					<div class="titulos">
                        <b>Nombre del usuario</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="nombre_usuario" name="nombre_usuario" class="sen-class"  >
                    </div>
	        	</div>

            	<!-- Tipo de servicio -->
	            <div class="global">
					<div class="titulos">
                        <b>Tipo de servicio</b>
                    </div>
                    <div class="campos">
                        <select name="tipo_servicio" id="tipo_servicio" class="sen-class">
                        	<option value="1">Accidente</option>
                        	<option value="3">Grúa planchón</option>
                        	<option value="2">Incidencia</option>
                        </select>
                    </div>
	        	</div>

            	<!-- Teléfono del usuario -->
	            <div class="global">
					<div class="titulos">
                        <b>Teléfono</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="telefono_usuario" name="telefono_usuario" class="sen-class" >
                    </div>
	        	</div>

            	<!-- Email del usuario -->
	            <div class="global">
					<div class="titulos">
                        <b>Correo electrónico</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="email_usuario" name="email_usuario" class="sen-class" >
                    </div>
	        	</div>
	        </div><!-- Encabezados -->
			
			<!-- Preguntas -->
            <div class="cont_us_inc">
            	<div class="encabezado">
            		<table id="tbl_encuesta" border="1" style="width: 100%; ">
            			<thead>
            				<th>Ítem</th>
            				<th>Factor a evaluar</th>
            				<th>No aplica</th>
            				<th>No sabe</th>
            				<th>No responde</th>
            				<th>Muy satisfecho</th>
            				<th>Satisfecho</th>
            				<th>Insatisfecho</th>
            			</thead>
            			<tbody>
            				<?php
            				$sql_preguntas = "select * from tbl_preguntas_encuestas";
                            $resultado =  mysql_query($sql_preguntas,$link);

                            // Se recorren los registros resultantes
                            while ($pregunta = mysql_fetch_assoc($resultado)){
            				?>
	            				<tr>
		            				<td align="right"><?php echo $pregunta["id"]; ?></td>
		            				<td align="left"><?php echo utf8_encode($pregunta["Descripcion"]); ?></td>
		            				<td>
		            					<input name="pregunta[<?php echo $pregunta['id']; ?>]" type="radio" value="6" data-id="<?php echo $pregunta['id']; ?>" checked>
		            				</td>
		            				<td>
		            					<input name="pregunta[<?php echo $pregunta['id']; ?>]" type="radio" value="5" data-id="<?php echo $pregunta['id']; ?>">
		            				</td>
		            				<td>
		            					<input name="pregunta[<?php echo $pregunta['id']; ?>]" type="radio" value="4" data-id="<?php echo $pregunta['id']; ?>">
		            				</td>
		            				<td>
		            					<input name="pregunta[<?php echo $pregunta['id']; ?>]" type="radio" value="3" data-id="<?php echo $pregunta['id']; ?>">
		            				</td>
		            				<td>
		            					<input name="pregunta[<?php echo $pregunta['id']; ?>]" type="radio" value="2" data-id="<?php echo $pregunta['id']; ?>">
		            				</td>
		            				<td>
		            					<input name="pregunta[<?php echo $pregunta['id']; ?>]" type="radio" value="1" data-id="<?php echo $pregunta['id']; ?>">
		            				</td>
		            			</tr>
	            			<?php } // while ?>
            			</tbody>
            		</table>

            		<!-- Botones -->
            		<p>
	                    <input type="submit" onClick="javascript:guardar()" name="guargar" Value="Guardar" class="bot">
	                    <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                    </p>
            	</div>
        	</div><!-- Preguntas -->
        </div>
	</body>
</html>

<script type="text/javascript">
	function guardar(){
		// Declaración de variables
		var id_parte = $("#id_parte");
		var nombre_usuario = $("#nombre_usuario");
		var telefono_usuario = $("#telefono_usuario");
		var tipo_servicio = $("#tipo_servicio");
		var email_usuario = $("#email_usuario");

		// Si no tiene número de parte
		if ($.trim(id_parte.val()) == "") {
			// Mensaje de error
			alert("Digite un número de consecutivo");

			return false;
		};

		// Arreglo con los datos a guardar
		datos_encuesta = {
			"id_parte": id_parte.val(),
			"nombre_usuario": nombre_usuario.val(),
			"telefono_usuario": telefono_usuario.val(),
			"tipo_servicio": tipo_servicio.val(),
			"email_usuario": email_usuario.val()
		}
		// console.log(datos_encuesta);

		// Se guarda la encuesta vía Ajax
		$.ajax({
	        url: "guardar_encuesta.php",
	        data: datos_encuesta,
	        type: "POST",
	        dataType: "html",
	        async: false,
	        success: function(respuesta){
	            //Si la respuesta no es error
	            if(respuesta){
	                //Se almacena la respuesta como variable de éxito
	                exito = respuesta;
	            } else {
	                //La variable de éxito será un mensaje de error
	                exito = 'error';
	            } //If
	        },//Success
	        error: function(respuesta){
	            //Variable de exito será mensaje de error de ajax
	            exito = respuesta;
	        }//Error
	    });//Ajax

		// Se recoge el id de la encuesta creada
	    id_encuesta = exito;

		// Se declara un arreglo para guardar las respuestas
	    var respuestas = new Array();

		//Se recorren los chequeados
	    $("input[name^='pregunta']:checked").each(function() {
	    	var datos = {
	    		"id_pregunta": $(this).attr("data-id"),
	    		"valor": $(this).val()
	    	}

	    	// Se agrega al arreglo
	    	respuestas.push(datos)
	    });//each

		// Se guarda las respuestas vía Ajax
		$.ajax({
	        url: "guardar_respuestas.php",
	        data: {"id_encuesta": id_encuesta, "datos": respuestas},
	        type: "POST",
	        dataType: "html",
	        async: false,
	        success: function(respuesta){
	            //Si la respuesta no es error
	            if(respuesta){
	                //Se almacena la respuesta como variable de éxito
	                exito2 = respuesta;
	            } else {
	                //La variable de éxito será un mensaje de error
	                exito2 = 'error';
	            } //If
	        },//Success
	        error: function(respuesta){
	            //Variable de exito será mensaje de error de ajax
	            exito2 = respuesta;
	        }//Error
	    });//Ajax
        
        // Si se guarda correctamente
        if (exito2) {
        	alert("Se ha guardado con éxito la encuesta al consecutivo " + id_parte.val());

        	// se redirecciona al inicio
        	location.href = "menu_insp.php";
        } else {
        	alert("No se pudo guardar la encuesta al consecutivo " + id_parte.val());
        }
	} // guardar
</script>