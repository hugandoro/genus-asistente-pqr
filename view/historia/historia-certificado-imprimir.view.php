<!DOCTYPE html>
<html lang="es">
	<head>
		<title>PQR - Planeacion - Dosquebradas</title>
        <meta charset="utf-8" />

        <style type="text/css" media="print">
            @page{
                margin-top: -50px;
            }
        </style>
        <style>
            body {
                font-family: 'trebuchet ms', verdana, sans-serif;
            }
            table {
                border: 1px solid #000;
                border-spacing: 2px;
                margin: 5em auto 5em auto;
            }
            td {
                border-width: 5px;
                padding: 0.5em;
            }
        </style>

        <script>
            function printDiv(nombreDiv) {
                document.getElementById(nombreDiv).style.marginRight  = "0";
                document.getElementById(nombreDiv).style.marginTop = "0";
                document.getElementById(nombreDiv).style.marginLeft = "0";
                document.getElementById(nombreDiv).style.marginBottom = "0";
                document.getElementById('botonPrint').style.display = "none";

                var contenido= document.getElementById(nombreDiv).innerHTML;
                var contenidoOriginal= document.body.innerHTML;
                document.body.innerHTML = contenido;
                window.print();
                document.body.innerHTML = contenidoOriginal;
            }
        </script>
	</head>

    <?php
        $pqrTodas = isset($_REQUEST['pqrTodas']) ? $_REQUEST['pqrTodas'] : '';
        $pqrAbiertas = isset($_REQUEST['pqrAbiertas']) ? $_REQUEST['pqrAbiertas'] : '';
        $pqrTerminos = isset($_REQUEST['pqrTerminos']) ? $_REQUEST['pqrTerminos'] : '';
        $pqrVencer = isset($_REQUEST['pqrVencer']) ? $_REQUEST['pqrVencer'] : '';
        $pqrVencidas = isset($_REQUEST['pqrVencidas']) ? $_REQUEST['pqrVencidas'] : '';
        $nombresUsuario = isset($_REQUEST['nombresUsuario']) ? $_REQUEST['nombresUsuario'] : '';
        $apellidosUsuario = isset($_REQUEST['apellidosUsuario']) ? $_REQUEST['apellidosUsuario'] : '';
        $fecha = date("Y-m-d");
    ?>

    <body id="cuerpoPagina">
        <div>
            <table>
                <tr>
                    <td colspan="2">
                        <H3>ALCALDIA DE DOSQUEBRADAS</H3>Secretaria de Planeacion Municipal<br>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        El dia de hoy <b><?php echo $fecha; ?></b> para la fecha y hora, el usuario <b><?php echo $nombresUsuario; ?></b> <b><?php echo $apellidosUsuario; ?></b> presenta el siguiente consolidado de seguimiento a PQR...
                    </td>             
                </tr>

                <tr>
                    <td colspan="2"><hr></td>
                </tr>

                <tr>
                    <td>N° total de PQR cargadas a su nombre</td>
                    <td style="font-size:15px"><?php echo $pqrTodas; ?></td>
                </tr>

                <tr>
                    <td>N° total de PQR en estado ABIERTO</td>
                    <td style="font-size:15px"><?php echo $pqrAbiertas; ?></td>
                </tr>

                <tr>
                    <td colspan="2"><hr></td>
                </tr>

                <tr>
                    <td>N° total de PQR en estado en semaforo VERDE (Dentro de los terminos)</td>
                    <td style="font-size:15px"><?php echo $pqrTerminos; ?></td>
                </tr>

                <tr>
                    <td>N° total de PQR en estado en semaforo AMARILLO (Proximas a vencer)</td>
                    <td style="font-size:15px"><?php echo $pqrVencer; ?></td>
                </tr>

                <tr>
                    <td style="font-size:20px"><b>N° total de PQR en estado en semaforo ROJO (Vencidas)<b></td>
                    <td style="font-size:30px"><b>*** <?php echo $pqrVencidas; ?> ***</b></td>
                </tr>

                <tr>
                    <td colspan="2"><hr></td>
                </tr>

            </table> 
        </div>

        <center><input type="button" id= "botonPrint" onclick="printDiv('cuerpoPagina')" value="Imprimir CERTIFICADO" /></center>
    </body>
</html>