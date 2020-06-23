<!-- CALCULO PARA ESTADISTICOS - Cabezera de pagina - botones -->
<?php 
    $filtro = $_GET["filtro"]; 

    // Contadores de PQRs discriminadas por estado actual
    $pqrTerminos = 0;
    $pqrVencer = 0;
    $pqrVencidas = 0;
    $pqrAbiertas = 0;
    $pqrTodas = 0;

    // Recorrido de todos los registros para clasificar y mover los contadores segun estado de las PQR
    foreach($this->modelHistoria->Listar($this->auth->usuario()->medico_id,$this->auth->usuario()->medico_nivel,$this->auth->usuario()->medico_dependencia_codigo) as $r): 

        // Calculo fecha de vencimiento -->
        $sumarDias = $r->historia_dias; //Dias que se establecieron como plazo para responder
        $fechaVencimiento = $this->modelHistoria->sumasDiaSemana($r->historia_radicado_gestion,$sumarDias);

        $fechaActual= date("Y/m/d");
        $diasRestantes = $this->modelHistoria->diasPasados($fechaVencimiento,$fechaActual);
        // Fin calculo fechas de vencimiento


        $pqrTodas++;
                
        if (($diasRestantes > 5) && ($r->historia_fecha_respuesta == NULL))
            $pqrTerminos++;

        if ((($diasRestantes <= 5) && ($diasRestantes > 0)) && ($r->historia_fecha_respuesta == NULL))
            $pqrVencer++;

        if (($diasRestantes < 1) && ($r->historia_fecha_respuesta == NULL))
            $pqrVencidas++;

        if (($r->historia_fecha_respuesta == NULL))
            $pqrAbiertas++;
            
    endforeach;
?>
<!-- *** FIN CALCULO PARA ESTADISTICOS - Cabezera de pagina - botones -->


<!-- Vista para pantalla resultados de la busqueda de historias clinicas con aplicacion de filtros -->
<h6 class="page-header">
    ASISTENTE PQR - Web 
</h6>

<div class="form-group col-md-12">
    <?php echo "Total PQR registradas en el sistema <b>$pqrTodas</b>"; ?>
</div>

<div class="form-group col-md-12">
    <?php echo "PQR Abiertas sin cerrar a la fecha <b>$pqrAbiertas</b>"; ?>
</div>

<div class="form-group col-md-12">
    <?php echo "PQR Abiertas y dentro de los terminos <b>$pqrTerminos</b>"; ?>
</div>

<div class="form-group col-md-12">
    <?php echo "PQR Abiertas por vencer <b>$pqrVencer</b>"; ?>
</div>

<div class="form-group col-md-12">
    <?php echo "PQR Abiertas y vencidas <b>$pqrVencidas</b>"; ?>
</div>

<div class="form-group col-md-12 text-left" style="display: block;">
        <a href="view/historia/historia-certificado-imprimir.view.php?
        &pqrTodas=<?php echo $pqrTodas; ?>
        &pqrAbiertas=<?php echo $pqrAbiertas; ?>
        &pqrTerminos=<?php echo $pqrTerminos; ?>
        &pqrVencer=<?php echo $pqrVencer; ?>
        &pqrVencidas=<?php echo $pqrVencidas; ?>
        &nombresUsuario=<?php echo $this->auth->usuario()->medico_nombres; ?>
        &apellidosUsuario=<?php echo $this->auth->usuario()->medico_apellidos; ?>"

        target="_blank">Vista de impresion</a>
</div>



