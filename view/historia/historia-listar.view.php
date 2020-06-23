<!-- CALCULO PARA ESTADISTICOS - Cabezera de pagina - botones -->
<?php 
    // Obtiene los filtros POST si llegan por un formulario ( Filtro por funcionario ) o GET si llegan por un boton
    if (isset($_POST['funcionario'])){
        $funcionario = $_POST['funcionario'];
        $filtro = $_POST['filtro'];
    }
    else{
        $funcionario = $_GET["funcionario"]; 
        $filtro = $_GET["filtro"]; 
    }
    // FIN captura de filtros


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

        //Valida si la consulta trae un filtro FUNCIONARIO que exluya la consulta General
        if ($funcionario != ''){
            if ($funcionario ==  $r->historia_funcionario){
                $pqrTodas++;
                
                if (($diasRestantes > 5) && ($r->historia_fecha_respuesta == NULL))
                    $pqrTerminos++;

                if ((($diasRestantes <= 5) && ($diasRestantes > 0)) && ($r->historia_fecha_respuesta == NULL))
                    $pqrVencer++;

                if (($diasRestantes < 1) && ($r->historia_fecha_respuesta == NULL))
                    $pqrVencidas++;

                if (($r->historia_fecha_respuesta == NULL))
                    $pqrAbiertas++;
            }
        }
        else {
            $pqrTodas++;
                
            if (($diasRestantes > 5) && ($r->historia_fecha_respuesta == NULL))
                $pqrTerminos++;

            if ((($diasRestantes <= 5) && ($diasRestantes > 0)) && ($r->historia_fecha_respuesta == NULL))
                $pqrVencer++;

            if (($diasRestantes < 1) && ($r->historia_fecha_respuesta == NULL))
                $pqrVencidas++;

            if (($r->historia_fecha_respuesta == NULL))
                $pqrAbiertas++;
        }
            
    endforeach;
?>
<!-- *** FIN CALCULO PARA ESTADISTICOS - Cabezera de pagina - botones -->


<!-- Vista para pantalla resultados de la busqueda de historias clinicas con aplicacion de filtros -->
<h6 class="page-header">
    ASISTENTE PQR - Web 
</h6>

<div class="form-group col-md-2">
    <a href="?c=Historia&a=listar&token=<?php echo @$_GET['token']; ?>&filtro=terminos&funcionario=<?php echo $funcionario;?>">
        <button class="btn btn-success btn-xs" name="btn-filtrar" id="btn-filtrar">Filtrar PQR TERMINOS ( <?php echo $pqrTerminos; ?>)</button>
    </a>
</div>

<div class="form-group col-md-2">
    <a href="?c=Historia&a=listar&token=<?php echo @$_GET['token']; ?>&filtro=vencer&funcionario=<?php echo $funcionario;?>">
        <button class="btn btn-warning btn-xs" name="btn-filtrar" id="btn-filtrar">Filtrar PQR POR VENCER ( <?php echo $pqrVencer; ?>)</button>
    </a>
</div>

<div class="form-group col-md-2">
    <a href="?c=Historia&a=listar&token=<?php echo @$_GET['token']; ?>&filtro=vencidas&funcionario=<?php echo $funcionario;?>">
        <button class="btn btn-danger btn-xs" name="btn-filtrar" id="btn-filtrar">Filtrar PQR VENCIDAS ( <?php echo $pqrVencidas; ?>)</button>
    </a>
</div>

<div class="form-group col-md-2">
    <a href="?c=Historia&a=listar&token=<?php echo @$_GET['token']; ?>&filtro=abiertas&funcionario=<?php echo $funcionario;?>">
        <button class="btn btn-default btn-xs" name="btn-filtrar" id="btn-filtrar">Filtrar PQR ABIERTAS ( <?php echo $pqrAbiertas; ?>)</button>
    </a>
</div>

<div class="form-group col-md-4 style=display: block;">
    <form action="?c=Historia&a=listar&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data">
        <?php $filtro = $_GET["filtro"]; ?> 
        <input type="hidden" name="filtro" value="<?php echo $filtro; ?>" />

        <select name="funcionario" id="funcionario" class="form-control">
            <option value='' selected>TODOS LOS FUNCIONARIOS</option>
            <?php foreach($this->modelMedico->listarUsuarios() as $r): ?>
                <option value=<?php echo $r->medico_id; ?>><?php echo $r->medico_nombres; ?> <?php echo $r->medico_apellidos; ?></option>
            <?php endforeach; ?>
        </select>

        <button class="btn btn-default btn-xs" name="btn-filtrar" id="btn-filtrar">Filtrar por Funcionario</button>
    </form>

</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>N° Rad. Planeacion</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Clase</th>
            <th>Estado</th>
            <th>Radicado gestion</th>
            <th>Vencimiento</th>
            <th>Dias</th>
            <th>Funcionario</th>
            <th></th>
            <th style="width:20px;"></th>
            <th style="width:20px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->modelHistoria->Listar($this->auth->usuario()->medico_id,$this->auth->usuario()->medico_nivel,$this->auth->usuario()->medico_dependencia_codigo) as $r): ?>

        <!-- Calculo fecha de vencimiento -->
        <?php
            $sumarDias = $r->historia_dias; //Dias que se establecieron como plazo para responder
            $fechaVencimiento = $this->modelHistoria->sumasDiaSemana($r->historia_radicado_gestion,$sumarDias);

            $fechaActual= date("Y/m/d");
            $diasRestantes = $this->modelHistoria->diasPasados($fechaVencimiento,$fechaActual);

            if ($diasRestantes > 5) $imagenSemaforo = 'assets/img/verde.png';
            if ($diasRestantes <= 5) $imagenSemaforo = 'assets/img/amarillo.png';
            if ($diasRestantes < 1) $imagenSemaforo = 'assets/img/rojo.png';

        ?>
        <!-- Fin calculo fechas de vencimiento -->

        <!-- Filtro para determinar que registros pasan los filtros y se pueden visualizar -->
        <?php 
            if (    
                    ((($filtro == 'terminos') && ($diasRestantes > 5) && ($r->historia_fecha_respuesta == NULL)) || 
                    (($filtro == 'vencer')   && (($diasRestantes <= 5) && ($diasRestantes > 0)) && ($r->historia_fecha_respuesta == NULL)) ||
                    (($filtro == 'vencidas') && ($diasRestantes < 1) && ($r->historia_fecha_respuesta == NULL)) ||
                    (($filtro == 'abiertas') && ($r->historia_fecha_respuesta == NULL)) ||
                    (($filtro == ''))) 
                    && (($funcionario == '') || ($funcionario == $r->historia_funcionario))
                ) {
        ?>

        <tr>
            <td><?php echo $r->historia_num_radicado_planeacion; ?></td>
            <td><?php echo $r->historia_nombre_1; ?></td>
            <td><?php echo $r->historia_apellido_1; ?></td>
            <td><?php echo $r->historia_clase_pqr; ?></td>
            <td><?php if($r->historia_fecha_respuesta == NULL) echo "Abierta"; else echo "Cerrada" ?></td>
            <td><?php echo $r->historia_radicado_gestion; ?></td>
            <td><?php echo $fechaVencimiento; ?></td>
            <td><?php if($r->historia_fecha_respuesta == NULL) echo $diasRestantes; else echo "-" ?></td>
            <td><?php echo $r->medico_nombres; ?> <?php echo $r->medico_apellidos; ?></td>

            <td>
                <?php if($r->historia_fecha_respuesta == NULL) echo "<img src='$imagenSemaforo' width=16px title='Semaforo PQR'>" ; else echo "-" ?>
            </td>

            <td>
                <a href="?c=Historia&a=Crud&id=<?php echo $r->historia_id; ?>&token=<?php echo @$_GET['token']; ?>"><img src="assets/img/abrir.png" width=16px title="Abrir historia"></a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿ Seguro de eliminar este registro ? Esta accion es irreversible...');" href="?c=Historia&a=Eliminar&id=<?php echo $r->historia_id; ?>&filtro=<?php echo $_REQUEST['filtro']; ?>&token=<?php echo @$_GET['token']; ?>"><img src="assets/img/eliminar.png" width=16px title="Eliminar historia"></a>
            </td>
        </tr>

        <?php } ?>

    <?php endforeach; ?>
    </tbody>
</table> 
