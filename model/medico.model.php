<?php
class Medico
{
	private $pdo;

	//RANGO DE PERMISOS
	//medico_nivel = 1 - ADMINISTRADOR permisos para crear, asignar, modificar y cerrar CUALQUIER PQR
	//medico_nivel = 2 - USUARIO permisos solo para cerrar PQR a su cargo
	//****************/

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