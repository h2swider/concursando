<?php

class EstadoModel {
    
    const CONFIRMAR = 1;
    const HABILITADO = 2;
    const ELIMINADO = 3;

    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->conex;
    }

    public function insertUsuarioEstado($id_usuario, $id_estado) {

        try {
            $fecha = date('Y-m-d H:i:s');
            $sql = "INSERT INTO usuario_estado (fecha, id_estado, id_usuario) VALUES (:fecha, :id_usuario, :id_estado)";

            $query = $this->conexion->prepare($sql);
            $query->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $query->bindParam(":id_estado", $id_estado, PDO::PARAM_INT);
            $query->execute();
            return $this->conexion->lastInsertId();
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

}
