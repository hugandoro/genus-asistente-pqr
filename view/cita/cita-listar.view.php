<!-- Vista para pantalla resultados de la busqueda de historias clinicas con aplicacion de filtros -->
<h6 class="page-header">
    GECOPA - CITAS MEDICAS - Cronologia de citas medicas
</h6>

<div class="well well-sm">

<!-- Datos basicos del paciente y su historia clinica -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Documento N°</th>
                <th>1er Nombre</th>
                <th class="visible-md visible-lg">2do Nombre</th>
                <th>1er Apellido</th>
                <th class="visible-md visible-lg">2do Apellido</th>
                <th style="width:20px;"></th>
                <th style="width:20px;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($this->modelHistoria->listarSinComodin($_REQUEST['filtro'],$this->auth->usuario()->medico_id) as $h): ?>
                <tr>
                    <td><?php echo $h->historia_cedula; ?></td>
                    <td><?php echo $h->historia_nombre_1; ?></td>
                    <td class="visible-md visible-lg"><?php echo $h->historia_nombre_2; ?></td>
                    <td><?php echo $h->historia_apellido_1; ?></td>
                    <td class="visible-md visible-lg"><?php echo $h->historia_apellido_2; ?></td>
                    <td><a href="?c=Cita&a=Crud&id=<?php echo $h->historia_id; ?>&token=<?php echo @$_GET['token']; ?>"><button class="btn btn-success btn-xs">Crear cita</button></a></td>
                    <td><a href="?c=Historia&a=Crud&id=<?php echo $h->historia_id; ?>&token=<?php echo @$_GET['token']; ?>"><button class="btn btn-success btn-xs">Abrir historia</button></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 

<!-- Historial de citas relacionadas con el ID de la historia clinica -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cita ID</th>
                <th>Fecha</th>
                <th style="width:20px;"></th>
                <th style="width:20px;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($this->modelCita->listarCitas($h->historia_id) as $c): ?>
                <tr>
                    <td><?php echo $c->cita_id; ?></td>
                    <td><?php echo $c->cita_fecha; ?></td>
                    <td><a href="?c=Cita&a=Crud&id=<?php echo $h->historia_id; ?>&idCita=<?php echo $c->cita_id; ?>&token=<?php echo @$_GET['token']; ?>"><img src="assets/img/abrir.png" width=16px title="Ver cita medica"></a></td>
                    <td><a onclick="javascript:return confirm('¿Seguro de eliminar esta cita medica ?');" href="?c=Cita&a=eliminarCita&idCita=<?php echo $c->cita_id; ?>&idHistoria=<?php echo $h->historia_id; ?>&filtro=<?php echo $h->historia_cedula; ?>&token=<?php echo @$_GET['token']; ?>"><img src="assets/img/eliminar.png" width=16px title="Eliminar cita medica"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 

</div>


