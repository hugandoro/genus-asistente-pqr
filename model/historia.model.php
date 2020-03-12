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
	public $historia_profesion;
	public $historia_edad;
	public $historia_rxs;
	public $historia_motivoconsulta;
	public $historia_hta_ap;
	public $historia_hta_af;
	public $historia_dm_ap;
	public $historia_dm_af;
	public $historia_asma_ap;
	public $historia_asma_af;
	public $historia_cancer_ap;
	public $historia_cancer_af;
	public $historia_quirurgicos_ap;
	public $historia_quirurgicos_af;
	public $historia_hospitalizaciones_ap;
	public $historia_hospitalizaciones_af;
	public $historia_alergias_ap;
	public $historia_alergias_af;
	public $historia_fumador_ap;
	public $historia_fumador_af;
	public $historia_licor_ap;
	public $historia_licor_af;
	public $historia_otros;
	public $historia_descripcion;
	public $historia_planificacion;
	public $historia_fgo_g;
	public $historia_fgo_p;
	public $historia_fgo_a;
	public $historia_fgo_c;
	public $historia_fgo_v;
	public $historia_fum_dia;
	public $historia_fum_mes;
	public $historia_fum_ano;
	public $historia_fup_dia;
	public $historia_fup_mes;
	public $historia_fup_ano;
	public $historia_fuc_dia;
	public $historia_fuc_mes;
	public $historia_fuc_ano;
	public $historia_ef;
	public $historia_pa;
	public $historia_fc;
	public $historia_peso;
	public $historia_fr;
	public $historia_t;
	public $historia_dx1;
	public $historia_dx2;
	public $historia_dx3;
	public $historia_control;
	public $historia_medico;
	public $historia_fitoterapeuta;
	public $historia_tratamiento;
	public $historia_banos;
	public $historia_bebidas;

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
	public function listarConComodin($filtro,$filtroA,$filtroB,$filtroC,$filtroD,$idMedico){
		try{
			$result = array();

			if (strtolower($filtro)!=''){
				$stm = $this->pdo->prepare("SELECT * FROM historia t1 
				INNER JOIN medico_historia t2 ON (t1.historia_id = t2.historia_id) 
				WHERE (t2.medico_id = '$idMedico') AND ((t1.historia_nombre_1 LIKE '%$filtro%') OR (t1.historia_nombre_2 LIKE '%$filtro%')  OR (t1.historia_apellido_1 LIKE '%$filtro%')  OR (t1.historia_apellido_2 LIKE '%$filtro%')  OR (t1.historia_cedula LIKE '%$filtro%'))");
			}

			elseif ((strtolower($filtroA)!='') || (strtolower($filtroB)!='') || (strtolower($filtroC)!='') || (strtolower($filtroD)!='')) {
				$cadenaTemp = "(t2.medico_id = '$idMedico')";
				if (strtolower($filtroA)!='') $cadenaTemp = $cadenaTemp . " AND " . "(t1.historia_nombre_1 LIKE '%$filtroA%')"; 
				if (strtolower($filtroB)!='') $cadenaTemp = $cadenaTemp . " AND " . "(t1.historia_nombre_2 LIKE '%$filtroB%')"; 
				if (strtolower($filtroC)!='') $cadenaTemp = $cadenaTemp . " AND " . "(t1.historia_apellido_1 LIKE '%$filtroC%')"; 
				if (strtolower($filtroD)!='') $cadenaTemp = $cadenaTemp . " AND " . "(t1.historia_apellido_2 LIKE '%$filtroD%')"; 
				$stm = $this->pdo->prepare("SELECT * FROM historia t1 INNER JOIN medico_historia t2 ON (t1.historia_id = t2.historia_id) WHERE $cadenaTemp");	
			}

			elseif (strtolower($filtro)==''){
				$stm = $this->pdo->prepare("SELECT * FROM historia t1 INNER JOIN medico_historia t2 ON (t1.historia_id = t2.historia_id) WHERE (t2.medico_id = '$idMedico')");
			}

			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para listar resultados de una consulta de historias SIN FILTRO COMODIN
	public function listarSinComodin($cedulaHistoria,$idMedico){
		try{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM historia t1 
			INNER JOIN medico_historia t2 ON (t1.historia_id = t2.historia_id) 
			WHERE (t2.medico_id = '$idMedico') AND (t1.historia_cedula = '$cedulaHistoria')");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para verificar existencia previa de una historia a nombre de un medico puntual
	// Solo puede existir una historia registrada con un numero de cedula por medico - Pero pueden existir varias historias con la misma cedula con diferente medico
	public function verificarDuplicidad($cedulaHistoria,$idMedico){
		try{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM historia t1 
			INNER JOIN medico_historia t2 ON (t1.historia_id = t2.historia_id) 
			WHERE (t2.medico_id = '$idMedico') AND (t1.historia_cedula = '$cedulaHistoria')");
			$stm->execute();

			return $stm->rowCount();
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	// Metodo para obtener el ID de una historia especificada (N° Identficiacion Paciente - Medico propietario)
	// Solo puede existir una historia registrada con un numero de cedula por medico - Pero pueden existir varias historias con la misma cedula con diferente medico
	public function obtenerID($cedulaHistoria,$idMedico){
		try{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM historia t1 
			INNER JOIN medico_historia t2 ON (t1.historia_id = t2.historia_id) 
			WHERE (t2.medico_id = '$idMedico') AND (t1.historia_cedula = '$cedulaHistoria')");
			$stm->execute();

			return $stm->fetch(PDO::FETCH_OBJ); //Retorna el objeto HISTORIA encontrada con todas sus propiedades 
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
			//ACCION ESPECIAL Borrado de todas las CITAS antes de eliminar la HISTORIA
			//Borrar relaciones Citas - Historia
			$stm = $this->pdo
			            ->prepare("DELETE FROM historia_cita WHERE (historia_id = ?) ");			          
			$stm->execute(array($idHistoria));

			//Borrar Citas huerfanas (Que no tienen un registro en la tabla de relacion Historia-Cita)
			$stm = $this->pdo
			            ->prepare("DELETE b FROM cita b LEFT JOIN historia_cita f ON f.cita_id = b.cita_id WHERE f.cita_id IS NULL");			          
			$stm->execute();
		} 
		catch (Exception $e){
			die($e->getMessage());
		}

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

	// Metodo para actualizar un registro SOLO EL CAMPO ***CEDULA***
	public function actualizarIdentificacion($data){
		try{
			$sql = "UPDATE historia SET 
						historia_cedula      = ? 
						WHERE historia_id    = ?";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->historia_cedula,	
                        $data->historia_id //No se debe sobreescribir, se usa para ubicar el registro a modificar
					)
				);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
	}


	// Metodo para actualizar un registro
	public function Actualizar($data){
		try{
			$sql = "UPDATE historia SET 
						historia_nombre_1        = ?, 
						historia_nombre_2        = ?,
                        historia_apellido_1      = ?,
						historia_apellido_2      = ?,
						historia_direccion       = ?, 
						historia_telefono        = ?,
                        historia_profesion       = ?,
						historia_edad            = ?,
						historia_rxs             = ?, 
						historia_motivoconsulta  = ?,
						historia_hta_ap			 = ?,
						historia_hta_af			 = ?,
						historia_dm_ap			 = ?,
						historia_dm_af			 = ?,
						historia_asma_ap		 = ?,
						historia_asma_af		 = ?,
						historia_cancer_ap		 = ?,
						historia_cancer_af		 = ?,
						historia_quirurgicos_ap	 = ?,
						historia_quirurgicos_af	 = ?,
						historia_hospitalizaciones_ap	 = ?,
						historia_hospitalizaciones_af 	 = ?,
						historia_alergias_ap	 = ?,
						historia_alergias_af	 = ?,
						historia_fumador_ap		 = ?,
						historia_fumador_af		 = ?,
						historia_licor_ap		 = ?,
						historia_licor_af		 = ?,
						historia_otros			 = ?,
						historia_descripcion	 = ?,
						historia_planificacion	 = ?,
						historia_fgo_g			 = ?,
						historia_fgo_p			 = ?,
						historia_fgo_a			 = ?,
						historia_fgo_c			 = ?,
						historia_fgo_v			 = ?,
						historia_fum_dia		 = ?,
						historia_fum_mes		 = ?,
						historia_fum_ano		 = ?,
						historia_fup_dia		 = ?,
						historia_fup_mes		 = ?,
						historia_fup_ano		 = ?,
						historia_fuc_dia		 = ?,
						historia_fuc_mes		 = ?,
						historia_fuc_ano		 = ?,
						historia_ef				 = ?,
						historia_pa				 = ?,
						historia_fc				 = ?,
						historia_peso			 = ?,
						historia_fr				 = ?,
						historia_t				 = ?,
						historia_dx1			 = ?,
						historia_dx2			 = ?,
						historia_dx3			 = ?,
						historia_control		 = ?,
						historia_medico			 = ?,
						historia_fitoterapeuta	 = ?,
						historia_tratamiento	 = ?,
						historia_banos			 = ?,
						historia_bebidas	 	 = ?
				    WHERE historia_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->historia_nombre_1, 
						$data->historia_nombre_2,
                        $data->historia_apellido_1,
						$data->historia_apellido_2,
						$data->historia_direccion, 
						$data->historia_telefono,
                        $data->historia_profesion,
						$data->historia_edad,
						$data->historia_rxs, 
						$data->historia_motivoconsulta,
						$data->historia_hta_ap,
						$data->historia_hta_af,
						$data->historia_dm_ap,
						$data->historia_dm_af,
						$data->historia_asma_ap,
						$data->historia_asma_af,
						$data->historia_cancer_ap,
						$data->historia_cancer_af,
						$data->historia_quirurgicos_ap,
						$data->historia_quirurgicos_af,
						$data->historia_hospitalizaciones_ap,
						$data->historia_hospitalizaciones_af,
						$data->historia_alergias_ap,
						$data->historia_alergias_af,
						$data->historia_fumador_ap,
						$data->historia_fumador_af,
						$data->historia_licor_ap,
						$data->historia_licor_af,
						$data->historia_otros,
						$data->historia_descripcion,
						$data->historia_planificacion,
						$data->historia_fgo_g,
						$data->historia_fgo_p,
						$data->historia_fgo_a,
						$data->historia_fgo_c,
						$data->historia_fgo_v,
						$data->historia_fum_dia,
						$data->historia_fum_mes,
						$data->historia_fum_ano,
						$data->historia_fup_dia,
						$data->historia_fup_mes,
						$data->historia_fup_ano,
						$data->historia_fuc_dia,
						$data->historia_fuc_mes,
						$data->historia_fuc_ano,
						$data->historia_ef,
						$data->historia_pa,
						$data->historia_fc,
						$data->historia_peso,
						$data->historia_fr,
						$data->historia_t,
						$data->historia_dx1,
						$data->historia_dx2,
						$data->historia_dx3,
						$data->historia_control,
						$data->historia_medico,
						$data->historia_fitoterapeuta,
						$data->historia_tratamiento,
						$data->historia_banos,
						$data->historia_bebidas,
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
	public function registrar_Previo(Historia $data){
		try{
		$sql = "INSERT INTO historia (historia_cedula) 
				VALUES (?)";
				
		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->historia_cedula
					)
				);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}
		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}

	// Metodo para crear un nuevo registro
	public function Registrar(Historia $data){
		try{
		$sql = "INSERT INTO historia (historia_cedula,historia_nombre_1,historia_nombre_2,historia_apellido_1,historia_apellido_2,historia_direccion,historia_telefono,historia_profesion,historia_edad,historia_rxs,historia_motivoconsulta,
				historia_hta_ap,historia_hta_af,historia_dm_ap,historia_dm_af,historia_asma_ap,historia_asma_af,historia_cancer_ap,historia_cancer_af,historia_quirurgicos_ap,historia_quirurgicos_af,historia_hospitalizaciones_ap,historia_hospitalizaciones_af,historia_alergias_ap,historia_alergias_af,historia_fumador_ap,historia_fumador_af,historia_licor_ap,historia_licor_af,historia_otros,
				historia_descripcion,historia_planificacion,historia_fgo_g,historia_fgo_p,historia_fgo_a,historia_fgo_c,historia_fgo_v,historia_fum_dia,historia_fum_mes,historia_fum_ano,historia_fup_dia,historia_fup_mes,historia_fup_ano,historia_fuc_dia,historia_fuc_mes,historia_fuc_ano,
				historia_ef,historia_pa,historia_fc,historia_peso,historia_fr,historia_t,
				historia_dx1,historia_dx2,historia_dx3,historia_control,historia_medico,historia_fitoterapeuta,historia_tratamiento,historia_banos,historia_bebidas) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
					$data->historia_profesion,
					$data->historia_edad,
					$data->historia_rxs, 
					$data->historia_motivoconsulta,
					$data->historia_hta_ap,
					$data->historia_hta_af,
					$data->historia_dm_ap,
					$data->historia_dm_af,
					$data->historia_asma_ap,
					$data->historia_asma_af,
					$data->historia_cancer_ap,
					$data->historia_cancer_af,
					$data->historia_quirurgicos_ap,
					$data->historia_quirurgicos_af,
					$data->historia_hospitalizaciones_ap,
					$data->historia_hospitalizaciones_af, 
					$data->historia_alergias_ap,
					$data->historia_alergias_af,
					$data->historia_fumador_ap,
					$data->historia_fumador_af,
					$data->historia_licor_ap,
					$data->historia_licor_af,
					$data->historia_otros,
					$data->historia_descripcion,
					$data->historia_planificacion,
					$data->historia_fgo_g,
					$data->historia_fgo_p,
					$data->historia_fgo_a,
					$data->historia_fgo_c,
					$data->historia_fgo_v,
					$data->historia_fum_dia,
					$data->historia_fum_mes,
					$data->historia_fum_ano,
					$data->historia_fup_dia,
					$data->historia_fup_mes,
					$data->historia_fup_ano,
					$data->historia_fuc_dia,
					$data->historia_fuc_mes,
					$data->historia_fuc_ano,
					$data->historia_ef,
					$data->historia_pa,
					$data->historia_fc,
					$data->historia_peso,
					$data->historia_fr,
					$data->historia_t,
					$data->historia_dx1,
					$data->historia_dx2,
					$data->historia_dx3,
					$data->historia_control,
					$data->historia_medico,
					$data->historia_fitoterapeuta,
					$data->historia_tratamiento,
					$data->historia_banos,
					$data->historia_bebidas
                )
			);
		} 
		catch (Exception $e){
			die($e->getMessage());
		}

		return $this->pdo->lastInsertId(); //Retorna el ID (Autoincremental) del registro que se acaba de crear
	}
}