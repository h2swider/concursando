<?php

class EstadoModel {

    const CONFIRMAR = 1;
    const HABILITADO = 2;
    const ELIMINADO = 3;

    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->conex;
    }

    public function insertUsuarioEstado($id_usuario,  $id_estado, $fecha = false) {
        try {
            if (!$fecha) {
                $fecha = date('Y-m-d H:i:s');
            }
            /* Es importante que la fecha venga de afuera para asegurarme que sea igual al token */
            $sql = "INSERT INTO usuario_estado (fecha, id_estado, id_usuario) VALUES (:fecha, :id_estado, :id_usuario)";
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

    public function confirmarUsuario($token) {
        $tokenParts = explode("-", $token);
        $id_usuario = $tokenParts[0];
        $token = $tokenParts[1];
        $sql = "SELECT id_estado, id_usuario, fecha FROM usuario_estado WHERE id_usuario = :idu ORDER BY id_usuario_estado DESC LIMIT 0,1";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(":idu", $id_usuario, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetch(PDO::FETCH_ASSOC);
        if ($results && $token == md5($results['fecha'] . SALT) && $results['id_estado'] == EstadoModel::CONFIRMAR) {
            return $id_usuario;
        }
        Log::confirmacionMail("El token " . $token . " para el usuario => user_id: " . $id_usuario . " ha expirado.");
        return false;
    }

}
