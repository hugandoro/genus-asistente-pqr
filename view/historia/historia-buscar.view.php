<!-- Vista para pantalla buscar una historia clinica por filtro -->
<h6 class="page-header">
    GECOPA - HISTORIAS CLINICAS - Filtros de busqueda para historias clinicas
</h6>

<div class="well well-sm text-right">
    <form id="frm-historia" action="?c=Historia&a=listar&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data"> 
        <div class="form-group">
            <label>Filtro de busqueda</label>
            <input type="text" name="filtro" class="form-control" placeholder="PARA BUSCAR UNA HISTORIA Digite un nombre, apellido o documento de identificacion" />
        </div>

        <div class="text-right">
            <button class="btn btn-success">Buscar por filtro GENERAL</button>
        </div>
</div>

<div class="well well-sm text-right">
    <form id="frm-historia" action="?c=Historia&a=listar&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data"> 
        <div class="form-group">
            <label>Filtros de busqueda</label>
            <input type="text" name="filtroA" class="form-control" placeholder="Digite PRIMER NOMBRE" />
            <input type="text" name="filtroB" class="form-control" placeholder="Digite SEGUNDO NOMBRE" />
            <input type="text" name="filtroC" class="form-control" placeholder="Digite PRIMER APELLIDO" />
            <input type="text" name="filtroD" class="form-control" placeholder="Digite SEGUNDO APELLIDO" />
        </div>

        <div class="text-right">
            <button class="btn btn-success">Buscar por filtro COMBINACION DE CAMPOS</button>
        </div>
</div>

<script>
    $(document).ready(function(){
        $("#frm-historia").submit(function(){
            return $(this).validate();
        });
    })


</script>