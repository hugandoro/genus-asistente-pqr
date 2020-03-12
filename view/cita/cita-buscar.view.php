<!-- Vista para pantalla buscar una historia clinica por filtro -->
<h6 class="page-header">
    GECOPA - CITAS MEDICAS - Busqueda especifica de historia clinica
</h6>

<div class="well well-sm text-right">
    <form id="frm-historia" action="?c=Cita&a=listarCitas&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data"> 
        <div class="form-group">
            <label>Filtro de busqueda</label>
            <input type="number" name="filtro" class="form-control" placeholder="PARA BUSCAR O CREAR UNA CITA Digite el N° de documento de identificacion del paciente" data-validacion-tipo="requerido|min:1" />
        </div>

        <div class="text-right">
            <button class="btn btn-success">Buscar</button>
        </div>
</div>

<script>
    $(document).ready(function(){
        $("#frm-historia").submit(function(){
            return $(this).validate();
        });
    })
</script>