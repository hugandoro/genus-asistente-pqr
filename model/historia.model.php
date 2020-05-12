<!-- Modelo de datos para las historias clinicas-->
<?php
class Historia
{
	private $pdo;
	
	// Inicializa variables para campos que conforman la historia
	public $historia_id;
	public $historia_fecha;
	public $historia_clasificacion_pqr;
	public $historia_dias;
	public $historia_asunto;
	public $historia_cedula;
	public $historia_nombre_1; 
	public $historia_nombre_2;
	public $historia_apellido_1;
	public $historia_apellido_2;
	public $historia_direccion;
	public $historia_entidad;
	public $historia_cargo;
	public $historia_telefono;
	public $historia_email;
	public $historia_tipo_usuario;
	public $historia_clase_pqr;
	public $historia_canal;
	public $historia_radicado_gestion;
	public $historia_num_radicado_gestion;
	public $historia_radicado_planeacion;
	public $historia_num_radicado_planeacion;
	public $historia_area;
	public $historia_funcionario;
	public $historia_medio_respuesta;
	public $historia_fecha_respuesta;
	public $historia_num_oficio_respuesta;
	public $historia_respuesta;

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
	public function Listar($usuario,$nivel){
		try{
			$result = array();

			if ($nivel=='1') //ADMINISTRADOR - Consulta TODOS los registros
				$stm = $this->pdo->prepare("SELECT * FROM historia ORDER BY historia_radicado_gestion DESC");	
			else // USUARIO - Consulta SOLO los registros a cargo
				$stm = $this->pdo->prepare("SELECT * FROM historia WHERE historia_funcionario = '$usuario' ORDER BY historia_radicado_gestion DESC");	

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

			$data->historia_radicado_gestion == '' ? ($data->historia_radicado_gestion = NULL) : $data->historia_radicado_gestion ;
			$data->historia_num_radicado_gestion == '' ? ($data->historia_num_radicado_gestion = '0') : $data->historia_num_radicado_gestion ;
			$data->historia_radicado_planeacion == '' ? ($data->historia_radicado_planeacion = NULL) : $data->historia_radicado_planeacion ;
			$data->historia_num_radicado_planeacion == '' ? ($data->historia_num_radicado_planeacion = '0') : $data->historia_num_radicado_planeacion ;
			$data->historia_fecha_respuesta == '' ? ($data->historia_fecha_respuesta = NULL) : $data->historia_fecha_respuesta ;
			$data->historia_num_oficio_respuesta == '' ? ($data->historia_num_oficio_respuesta = '0') : $data->historia_num_oficio_respuesta ;
			
			if ($data->historia_dias == ''){
				if ($data->historia_clasificacion_pqr == "CONCEPTO") $data->historia_dias = '30';
				if ($data->historia_clasificacion_pqr == "LICENCIA") $data->historia_dias = '45';
				if ($data->historia_clasificacion_pqr == "ORGANO_CONTROL") $data->historia_dias = '5';
				if ($data->historia_clasificacion_pqr == "PETICION_AUTORIDAD") $data->historia_dias = '10';
				if ($data->historia_clasificacion_pqr == "PETICION_INFORMACION") $data->historia_dias = '10';
				if ($data->historia_clasificacion_pqr == "PETICION_GENERAL") $data->historia_dias = '15';
				if ($data->historia_clasificacion_pqr == "PETICION_CONSULTA") $data->historia_dias = '30';
				if ($data->historia_clasificacion_pqr == "QUEJA") $data->historia_dias = '15';
				if ($data->historia_clasificacion_pqr == "TUTELA") $data->historia_dias = '2';
			}

			$sql = "UPDATE historia SET 
						historia_clasificacion_pqr			= ?,
						historia_dias     	 				= ?,
						historia_asunto						= ?,
						historia_cedula      	 			= ?, 
						historia_nombre_1        			= ?, 
						historia_nombre_2        			= ?,
                        historia_apellido_1      			= ?,
						historia_apellido_2      			= ?,
						historia_direccion       			= ?, 
						historia_entidad		 			= ?, 
						historia_cargo		 				= ?, 
						historia_telefono        			= ?,
						historia_email		 				= ?, 
						historia_tipo_usuario	 			= ?, 
						historia_clase_pqr	 				= ?, 
						historia_canal		 				= ?, 
						historia_radicado_gestion			= ?,
						historia_num_radicado_gestion		= ?,
						historia_radicado_planeacion		= ?,
						historia_num_radicado_planeacion	= ?,
						historia_area						= ?, 
						historia_funcionario				= ?, 
						historia_medio_respuesta			= ?, 
						historia_fecha_respuesta			= ?, 
						historia_num_oficio_respuesta		= ?,
						historia_respuesta					= ?
				    WHERE historia_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->historia_clasificacion_pqr,
						$data->historia_dias,
						$data->historia_asunto,
						$data->historia_cedula, 
						$data->historia_nombre_1, 
						$data->historia_nombre_2,
                        $data->historia_apellido_1,
						$data->historia_apellido_2,
						$data->historia_direccion, 
						$data->historia_entidad,
						$data->historia_cargo,
						$data->historia_telefono,
						$data->historia_email,
						$data->historia_tipo_usuario,
						$data->historia_clase_pqr,
						$data->historia_canal,
						$data->historia_radicado_gestion,
						$data->historia_num_radicado_gestion,
						$data->historia_radicado_planeacion,
						$data->historia_num_radicado_planeacion,
						$data->historia_area,
						$data->historia_funcionario,
						$data->historia_medio_respuesta,
						$data->historia_fecha_respuesta,
						$data->historia_num_oficio_respuesta,
						$data->historia_respuesta,
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

		$data->historia_radicado_gestion == '' ? ($data->historia_radicado_gestion = NULL) : $data->historia_radicado_gestion ;
		$data->historia_num_radicado_gestion == '' ? ($data->historia_num_radicado_gestion = '0') : $data->historia_num_radicado_gestion ;
		$data->historia_radicado_planeacion == '' ? ($data->historia_radicado_planeacion = NULL) : $data->historia_radicado_planeacion ;
		$data->historia_num_radicado_planeacion == '' ? ($data->historia_num_radicado_planeacion = '0') : $data->historia_num_radicado_planeacion ;
		$data->historia_fecha_respuesta == '' ? ($data->historia_fecha_respuesta = NULL) : $data->historia_fecha_respuesta ;
		$data->historia_num_oficio_respuesta == '' ? ($data->historia_num_oficio_respuesta = '0') : $data->historia_num_oficio_respuesta ;

		if ($data->historia_dias == ''){
			if ($data->historia_clasificacion_pqr == "CONCEPTO") $data->historia_dias = '30';
			if ($data->historia_clasificacion_pqr == "LICENCIA") $data->historia_dias = '45';
			if ($data->historia_clasificacion_pqr == "ORGANO_CONTROL") $data->historia_dias = '5';
			if ($data->historia_clasificacion_pqr == "PETICION_AUTORIDAD") $data->historia_dias = '10';
			if ($data->historia_clasificacion_pqr == "PETICION_INFORMACION") $data->historia_dias = '10';
			if ($data->historia_clasificacion_pqr == "PETICION_GENERAL") $data->historia_dias = '15';
			if ($data->historia_clasificacion_pqr == "PETICION_CONSULTA") $data->historia_dias = '30';
			if ($data->historia_clasificacion_pqr == "QUEJA") $data->historia_dias = '15';
			if ($data->historia_clasificacion_pqr == "TUTELA") $data->historia_dias = '2';
		}

		$sql = "INSERT INTO historia (historia_clasificacion_pqr,historia_dias,historia_asunto,historia_cedula,historia_nombre_1,historia_nombre_2,historia_apellido_1,historia_apellido_2,
		historia_direccion,historia_entidad,historia_cargo,historia_telefono,historia_email,historia_tipo_usuario,historia_clase_pqr,historia_canal,
		historia_radicado_gestion,historia_num_radicado_gestion,historia_radicado_planeacion,historia_num_radicado_planeacion,historia_area,
		historia_funcionario,historia_medio_respuesta,historia_fecha_respuesta,historia_num_oficio_respuesta,historia_respuesta) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->historia_clasificacion_pqr,
					$data->historia_dias,
					$data->historia_asunto,
					$data->historia_cedula,
					$data->historia_nombre_1, 
					$data->historia_nombre_2,
					$data->historia_apellido_1,
					$data->historia_apellido_2,
					$data->historia_direccion, 
					$data->historia_entidad,
					$data->historia_cargo,
					$data->historia_telefono,
					$data->historia_email,
					$data->historia_tipo_usuario,
					$data->historia_clase_pqr,
					$data->historia_canal,
					$data->historia_radicado_gestion,
					$data->historia_num_radicado_gestion,
					$data->historia_radicado_planeacion,
					$data->historia_num_radicado_planeacion,
					$data->historia_area,
					$data->historia_funcionario,
					$data->historia_medio_respuesta,
					$data->historia_fecha_respuesta,
					$data->historia_num_oficio_respuesta,
					$data->historia_respuesta
                )
			);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}

	// Metodo para calcular dias habiles
	function sumasDiaSemana($fecha,$dias)
	{
		$datestart= strtotime($fecha);
		$datesuma = 15 * 86400;
		$diasemana = date('N',$datestart);
		$totaldias = $diasemana+$dias;
		$findesemana = intval( $totaldias/5) *2 ; 
		$diasabado = $totaldias % 5 ; 
		if ($diasabado==6) $findesemana++;
		if ($diasabado==0) $findesemana=$findesemana-2;
	
		$total = (($dias+$findesemana) * 86400)+$datestart ; 
		return $fechafinal = date('Y-m-d', $total);
	}

	// Metodo para diferencia de dias
	function diasPasados($fecha_inicial,$fecha_final)
	{
		$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
		//$dias = abs($dias); 
		$dias = floor($dias);
		return $dias;
	}
}