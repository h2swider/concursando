<?php class ConcursoModel { 
		private $conexion;
		private $id_concurso;
		
		public function __construct() {
			$this->conexion = Conexion::getInstance()->conex;
		}
		
		public function createSurvey($data) {
			try {
				$this->conexion->beginTransaction();
				$id_concurso = $this->insertSurvey($data);
				foreach($data['pregunta'] as $k=>$pregunta) {
					$id_pregunta = $this->insertQuestion($pregunta, $data['tipo'][$k], $id_concurso);
					if (isset($data['opcion'][$k])) {
						foreach($data['opcion'][$k] as $opcion) {
							$this->insertOption($id_pregunta, $opcion);
						}
					}
				}
				$this->addFile($id_concurso);
				$this->conexion->commit();
			    return $this->conexion->lastInsertId();
			} catch (PDOException $e) {
				$this->conexion->rollBack();
				Log::base($e->getMessage());
			} catch (Exception $e) {
				$this->conexion->rollBack();
				Log::base($e->getMessage());
			}
		}
		
		private function insertSurvey($data) {
			$f_inicio = new DateTime(str_replace('/', '-', $data['f_inicio']));
			$f_inicio_formateada = $f_inicio->format('Y-m-d H:i:s');
			$f_fin = new DateTime(str_replace('/', '-', $data['f_fin']));
			$f_fin_formateada = $f_fin->format('Y-m-d H:i:s');
			$sql = "INSERT INTO concurso (id_usuario, nombre, descripcion, empresa, f_inicio, f_fin, habilitado, f_creacion) VALUES (:idu, :n, :d, :e, :fi, :ff, 'S', :fc)";
			$query = $this->conexion->prepare($sql);
			$query->bindParam(":idu", $_SESSION['userdata']['id_usuario'], PDO::PARAM_INT);
			$query->bindParam(":n", $data['nombre'], PDO::PARAM_STR);
			$query->bindParam(":d", $data['descripcion'], PDO::PARAM_STR);
			$query->bindParam(":e", $data['organizacion'], PDO::PARAM_STR);
			$query->bindParam(":fi", $f_inicio_formateada, PDO::PARAM_STR);
			$query->bindParam(":ff", $f_fin_formateada, PDO::PARAM_STR);
			$query->bindParam(":fc", date('Y-m-d H:i:s'), PDO::PARAM_STR);
			$query->execute();
			return $this->conexion->lastInsertId();
		}
		
		private function insertQuestion($pregunta, $tipo, $id_concurso) {
			/* el obligatorio está hardcodeado */
			var_dump($pregunta);
			$obligatorio = 1;
			$sql = "INSERT INTO pregunta (id_tipo_pregunta, id_concurso, descripcion, habilitado, obligatorio) VALUES (:idp, :ic, :d, 'S', :o)";
			$query = $this->conexion->prepare($sql);
			$query->bindParam(":idp", $tipo, PDO::PARAM_INT);
			$query->bindParam(":ic", $id_concurso, PDO::PARAM_INT);
			$query->bindParam(":d", $pregunta, PDO::PARAM_STR);
			$query->bindParam(":o", $obligatorio, PDO::PARAM_STR);
			$query->execute();
			return $this->conexion->lastInsertId();
		}
		
		
		private function insertOption($id_pregunta, $opcion) {
			$sql_opcion = "INSERT INTO opcion (id_pregunta, descripcion) VALUES (:ip, :d)";
			$query_opcion = $this->conexion->prepare($sql_opcion);
			$query_opcion->bindParam(":ip", $id_pregunta, PDO::PARAM_INT); // LA PUTA MADRE
			$query_opcion->bindParam(":d", $opcion, PDO::PARAM_STR);
			$query_opcion->execute();
		}
		
		
		public function addFile($file, $id_concurso) {
			var_dump($_FILES);
		}
} ?>