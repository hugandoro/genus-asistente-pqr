<?php
require_once 'model/historia.model.php';
error_reporting(E_ALL ^ E_NOTICE);

class HistoriaController{
    
    private $modelHistoria,
            $auth;
    
    // Metodo constructor de la clase
    public function __CONSTRUCT(){
        $this->modelHistoria = new Historia();
        $this->auth  = FactoryAuth::getInstance();
        
        // Hace un llamado al metodo estaAutenticado para validar si es una sesion registrada
        try{
            $this->auth->estaAutenticado();
        } 
        catch(Exception $e){
            header('Location: index.php');
        }
    }
    
    // Metodo que estructura la pagina por defecto
    public function Index(){
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-buscar.view.php';
        require_once 'view/footer.view.php';
    }
    
    // Metodo que permite hacer CRUD con la base de datos
    public function Crud(){
        $historiaMedica = new Historia();
        
        // Valida si se recibe un ID - si existe es modo edicion y hace un llamado a obtener los datos del modelo
        if(isset($_REQUEST['id'])){
            $historiaMedica = $this->modelHistoria->Obtener($_REQUEST['id']); 
        }
        
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-nuevo-editar.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo que permite hacer CRUD PREVIO con la base de datos para validar CEDULA antes de continuar (CREACION Y EDICION COMPLETA DE UNA HISTORIA)
    public function crud_Previo(){
        $historiaMedica = new Historia();        
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-nuevo-previo.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo que permite hacer CRUD PREVIO con la base de datos para validad CEDULA antes de continuar (EDICION SOLO DEL CAMPO CEDULA)
    public function crud_Identificacion_Previo(){
        $historiaMedica = new Historia();        
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-editar-identificacion-previo.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para listar resultados de una busqueda
    public function listar(){
          //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-listar.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para guardar una nueva historia previamente solo la CEDULA
    public function guardar_Previo(){
        $historiaMedica = new Historia();
        $registrosEncontrados = 0;
    
        $historiaMedica->historia_id = $_REQUEST['id'];
        $historiaMedica->historia_fecha = $_REQUEST['fecha'];
        $historiaMedica->historia_cedula = $_REQUEST['cedula'];

        $registrosEncontrados = $this->modelHistoria->verificarDuplicidad($historiaMedica->historia_cedula,$this->auth->usuario()->medico_id);//Verificamos posible duplicidad

        if ($registrosEncontrados == 0){ //No existe una historia con este N° de cedula para el medico activo logueado
            $historiaMedica->historia_id=$this->modelHistoria->registrar_Previo($historiaMedica); //Registra y recibe el ID del nuevo registro
            $this->modelHistoria->Relacion($this->auth->usuario()->medico_id,$historiaMedica->historia_id); //Crea la relacion Medico - ID historia recien creada
        }else{ //No guarda los cambios pues ya existe un registro ALERTA DE DUPLICIDAD
            echo "<script>alert('ALERTA CAMBIOS NO GUARDADOS!!! - Ya existe una historia previamente creada con este N° de identificacion $historiaMedica->historia_cedula');
            window.history.back();
            </script>"; 
            exit;
        }

        // Vuelve a la vista por de la historia con los cambios realizados
        header('Location: index.php?c=Historia&a=Crud&id='.$historiaMedica->historia_id.'&token=' . @$_GET['token']);
    }


    // Metodo para modificar solo el campo IDENTIFICACION de una HISTORIA ya existente
    public function actualizar_Identificacion(){
        $historiaMedica = new Historia();
        $registrosEncontrados = 0;
    
        //Valida si existe una historia con el numero de identificacion ORIGINAL informado
        $registrosEncontrados = $this->modelHistoria->verificarDuplicidad($_REQUEST['cedulaA'],$this->auth->usuario()->medico_id);

        if ($registrosEncontrados != 0){ //Existe una historia con el numero de identificacion ORIGINAL informado
            
            //Como se tiene seguridad que existe la historia, se procede a obtener los datos de la historia medica a modificar
            $historiaMedica = $this->modelHistoria->obtenerID($_REQUEST['cedulaA'],$this->auth->usuario()->medico_id); 

            //Valida si existe una historia con el numero de identificacion CON EL CUAL SERA REEMPLAZADO
            $registrosEncontrados = $this->modelHistoria->verificarDuplicidad($_REQUEST['cedulaB'],$this->auth->usuario()->medico_id);

            if ($registrosEncontrados == 0){ //No existe historia con el numero de identificacion CON EL CUAL SERA REEMPLAZADO
                //**Codigo para intercambiar N° de identificacion */
                $historiaMedica->historia_cedula = $_REQUEST['cedulaB'];
                $this->modelHistoria->actualizarIdentificacion($historiaMedica);
                //** Fin codigo para intercambio de identificacion */
            }else{
                echo "<script>alert('ALERTA !!! - YA existe una historia previamente creada con el N° de identificacion que pretende ingresar');
                window.history.back();
                </script>"; 
                exit;
            }

        }else{
            echo "<script>alert('ALERTA !!! - NO existe una historia asignada a este medico con el numero de identificacion informado');
            window.history.back();
            </script>"; 
            exit;
        }

        // Vuelve a la vista por de la historia con los cambios realizados
        header('Location: index.php?c=Historia&a=Crud&id='.$historiaMedica->historia_id.'&token=' . @$_GET['token']);
    }
    

    // Metodo para guardar una nueva historia o los cambios realizados a una ya existente
    public function Guardar(){
        $historiaMedica = new Historia();
        $registrosEncontrados = 0;
        
        // Datos de la ficha N° 1 TAB - IDENTIFICACION
        $historiaMedica->historia_id = $_REQUEST['id'];
        $historiaMedica->historia_fecha = $_REQUEST['fecha'];
        $historiaMedica->historia_cedula = $_REQUEST['cedula'];
        $historiaMedica->historia_nombre_1 = $_REQUEST['nombre_1'];
        $historiaMedica->historia_nombre_2 = $_REQUEST['nombre_2'];
        $historiaMedica->historia_apellido_1 = $_REQUEST['apellido_1'];
        $historiaMedica->historia_apellido_2 = $_REQUEST['apellido_2'];
        $historiaMedica->historia_direccion = $_REQUEST['direccion'];
        $historiaMedica->historia_telefono = $_REQUEST['telefono'];
        $historiaMedica->historia_profesion = $_REQUEST['profesion'];
        $historiaMedica->historia_edad = $_REQUEST['edad'];
        $historiaMedica->historia_rxs = $_REQUEST['rxs'];
        $historiaMedica->historia_motivoconsulta = $_REQUEST['motivoconsulta'];
        
        // Datos de la ficha N° 2 TAB - ANTECEDENTES
        $historiaMedica->historia_hta_ap = $_REQUEST['hta_ap'];
        $historiaMedica->historia_hta_af = $_REQUEST['hta_af'];
        $historiaMedica->historia_dm_ap = $_REQUEST['dm_ap'];
        $historiaMedica->historia_dm_af = $_REQUEST['dm_af'];
        $historiaMedica->historia_asma_ap = $_REQUEST['asma_ap'];
        $historiaMedica->historia_asma_af = $_REQUEST['asma_af'];
        $historiaMedica->historia_cancer_ap = $_REQUEST['cancer_ap'];
        $historiaMedica->historia_cancer_af = $_REQUEST['cancer_af'];
        $historiaMedica->historia_quirurgicos_ap = $_REQUEST['quirurgicos_ap'];
        $historiaMedica->historia_quirurgicos_af = $_REQUEST['quirurgicos_af'];
        $historiaMedica->historia_hospitalizaciones_ap = $_REQUEST['hospitalizaciones_ap'];
        $historiaMedica->historia_hospitalizaciones_af = $_REQUEST['hospitalizaciones_af'];
        $historiaMedica->historia_alergias_ap = $_REQUEST['alergias_ap'];
        $historiaMedica->historia_alergias_af = $_REQUEST['alergias_af'];
        $historiaMedica->historia_fumador_ap = $_REQUEST['fumador_ap'];
        $historiaMedica->historia_fumador_af = $_REQUEST['fumador_af'];
        $historiaMedica->historia_licor_ap = $_REQUEST['licor_ap'];
        $historiaMedica->historia_licor_af = $_REQUEST['licor_af'];
        $historiaMedica->historia_otros = $_REQUEST['otros'];

        // Datos de la ficha N° 3 TAB - GINECOBSTRETICA
        $historiaMedica->historia_descripcion = $_REQUEST['descripcion'];
        $historiaMedica->historia_planificacion = $_REQUEST['planificacion'];
        $historiaMedica->historia_fgo_g = $_REQUEST['fgo_g'];
        $historiaMedica->historia_fgo_p = $_REQUEST['fgo_p'];
        $historiaMedica->historia_fgo_a = $_REQUEST['fgo_a'];
        $historiaMedica->historia_fgo_c = $_REQUEST['fgo_c'];
        $historiaMedica->historia_fgo_v = $_REQUEST['fgo_v'];
        $historiaMedica->historia_fum_dia = $_REQUEST['fum_dia'];
        $historiaMedica->historia_fum_mes = $_REQUEST['fum_mes'];
        $historiaMedica->historia_fum_ano = $_REQUEST['fum_ano'];
        $historiaMedica->historia_fup_dia = $_REQUEST['fup_dia'];
        $historiaMedica->historia_fup_mes = $_REQUEST['fup_mes'];
        $historiaMedica->historia_fup_ano = $_REQUEST['fup_ano'];
        $historiaMedica->historia_fuc_dia = $_REQUEST['fuc_dia'];
        $historiaMedica->historia_fuc_mes = $_REQUEST['fuc_mes'];
        $historiaMedica->historia_fuc_ano = $_REQUEST['fuc_ano'];

        // Datos de la ficha N° 4 TAB - FISICO
        $historiaMedica->historia_ef = $_REQUEST['ef'];
        $historiaMedica->historia_pa = $_REQUEST['pa'];
        $historiaMedica->historia_fc = $_REQUEST['fc'];
        $historiaMedica->historia_peso = $_REQUEST['peso'];
        $historiaMedica->historia_fr = $_REQUEST['fr'];
        $historiaMedica->historia_t = $_REQUEST['t'];

        // Datos de la ficha N° 5 TAB - TRATAMIENTO
        $historiaMedica->historia_dx1 = $_REQUEST['dx1'];
        $historiaMedica->historia_dx2 = $_REQUEST['dx2'];
        $historiaMedica->historia_dx3 = $_REQUEST['dx3'];
        $historiaMedica->historia_control = $_REQUEST['control'];
        $historiaMedica->historia_medico = $_REQUEST['medico'];
        $historiaMedica->historia_fitoterapeuta = $_REQUEST['fitoterapeuta'];
        $historiaMedica->historia_tratamiento = $_REQUEST['tratamiento'];
        $historiaMedica->historia_banos = $_REQUEST['banos'];
        $historiaMedica->historia_bebidas = $_REQUEST['bebidas'];

        // Si existe un ID estamos editando y llama al metodo actualizar del modelo, de lo contrario hace un llamado al metodo registrar del modelo
        if ($historiaMedica->historia_id > 0 ){
            $this->modelHistoria->Actualizar($historiaMedica);
        }else{
            $registrosEncontrados = $this->modelHistoria->verificarDuplicidad($historiaMedica->historia_cedula,$this->auth->usuario()->medico_id);//Verificamos posible duplicidad

            if ($registrosEncontrados == 0){ //No existe una historia con este N° de cedula para el medico activo logueado
                $historiaMedica->historia_id=$this->modelHistoria->Registrar($historiaMedica); //Registra y recibe el ID del nuevo registro
                $this->modelHistoria->Relacion($this->auth->usuario()->medico_id,$historiaMedica->historia_id); //Crea la relacion Medico - ID historia recien creada
            }else{ //No guarda los cambios pues ya existe un registro ALERTA DE DUPLICIDAD
                echo "<script>alert('ALERTA CAMBIOS NO GUARDADOS!!! - Ya existe una historia previamente creada con este N° de identificacion $historiaMedica->historia_cedula');
                window.history.back();
                </script>"; 
                exit;
            }
        }

        // Vuelve a la vista por de la historia con los cambios realizados
        header('Location: index.php?c=Historia&a=Crud&id='.$historiaMedica->historia_id.'&token=' . @$_GET['token']);
    }
    
    // Metodo para eliminar una historia
    public function Eliminar(){
        // Hace un llamado al metodo eliminar del modelo enviando el ID del medico y ID de la historia
        $this->modelHistoria->Eliminar($this->auth->usuario()->medico_id,$_REQUEST['id']);
        
        // Vuelve a la vista por defecto
        header('Location: index.php?c=historia&a=listar&filtro='.$_REQUEST['filtro'].'&token=' . @$_GET['token']);
    }
}