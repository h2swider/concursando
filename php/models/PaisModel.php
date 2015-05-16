<?php 
class PaisModel {
	private $conexion;
	
	public function __construct() {
       $this->conexion = Conexion::getInstance()->conex;
    }
	
	public function getPaises() {
		$sql = "SELECT * FROM pais";
		$query = $this->conexion->prepare($sql);
		$query->bindParam(":s", $habilitado, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
}