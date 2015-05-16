<?php

class UserModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->conex;
    }

    public function guardarUsuario($data) {
		try {
			$fecha_alta = date('Y-m-d H:i:s');
			$fecha_nacimiento = new DateTime(str_replace('/', '-', $data['fecha_nacimiento']));
			$fecha_nacimiento = $fecha_nacimiento->format('Y-m-d H:i:s');
			$sql = "INSERT INTO usuario (email, f_alta, pass, id_pais, nombre, apellido, f_nacimiento) VALUES (:e, :fa, :p, :idp, :n, :a, :fn)";
			$query = $this->conexion->prepare($sql);
			$query->bindParam(":e", $data['email'], PDO::PARAM_STR);
			$query->bindParam(":fa", $fecha_alta, PDO::PARAM_STR);
			$query->bindParam(":p", $data['password'], PDO::PARAM_STR);
			$query->bindParam(":idp", $data['pais'], PDO::PARAM_INT);
			$query->bindParam(":n", $data['nombre'], PDO::PARAM_STR);
			$query->bindParam(":a", $data['apellido'], PDO::PARAM_STR);
			$query->bindParam(":fn", $fecha_nacimiento, PDO::PARAM_STR);
			$query->execute();
		} catch (PDOException $e) {
			Log::base($e->getMessage());
			header("Location: /registro/error-registro");
			exit;
		} catch (Exception $e) {
			Log::base($e->getMessage());
			header("Location: /registro/error-registro");
			exit;
		}
    }
	
	public function valid($email) {
		try {
			$sql = "SELECT 1 FROM usuario WHERE email = :e";
			$query = $this->conexion->prepare($sql);
			$query->bindParam(":e", $email, PDO::PARAM_STR);
			$query->execute();
			return !$query->rowCount();
		} catch (PDOException $e) {
			Log::base($e->getMessage());
		} catch (Exception $e) {
			Log::base($e->getMessage());
		}
	}
}
