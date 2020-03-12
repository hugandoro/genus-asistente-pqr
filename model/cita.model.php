<!-- Modelo de datos para las citas medicas-->
<?php
class Cita
{
	private $pdo;
	
	// Inicializa variables para campos que conforman la historia
	public $cita_id;
	public $cita_fecha;
	public $cita_informe;
	public $cita_formula;

	// Metodo para iniciar el constructor
	public function __CONSTRUCT(){
		try{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	// Metodo para listar todas las citas relacionadas al ID de la historia
	public function listarCitas($idHistoria){
		try{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM cita t1 INNER JOIN historia_cita t2 ON (t1.cita_id = t2.cita_id) WHERE (t2.historia_id = '$idHistoria') ORDER BY t1.cita_id DESC");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	//Metodo para crear la relacion UNO a MUCHOS entre historia - cita
	public function Relacion($idHistoria,$idCita){
		try{
			$sql = "INSERT INTO historia_cita (historia_id,cita_id) VALUES (?, ?)";
			$this->pdo->prepare($sql)
				 ->execute(array($idHistoria,$idCita));
		}
		catch (Exception $e){
			die($e->getMessage());
			//break;
		}
	}

	// Metodo para crear un nuevo registro
	public function Registrar(Cita $data){
		try{
		$sql = "INSERT INTO cita (cita_informe,cita_formula) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->cita_informe,
					$data->cita_formula, 
                )
			);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}

	// Metodo para eliminar un registro
	public function eliminarCita($idHistoria,$idCita){
		try{
			//Borrar relacion
			$stm = $this->pdo
			            ->prepare("DELETE FROM historia_cita WHERE (cita_id = ?) AND (historia_id = ?) ");			          
			$stm->execute(array($idCita,$idHistoria));

			//Borrar historia
			$stm = $this->pdo
			            ->prepare("DELETE FROM cita WHERE cita_id = ?");			          
			$stm->execute(array($idCita));
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para obtener los datos puntuales de un registro
	public function Obtener($idCita){
		try{
			$stm = $this->pdo
			            ->prepare("SELECT * FROM cita WHERE cita_id = ?");

			$stm->execute(array($idCita));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para actualizar un registro
	public function Actualizar($data){
		try{
			$sql = "UPDATE cita SET 
						cita_informe    = ?, 
						cita_formula    = ?
					WHERE cita_id = ?";

			$this->pdo->prepare($sql)
			->execute(
				array(
					$data->cita_informe, 
					$data->cita_formula,
					$data->cita_id
				)
			);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}

}