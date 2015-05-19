<?php

class RecuperoModel {

    private $conexion;
    private $id;
    private $email;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->conex;
    }

    public function recovery($user_id) {
        try {
            $sql = "INSERT INTO recupero (fecha, id_usuario, tokken) VALUES (:f, :idu, :t)";
            $query = $this->conexion->prepare($sql);
            $date = date('Y-m-d H:i:s');
            $token = md5($date . SALT);
            $query->bindParam(":f", $date, PDO::PARAM_STR);
            $query->bindParam(":idu", $user_id, PDO::PARAM_INT);
            $query->bindParam(":t", $token, PDO::PARAM_STR);
            $query->execute();
            return $token;
        } catch (PDOException $e) {
            Log::recovery($e->getMessage());
        } catch (Exception $e) {
            Log::recovery($e->getMessage());
        }
        return false;
    }

    public function isValidToken($token) {
        $token_parts = explode('-',$token);
        if (sizeof($token_parts) == 2) {
            $data['id'] = $token_parts[0];
            $data['token'] = $token_parts[1];
            return $this->getTokken($data);
        }
        return false;
    }

    private function getTokken($data) {
        try {
            $sql = "SELECT id_recupero FROM recupero "
                    . " WHERE id_usuario = :id"
                    . " AND tokken = :token"
                    . " AND TIMESTAMPDIFF(DAY, fecha, now()) = 0"
                    . " ORDER BY fecha desc"
                    . " LIMIT 0,1";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(":id", $data['id'], PDO::PARAM_INT);
            $query->bindParam(":token", $data['token'], PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['id_recupero'] : false;
        } catch (PDOException $e) {
            Log::recovery($e->getMessage());
        } catch (Exception $e) {
            Log::recovery($e->getMessage());
        }
    }

}
