<?php
include 'funciones.php';
$consulta = mysql_query("Select * from tbl_accidente order by id_parte", Conectarse());
$ruta = "files/";

$total = 0;
$sin_fotos = 0;
$con_fotos = 0;
foreach(glob("*") as $archivo){
    $total++;
}
                    
echo "Hay en total ".mysql_num_rows($consulta)." accidentes y ".$total." fotos. Faltan partes por ingresar fotos";
?>

<html>
    <head>
        <title>Pintar accidentes</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <td>Parte</td>
                <td>Fotos</td>
            </tr>
                <?php
                $contador = 1;
                while($row = mysql_fetch_array($consulta)) {
                ?>
            <tr>
                <td>
                    <?php echo $row['id_parte']; ?>
                </td>
                <td>
                    <?php
                    $numero_archivos = 0;
                    foreach(glob($ruta.$row['id_parte']."/*") as $archivo){
                        $numero_archivos++;
                    }
                    //echo $ruta.$row['id_parte'];
                    echo $numero_archivos;
                    
                    if($numero_archivos != 0){
                        $insercion = "update tbl_accidente set fotos = 1 where id_parte = ".$row['id_parte'];
                        mysql_query($insercion, Conectarse());
                    }
                    
                    if($numero_archivos == 0){
                        $sin_fotos++;
                    }else{
                        $con_fotos++;
                    }
                    ?>
                </td>
            </tr>
                <?php
                }
                ?>
        </table>
        <?php
        echo $sin_fotos;
        echo '+'.$con_fotos.'=';
        echo $sin_fotos+$con_fotos; ?>
    </body>
</html>
