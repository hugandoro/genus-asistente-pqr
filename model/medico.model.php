<?php
class Medico
{
	private $pdo;
    
    //public $medico_id;
    //public $medico_usuario;
    //public $medico_password;
    //public $medico_token;
	//public $medico_token_caducidad;
	//public $medico_nivel;
	//public $medico_estado;
	//public $medico_nombres;
	//public $medico_apellidos;

	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Acceder($usuario, $password){
		try 
		{
			$stm = $this->pdo->prepare(
                "SELECT * FROM medico WHERE medico_usuario = ? AND medico_password = ?"
            );

			$stm->execute(array($usuario,sha1($password)));
            
			$result = $stm->fetch(PDO::FETCH_OBJ);
            
            if(!is_object($result)){
                return new Medico;
			} 
			else{
				return $result;
            }
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}
}