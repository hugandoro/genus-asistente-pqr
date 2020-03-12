<?php
require_once 'model/cita.model.php';
require_once 'model/historia.model.php';
require_once "controller/historia.controller.php";
error_reporting(E_ALL ^ E_NOTICE);

class CitaController extends Historia{
    
    private $modelCita,
            $modelHistoria,
            $auth;
    
    // Metodo constructor de la clase
    public function __CONSTRUCT(){
        $this->modelHistoria = new Historia();
        $this->modelCita = new Cita();
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
        require_once 'view/cita/cita-buscar.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para listar resultados de una busqueda
    public function listarCitas(){
        //Carga las vistas para listar las citas relacionadas con la historia
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/cita/cita-listar.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo que permite hacer CRUD con la base de datos
    public function Crud(){
        $historiaMedica = new Historia();
        $citaMedica = new Cita();
        
        // Valida si se recibe un ID de historia - si existe hace un llamado a obtener los datos del modelo
        if(isset($_REQUEST['id'])){
            $historiaMedica = $this->modelHistoria->Obtener($_REQUEST['id']); 
        }
        // Valida si se recibe un ID de cita - si existe hace un llamado a obtener los datos del modelo
        if(isset($_REQUEST['idCita'])){
            $citaMedica = $this->modelCita->Obtener($_REQUEST['idCita']); 
        }
        
        //Carga las vistas para presentar al usuario
        require_once 'view/header.view.php';
        require_once 'view/menu.view.php';
        require_once 'view/cita/cita-nuevo-editar.view.php';
        require_once 'view/footer.view.php';
    }

    // Metodo para guardar una nueva cita
    public function Guardar(){
        $citaMedica = new Cita();

        // Datos de la ficha N° 1 TAB - CITA MEDICA
        $citaMedica->cita_id = $_REQUEST['id'];
        $citaMedica->cita_informe = $_REQUEST['informe'];
        $citaMedica->cita_formula = $_REQUEST['formula'];

        // Si existe un ID estamos editando y llama al metodo actualizar del modelo, de lo contrario hace un llamado al metodo registrar del modelo
        if ($citaMedica->cita_id > 0 ){
            $this->modelCita->Actualizar($citaMedica);
        }else{
            $citaMedica->cita_id=$this->modelCita->Registrar($citaMedica); //Registra y recibe el ID del nuevo registro
            $this->modelCita->Relacion($_REQUEST['idHistoria'],$citaMedica->cita_id); //Crea la relacion Historia - ID cita recien creada
        }

        // Vuelve a la vista del cronologico de citas con los cambios realizados
        //header('Location: index.php?c=Cita&a=listarCitas&filtro='.$_REQUEST['cedulaHistoria'].'&token=' . @$_GET['token']);
        header('Location: index.php?c=Cita&a=crud&id='.$_REQUEST['idHistoria'].'&idCita='.$citaMedica->cita_id.'&token=' . @$_GET['token']);
    }
    
    // Metodo para eliminar una cita
    public function eliminarCita(){
        // Hace un llamado al metodo eliminar del modelo enviando el ID del medico y ID de la cita
        $this->modelCita->eliminarCita($_REQUEST['idHistoria'],$_REQUEST['idCita']);
        
        // Vuelve a la vista por defecto
        header('Location: index.php?c=Cita&a=listarCitas&filtro='.$_REQUEST['filtro'].'&token=' . @$_GET['token']);
    }
}