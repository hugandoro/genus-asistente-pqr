<!-- Vista para CRUD a la base de datos Nuevo registro o modo edicion -->
<h6 class="page-header">
    <?php echo $historiaMedica->historia_id != null ? 'GECOPA - HISTORIAS CLINICAS - Consultar historia clinica' : 'GECOPA - HISTORIAS CLINICAS - Crear nueva historia clinica'; ?> <!-- ORGANIZAR -->
</h6>

<ol class="breadcrumb">
  <li><a href="?c=Historia&token=<?php echo @$_GET['token']; ?>">Historias clinicas</a></li>
  <li class="active"><?php echo $historiaMedica->historia_id != null ? $historiaMedica->historia_nombre_1 : 'Nuevo Registro'; ?></li> <!-- ORGANIZAR -->
</ol>

<form class="col-md-12" id="frm-historia" action="?c=Historia&a=Guardar&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $historiaMedica->historia_id; ?>" />
        
    <div class="container-fluid shadow">
        <div class="row">     
            <div class="row" id="tab0" data-role="tab">
                <!-- Coleccion menu pestañas de TAB -->
                <ul class="nav nav-tabs">
                    <li class="active"><a id="tabLabel1" href="#tabContent1" data-toggle="tab">Identificacion</a></li>
                    <li><a id="tabLabel2" href="#tabContent2" data-toggle="tab">Antecedentes personales y familiares</a></li>
                    <li><a id="tabLabel3" href="#tabContent3" data-toggle="tab">Ficha ginecobstretica</a></li>
                    <li><a id="tabLabel4" href="#tabContent4" data-toggle="tab">Examen fisico</a></li>
                    <li><a id="tabLabel5" href="#tabContent5" data-toggle="tab">Tratamiento</a></li>
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
                                        <?php $historiaMedica->historia_id != null ? $cedLectura = 'readonly' : $cedLectura = '';?> <!-- Habilita/Deshabilita edicion campo cedula -->
                                        <input onblur="Mayuscula(this);" <?php echo $cedLectura;?> value="<?php echo $historiaMedica->historia_cedula; ?>" name="cedula" id="cedula" type="number" class="form-control" placeholder="Solo numeros sin puntos o comas">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_1">Primer nombre</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_1; ?>" name="nombre_1" id="nombre_1" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_2">Segundo nombre</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_2; ?>" name="nombre_2" id="nombre_2" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_1">Primer apellido</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_1; ?>" name="apellido_1" id="apellido_1" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_2">Segundo apellido</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_2; ?>" name="apellido_2" id="apellido_2" type="text" class="form-control" placeholder="">
                                    </div>
    
                                    <!-- Fila 3 -->                                        
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="direccion">Direccion</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_direccion; ?>" name="direccion" id="direccion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="telefono">Telefono</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_telefono; ?>" name="telefono" id="telefono" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="profesion">Profesion</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_profesion; ?>" name="profesion" id="profesion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="edad">Edad</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_edad; ?>" name="edad" id="edad" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 4-->
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="motivoconsulta">Motivo consulta</label>
                                        <textarea onblur="Mayuscula(this);" name="motivoconsulta" id="motivoconsulta" type="textarea" class="form-control" placeholder="" rows="10"><?php echo $historiaMedica->historia_motivoconsulta; ?></textarea>
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="rxs">R x S</label>
                                        <textarea onblur="Mayuscula(this);" name="rxs" id="rxs" type="textarea" class="form-control" placeholder="" rows="10"><?php echo $historiaMedica->historia_rxs; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB Antecedentes -->
                    <div class="tab-pane" id="tabContent2">
                        <div class="">
                           <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="hta_ap">HTA - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_hta_ap; ?>" name="hta_ap" id="hta_ap" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="hta_af">HTA - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_hta_af; ?>" name="hta_af" id="hta_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="dm_ap">DM - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_dm_ap; ?>" name="dm_ap" id="dm_ap" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="dm_af">DM - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_dm_af; ?>" name="dm_af" id="dm_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="asma_ap">Asma - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_asma_ap; ?>" name="asma_ap" id="asma_ap" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="asma_af">Asma - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_asma_af; ?>" name="asma_af" id="asma_af" type="text" class="form-control" placeholder="">
                                    </div>
                                       
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="cancer_ap">Cancer - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_cancer_ap; ?>" name="cancer_ap" id="cancer_ap" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="cancer_af">Cancer - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_cancer_af; ?>" name="cancer_af" id="cancer_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 3 -->    
                                    <div class="form-group col-md-12" style="display: block;">
                                        <label for="quirurgicos_ap">Quirurgicos - AP</label>
                                        <textarea onblur="Mayuscula(this);" name="quirurgicos_ap" id="quirurgicos_ap" type="textarea" class="form-control" placeholder="" rows="3"><?php echo $historiaMedica->historia_quirurgicos_ap; ?></textarea>
                                    </div>

                                    <!-- Fila 4 -->  
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="quirurgicos_af">Quirurgicos - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_quirurgicos_af; ?>" name="quirurgicos_af" id="quirurgicos_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="hospitalizaciones_ap">Hospitalizaciones - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_hospitalizaciones_ap; ?>" name="hospitalizaciones_ap" id="hospitalizaciones_ap" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="hospitalizaciones_af">Hospitalizaciones - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_hospitalizaciones_af; ?>" name="hospitalizaciones_af" id="hospitalizaciones_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 5 -->    
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="alergias_ap">Alergias - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_alergias_ap; ?>" name="alergias_ap" id="alergias_ap" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="alergias_af">Alergias - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_alergias_af; ?>" name="alergias_af" id="alergias_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="fumador_ap">Fumador - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fumador_ap; ?>" name="fumador_ap" id="fumador_ap" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="fumador_af">Fumador - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fumador_af; ?>" name="fumador_af" id="fumador_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 6 -->  
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="licor_ap">Licor - AP</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_licor_ap; ?>" name="licor_ap" id="licor_ap" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="licor_af">Licor - AF</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_licor_af; ?>" name="licor_af" id="licor_af" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="otros">Otros</label>
                                        <textarea onblur="Mayuscula(this);" name="otros" id="otros" type="textarea" class="form-control" placeholder="" rows="4"><?php echo $historiaMedica->historia_otros; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB Ginecobstretica -->
                    <div class="tab-pane" id="tabContent3">
                        <div class="">
                           <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="descripcion">Descripcion</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_descripcion; ?>" name="descripcion" id="descripcion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="planificacion">Planificacion</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_planificacion; ?>" name="planificacion" id="planificacion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="fgo_g">FGO - G</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fgo_g; ?>" name="fgo_g" id="fgo_g" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="fgo_p">FGO - P</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fgo_p; ?>" name="fgo_p" id="fgo_p" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="fgo_a">FGO - A</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fgo_a; ?>" name="fgo_a" id="fgo_a" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="fgo_c">FGO - C</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fgo_c; ?>" name="fgo_c" id="fgo_c" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="fgo_v">FGO - V</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fgo_v; ?>" name="fgo_v" id="fgo_v" type="text" class="form-control" placeholder="">
                                    </div>
    
                                    <!-- Fila 3 -->                                        
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fum_dia">FUM - Dia</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fum_dia; ?>" name="fum_dia" id="fum_dia" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fum_mes">FUM - Mes</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fum_mes; ?>" name="fum_mes" id="fum_mes" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fum_ano">FUM - Año</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fum_ano; ?>" name="fum_ano" id="fum_ano" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 4-->
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fup_dia">FUP - Dia</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fup_dia; ?>" name="fup_dia" id="fup_dia" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fup_mes">FUP - Mes</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fup_mes; ?>" name="fup_mes" id="fup_mes" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fup_ano">FUP - Año</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fup_ano; ?>" name="fup_ano" id="fup_ano" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 5-->
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fuc_dia">FUC - Dia</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fuc_dia; ?>" name="fuc_dia" id="fuc_dia" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fuc_mes">FUC - Mes</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fuc_mes; ?>" name="fuc_mes" id="fuc_mes" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fuc_ano">FUC - Año</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fuc_ano; ?>" name="fuc_ano" id="fuc_ano" type="text" class="form-control" placeholder="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB Examen fisico -->
                    <div class="tab-pane" id="tabContent4">
                        <div class="">
                           <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-12" style="display: block;">
                                        <label for="ef">EF</label>
                                        <textarea onblur="Mayuscula(this);" name="ef" id="ef" type="textarea" class="form-control" placeholder="" rows="5"><?php echo $historiaMedica->historia_ef; ?></textarea>
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="pa">PA</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_pa; ?>" name="pa" id="pa" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="fc">FC</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fc; ?>" name="fc" id="fc" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="peso">Peso</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_peso; ?>" name="peso" id="peso" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="fr">FR</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fr; ?>" name="fr" id="fr" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="t">T</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_t; ?>" name="t" id="t" type="text" class="form-control" placeholder="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB Tratamiento -->
                    <div class="tab-pane" id="tabContent5">
                        <div class="">
                           <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="dx1">DX1</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_dx1; ?>" name="dx1" id="dx1" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="dx2">DX2</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_dx2; ?>" name="dx2" id="dx2" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="dx3">DX3</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_dx3; ?>" name="dx3" id="dx3" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="control">Control</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_control; ?>" name="control" id="control" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="medico">Medico</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_medico; ?>" name="medico" id="medico" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="fitoterapeuta">Fitoterapeuta</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fitoterapeuta; ?>" name="fitoterapeuta" id="fitoterapeuta" type="text" class="form-control" placeholder="">
                                    </div>
    
                                    <!-- Fila 3-->
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="tratamiento">Tratamiento</label>
                                        <textarea onblur="Mayuscula(this);" name="tratamiento" id="tratamiento" type="textarea" class="form-control" placeholder="" rows="5"><?php echo $historiaMedica->historia_tratamiento; ?></textarea>
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="banos">Baños</label>
                                        <textarea onblur="Mayuscula(this);" name="banos" id="banos" type="textarea" class="form-control" placeholder="" rows="5"><?php echo $historiaMedica->historia_banos; ?></textarea>
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="bebidas">Bebidas</label>
                                        <textarea onblur="Mayuscula(this);" name="bebidas" id="bebidas" type="textarea" class="form-control" placeholder="" rows="5"><?php echo $historiaMedica->historia_bebidas; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <?php if ($historiaMedica->historia_id != null){ ?>
        <div class="form-group col-md-2 text-left" style="display: block;">
            <a onclick="javascript:return confirm('Asegurese de guardar cambios antes de continuar...');" href="?c=Cita&a=Crud&id=<?php echo $historiaMedica->historia_id; ?>&token=<?php echo @$_GET['token']; ?>" class="btn btn-default">Nueva cita medica</a>
        </div>
        <div class="form-group col-md-2 text-left" style="display: block;">
            <a onclick="javascript:return confirm('Asegurese de guardar cambios antes de continuar...');" href="?c=Cita&a=listarCitas&filtro=<?php echo $historiaMedica->historia_cedula; ?>&token=<?php echo @$_GET['token']; ?>" class="btn btn-default">Ver cronologico de citas medicas</a>
        </div>
    <?php }?>

    <div class="form-group col-md-8 text-right" style="display: block;">
        <button class="btn btn-success" name="btn-guardar" id="btn-guardar">Guardar cambios en la historia</button>
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