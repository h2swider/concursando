<?php

class UserModel {
    private $conexion;
	private $email;
	private $clave;
	private $pais;
	private $apellido;
	private $fecha_nacimiento;
	private $id_usuario;
	private $fecha_alta;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->conex;
    }

    public function guardarUsuario() {
		$query = $this->conexion->prepare($sql);
		$query->bindParam(":s", $habilitado, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public function setUsuario($email) {
		$this->email = $email;
	}
	
	public function setClave($clave) {
		$this->clave = $clave;
	}
	
	public function getClave() {
		return $this->clave;
	}
	
	public function getUsuario() {
		return $this->email;
	}
	
	public function getApellido() {
		return $this->apellido;
	}
	
	public function setApellido($apellido) {
		$this->apellido = $apellido;
	}
	
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	
	public function getNombre() {
		return $this->nombre;
	}
	
	public function setFechaAlta($fecha_alta) {
		$this->fecha_alta = $fecha_alta;
	}
	
	public function getFechaAlta() {
		return $this->fecha_alta;
	}
	
	public function getFechaNacimiento() {
		return $this->fecha_nacimiento;
	}
	
	public function setFechaNacimiento($fecha_nacimiento) {
		$this->fecha_nacimiento = $fecha_nacimiento;
	}
	
	public function setPais($pais) {
		$this->pais = $pais;
	}
	
	public function getPais() {
		return $this->pais;
	}
	
	public function setIdUsuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}
	
	public function getIdUsuario() {
		return $this->id_usuario;
	}

}
