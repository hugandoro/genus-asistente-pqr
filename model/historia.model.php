<!-- Modelo de datos para las historias clinicas-->
<?php
class Historia
{
	private $pdo;
	
	// Inicializa variables para campos que conforman la historia
	public $historia_id;
	public $historia_cedula;
	public $historia_nombre_1; 
	public $historia_nombre_2;
	public $historia_apellido_1;
	public $historia_apellido_2;
	public $historia_direccion;
	public $historia_telefono;

	// Metodo para iniciar el constructor
	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	// Metodo para listar resultados de una consulta de historias CON FILTRO COMODIN
	public function Listar(){
		try{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM historia");	
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para obtener los datos puntuales de un registro
	public function Obtener($idHistoria){
		try{
			$stm = $this->pdo
			            ->prepare("SELECT * FROM historia WHERE historia_id = ?");

			$stm->execute(array($idHistoria));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para eliminar un registro
	public function Eliminar($idMedico,$idHistoria){
		try{
			//Borrar relaciones Medico - Historias
			$stm = $this->pdo
			            ->prepare("DELETE FROM medico_historia WHERE (historia_id = ?) AND (medico_id = ?) ");			          
			$stm->execute(array($idHistoria,$idMedico));

			//Borrar historia
			$stm = $this->pdo
			            ->prepare("DELETE FROM historia WHERE historia_id = ?");			          
			$stm->execute(array($idHistoria));
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para actualizar un registro
	public function Actualizar($data){
		try{
			$data->historia_cedula == '' ? ($data->historia_cedula = 0) : $data->historia_cedula ;
			
			$sql = "UPDATE historia SET 
						historia_cedula      	 = ?, 
						historia_nombre_1        = ?, 
						historia_nombre_2        = ?,
                        historia_apellido_1      = ?,
						historia_apellido_2      = ?,
						historia_direccion       = ?, 
						historia_telefono        = ?
				    WHERE historia_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->historia_cedula, 
						$data->historia_nombre_1, 
						$data->historia_nombre_2,
                        $data->historia_apellido_1,
						$data->historia_apellido_2,
						$data->historia_direccion, 
						$data->historia_telefono,
                        $data->historia_id //No se debe sobreescribir, se usa para ubicar el registro a modificar
					)
				);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	//Metodo para crear la relacion UNO a MUCHOS entre usuario - historia
	public function Relacion($idMedico,$idHistoria){
		try{
			$sql = "INSERT INTO medico_historia (medico_id,historia_id) VALUES (?, ?)";
			$this->pdo->prepare($sql)
				 ->execute(array($idMedico,$idHistoria));
		}
		catch (Exception $e){
			die($e->getMessage());
			//break;
		}
	}

	// Metodo para crear un nuevo registro
	public function Registrar(Historia $data){
		try{
		$data->historia_cedula == '' ? ($data->historia_cedula = 0) : $data->historia_cedula ;
		$sql = "INSERT INTO historia (historia_cedula,historia_nombre_1,historia_nombre_2,historia_apellido_1,historia_apellido_2,historia_direccion,historia_telefono) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->historia_cedula,
					$data->historia_nombre_1, 
					$data->historia_nombre_2,
					$data->historia_apellido_1,
					$data->historia_apellido_2,
					$data->historia_direccion, 
					$data->historia_telefono
                )
			);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}
}