<?php

class UserModel {
    private $conexion;
	private $id;
	private $email;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->conex;
    }

    public function guardarUsuario($data) {
        try {
            
            $fecha_nacimiento = new DateTime(str_replace('/', '-', $data['fecha_nacimiento']));
            $fecha_nacimiento = $fecha_nacimiento->format('Y-m-d H:i:s');
            $data['nombre'] = strtolower($data['nombre']);
            $data['apellido'] = strtolower($data['apellido']);
            $data['email'] = strtolower($data['email']);
            $sql = "INSERT INTO usuario (email, f_alta, pass, id_pais, nombre, apellido, f_nacimiento) VALUES (:e, :fa, :p, :idp, :n, :a, :fn)";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(":e", $data['email'], PDO::PARAM_STR);
            $query->bindParam(":fa", $data['f_alta'], PDO::PARAM_STR);
            $query->bindParam(":p", $data['password'], PDO::PARAM_STR);
            $query->bindParam(":idp", $data['pais'], PDO::PARAM_INT);
            $query->bindParam(":n", $data['nombre'], PDO::PARAM_STR);
            $query->bindParam(":a", $data['apellido'], PDO::PARAM_STR);
            $query->bindParam(":fn", $fecha_nacimiento, PDO::PARAM_STR);
            $query->execute();
            return $this->conexion->lastInsertId();
        } catch (PDOException $e) {
            Log::base($e->getMessage());
        } catch (Exception $e) {
            Log::base($e->getMessage());
        }
    }

    public function existsEmail($email) {
        try {
            $sql = "SELECT id_usuario, email FROM usuario WHERE email = :e";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(":e", $email, PDO::PARAM_STR);
            $query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$this->setId($result['id_usuario']);
			$this->setEmail($result['email']);
            return $result['id_usuario'];
        } catch (PDOException $e) {
            Log::base($e->getMessage());
        } catch (Exception $e) {
            Log::base($e->getMessage());
        }
    }
	
	public function isActive($id_usuario) {
		try {
			$sql = "SELECT id_usuario FROM usuario_estado WHERE id_usuario = :idu AND id_estado = ".EstadoModel::HABILITADO;
			$query = $this->conexion->prepare($sql);
			$query->bindParam(":idu", $id_usuario, PDO::PARAM_INT);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$this->setId($result['id_usuario']);
			return $result['id_usuario'];
		} catch (PDOException $e) {
			Log::userLogin($e->getMessage());
		} catch (Exception $e) {
			Log::userLogin($e->getMessage());
		}
	}	
	
	
	public function login($user, $password) {
		try {
			$sql = "SELECT id_usuario, email, nombre, apellido FROM usuario WHERE email = :e AND pass = :p";
			$query = $this->conexion->prepare($sql);
			$query->bindParam(":e", $user, PDO::PARAM_STR);
			$query->bindParam(":p", $password, PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);
			if ($result) {
				return $result;
			} else {
				Log::userLogin("El usuario ".$user." ha intentado loguearse con una contrase&ntilde;a incorrecta.");
			}
		} catch (PDOException $e) {
			Log::base($e->getMessage());
		} catch (Exception $e) {
			Log::base($e->getMessage());
		}
		return false;
	}
	
	private function setId($id) {
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}
	
	private function setEmail($email) {
		$this->email = $email;
	}
	
	public function getEmail() {
		return $this->email;
	}

}
