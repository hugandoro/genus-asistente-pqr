<!-- Vista para CRUD a la base de datos Nuevo registro o modo edicion -->
<h6 class="page-header">
    <?php echo $historiaMedica->historia_id != null ? 'GECOPA - HISTORIAS CLINICAS - Consultar historia clinica' : 'GECOPA - HISTORIAS CLINICAS - Crear nueva historia clinica'; ?> <!-- ORGANIZAR -->
</h6>

<ol class="breadcrumb">
  <li><a href="?c=Historia&token=<?php echo @$_GET['token']; ?>">Historias clinicas</a></li>
  <li class="active"><?php echo $historiaMedica->historia_id != null ? $historiaMedica->historia_nombre_1 : 'Nuevo Registro'; ?></li> <!-- ORGANIZAR -->
</ol>

<form class="col-md-12" id="frm-historia" action="?c=Historia&a=guardar_Previo&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $historiaMedica->historia_id; ?>" />
        
    <div class="container-fluid shadow">
        <div class="row">     
            <div class="row" id="tab0" data-role="tab">
                <!-- Coleccion menu pestañas de TAB -->
                <ul class="nav nav-tabs">
                    <li class="active"><a id="tabLabel1" href="#tabContent1" data-toggle="tab">Identificacion</a></li>
                </ul>

                <div class="tab-content">
                    <!-- TAB Identificacion -->
                    <div class="tab-pane active" id="tabContent1">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="fecha">Fecha de registro</label>
                                        <input onblur="Mayuscula(this);" readonly value="<?php echo $historiaMedica->historia_fecha; ?>" name="fecha" id="fecha" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="cedula">Documento de identificacion</label>
                                        <input onblur="Mayuscula(this);" <?php echo $cedLectura;?> value="<?php echo $historiaMedica->historia_cedula; ?>" name="cedula" id="cedula" type="number" class="form-control" placeholder="Solo numeros sin puntos o comas">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  
    <div class="form-group col-md-8 text-right" style="display: block;">
        <button class="btn btn-success" name="btn-guardar" id="btn-guardar">Crear Historia</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-historia").submit(function(){
            return $(this).validate();
        });

        //Validar alteraciones a valores originales y aviso al usuario de pendiente guardar cambios
        $('#frm-historia').on('input', ':input', function() { 
            var value = $(this).val(); 
            if (value.length > 0){ 
                //$(this).removeClass('lost');
                $(this).addClass('btn-info');
                $('#btn-guardar').addClass('btn-info');
            }
        });
    })

    function Mayuscula(caracter) {
        caracter.value = caracter.value.toUpperCase();
    }
</script>