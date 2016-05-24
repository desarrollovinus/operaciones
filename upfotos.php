<?php $explorer = ereg("MSIE",$_SERVER["HTTP_USER_AGENT"]); ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script language="javascript" src="js/validaciones.js" type="text/javascript"></script>
        <title>Subir fotos</title>
    </head>
    <body>
        <div id="up">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <div class="titulo"><br><b>SUBIR FOTOS</b></div>
                <form name="formu" id="formu" action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="textos">NUMERO DEL PARTE</div>
                    <div class="campos"><input type="text" id="parte" name="parte" class="camp"/></div>
                    <dl>
                        <!-- Esta div contendrá todos los campos file que creemos -->
                        <div class="camp1">
                            <div id="adjuntos">
                                <!-- Hay que prestar atención a esto, el nombre de este campo debe siempre terminar en []
                                como un vector, y ademas debe coincidir con el nombre que se da a los campos nuevos
                                en el script -->
                                <div id="file1" class="archivo">
                                    <input type="file" name="archivos[]"  <?php if(!$explorer){ echo 'multiple="multiple"'; } ?> />&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp     
                                </div>
                            </div>
                                <dt><?php if($explorer){ echo '<a href="#" onClick="addCampo()">Subir otra foto</a>'; } ?></dt><br>
                        </div>
                        <div class="boton"><input name="envia" id="envia" type="submit" value="Subir Fotos" class="bot"/></div>
                    </dl>
                </form>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        //Esta es una variable de control para mantener nombres
        var numero = 0;
        
        //diferentes de cada campo creado dinamicamente.
        //esta funcion nos devuelve el tipo de evento disparado
        evento = function (evt) { 
           return (!evt) ? event : evt;
        }

        //Aqui se hace lamagia... jejeje, esta funcion crea dinamicamente los nuevos campos file
        addCampo = function () {
            //Creamos un nuevo div para que contenga el nuevo campo
            nDiv = document.createElement('div');
            //con esto se establece la clase de la div
            nDiv.className = 'archivo';
            //este es el id de la div, aqui la utilidad de la variable numero
            //nos permite darle un id unico
            nDiv.id = 'file' + (++numero);
            //creamos el input para el formulario:
            nCampo = document.createElement('input');
            //le damos un nombre, es importante que lo nombren como vector, pues todos los campos
            //compartiran el nombre en un arreglo, asi es mas facil procesar posteriormente con php
            nCampo.name = 'archivos[]';
            //Establecemos el tipo de campo
            nCampo.type = 'file';

            //Ahora creamos un link para poder eliminar un campo que ya no deseemos
            a = document.createElement('a');
            //El link debe tener el mismo nombre de la div padre, para efectos de localizarla y eliminarla
            a.name = nDiv.id;
            //Este link no debe ir a ningun lado
            a.href = '#';
            //Establecemos que dispare esta funcion en click
            a.onclick = elimCamp;
            //Con esto ponemos el texto del link
            a.innerHTML = 'Eliminar';
            //Bien es el momento de integrar lo que hemos creado al documento,
            //primero usamos la función appendChild para adicionar el campo file nuevo
            nDiv.appendChild(nCampo);
            //Adicionamos el Link
            nDiv.appendChild(a);
            //Ahora si recuerdan, en el html hay una div cuyo id es 'adjuntos', bien
            //con esta función obtenemos una referencia a ella para usar de nuevo appendChild
            //y adicionar la div que hemos creado, la cual contiene el campo file con su link de eliminación:
            container = document.getElementById('adjuntos');
            container.appendChild(nDiv);
        }
        
        //con esta función eliminamos el campo cuyo link de eliminación sea presionado
        elimCamp = function (evt){
            evt = evento(evt);
            nCampo = rObj(evt);
            div = document.getElementById(nCampo.name);
            div.parentNode.removeChild(div);
        }
        
        //con esta función recuperamos una instancia del objeto que disparo el evento
        rObj = function (evt) {
            return evt.srcElement ?  evt.srcElement : evt.target;
        }
    </script>
</html>