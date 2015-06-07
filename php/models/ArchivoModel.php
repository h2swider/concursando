<?php 
	class ArchivoModel {
		const JPG = 1;
		const PNG = 2;
		const BMP = 3;
		const DOC = 4;
		const PDF = 5;
		public static $imageTypes = [ArchivoModel::JPG, ArchivoModel::PNG, ArchivoModel::BMP];
		private $conexion;
		
		public function __construct() {
			$this->conexion = Conexion::getInstance()->conex;
		}
		
		public function getTypes($types = null) {
			var_dump($types);
			if ($types !== null) {
				$sql = "SELECT descripcion FROM tipo_archivo WHERE id_tipo_archivo IN (".implode(",", $types).")";
				echo $sql;
			} else {
				$sql = "SELECT descripcion FROM tipo_archivo";
			}
			$query = $this->conexion->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_COLUMN);
			return $results;
		}
	
}