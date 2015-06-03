<?php class TipoPreguntaModel {
	private $conexion;
	private $id_tipo_pregunta;
	private $descripcion; 
	
	public function __construct() {
        $this->conexion = Conexion::getInstance()->conex;
    }
	
	public function getTipoPreguntas() {
		try {
			$sql = "select id_tipo_pregunta, descripcion FROM tipo_pregunta WHERE habilitado = 'S'";
			$query = $this->conexion->prepare($sql);
			$query->execute();
			return $result = $query->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			Log::base($e->getMessage());
		} catch (Exception $e) {
			Log::base($e->getMessage());
		}
		
	}
}