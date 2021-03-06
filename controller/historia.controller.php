<?php
require_once 'model/historia.model.php';
require_once 'model/medico.model.php';
error_reporting(E_ALL ^ E_NOTICE);

class HistoriaController{
    
    private $modelHistoria,
            $auth,
            $modelMedico;
    
    // Metodo constructor de la clase
    public function __CONSTRUCT(){
        $this->modelHistoria = new Historia();
        $this->modelMedico = new Medico();
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
        require_once 'view/historia/historia-listar.view.php';
        require_once 'view/footer.view.php';
    }
    
    // Metodo que permite hacer CRUD con la base de datos
    public function Crud(){
        $historiaMedica = new Historia();
        $usuarios = new Medico(); 
        
        // Valida si se recibe un ID - si existe es modo edicion y hace un llamado a obtener los datos del modelo
        if(isset($_REQUEST['id'])){
            $historiaMedica = $this->modelHistoria->Obtener($_REQUEST['id']); 
        }
        $usuarios = $this->modelMedico->listarUsuarios();
        
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-nuevo-editar.view.php';
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

    // Metodo para generar CERTIFICADO
    public function certificado(){
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-certificado.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para generar CERTIFICADO
    public function estadistico(){
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/historia/historia-estadistico.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para guardar una nueva historia o los cambios realizados a una ya existente
    public function Guardar(){
        $historiaMedica = new Historia();
        $registrosEncontrados = 0;
        
        // Datos de la ficha N° 1 TAB - IDENTIFICACION
        $historiaMedica->historia_id = $_REQUEST['id'];
        $historiaMedica->historia_fecha = $_REQUEST['fecha'];
        $historiaMedica->historia_clasificacion_pqr = $_REQUEST['clasificacion_pqr'];
        $historiaMedica->historia_dias = $_REQUEST['dias'];
        $historiaMedica->historia_asunto = $_REQUEST['asunto'];
        $historiaMedica->historia_cedula = $_REQUEST['cedula'];
        $historiaMedica->historia_nombre_1 = $_REQUEST['nombre_1'];
        $historiaMedica->historia_nombre_2 = $_REQUEST['nombre_2'];
        $historiaMedica->historia_apellido_1 = $_REQUEST['apellido_1'];
        $historiaMedica->historia_apellido_2 = $_REQUEST['apellido_2'];
        $historiaMedica->historia_direccion = $_REQUEST['direccion'];
        $historiaMedica->historia_entidad = $_REQUEST['entidad'];
        $historiaMedica->historia_cargo = $_REQUEST['cargo'];
        $historiaMedica->historia_telefono = $_REQUEST['telefono'];
        $historiaMedica->historia_email = $_REQUEST['email'];
        $historiaMedica->historia_tipo_usuario = $_REQUEST['tipo_usuario'];
        $historiaMedica->historia_clase_pqr = $_REQUEST['clase_pqr'];
        $historiaMedica->historia_canal = $_REQUEST['canal'];
        $historiaMedica->historia_radicado_gestion = $_REQUEST['radicado_gestion'];
        $historiaMedica->historia_num_radicado_gestion = $_REQUEST['num_radicado_gestion'];
        $historiaMedica->historia_radicado_planeacion = $_REQUEST['radicado_planeacion'];
        $historiaMedica->historia_num_radicado_planeacion = $_REQUEST['num_radicado_planeacion'];
        $historiaMedica->historia_area = $_REQUEST['area'];
        $historiaMedica->historia_funcionario = $_REQUEST['funcionario'];
        $historiaMedica->historia_medio_respuesta = $_REQUEST['medio_respuesta'];
        $historiaMedica->historia_fecha_respuesta = $_REQUEST['fecha_respuesta'];
        $historiaMedica->historia_num_oficio_respuesta = $_REQUEST['num_oficio_respuesta'];
        $historiaMedica->historia_respuesta = $_REQUEST['respuesta'];        

        // Si existe un ID estamos editando y llama al metodo actualizar del modelo, de lo contrario hace un llamado al metodo registrar del modelo
        if ($historiaMedica->historia_id > 0 ){
            $this->modelHistoria->Actualizar($historiaMedica);
        }
        else{
            $historiaMedica->historia_id=$this->modelHistoria->Registrar($historiaMedica); //Registra y recibe el ID del nuevo registro
            $this->modelHistoria->Relacion($this->auth->usuario()->medico_id,$historiaMedica->historia_id); //Crea la relacion Medico - ID historia recien creada
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