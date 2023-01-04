<?php

require_once '../config/Database.php';

class EmpleadoDAO {

    public function Guardar($data) {
        $msg = "";
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $db->set_names();

            $sql = "insert into Empleado(nombres,ape_paterno,ape_materno,genero,fecha_nacimiento,fecha_registro,correo,sueldo) "
                    . "values(?,?,?,?,?,NOW(),?,?)";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $data->nombres);
            $stmt->bindValue(2, $data->ape_paterno);
            $stmt->bindValue(3, $data->ape_materno);
            $stmt->bindValue(4, $data->genero);
            $stmt->bindValue(5, $data->fecha_nacimiento);
            $stmt->bindValue(6, $data->correo);
            $stmt->bindValue(7, $data->sueldo);

            /*
              $stmt->bindValue(1, $data["nombres"]);
              $stmt->bindValue(2, $data["ape_paterno"]);
              $stmt->bindValue(3, $data["ape_materno"]);
              $stmt->bindValue(4, $data["genero"]);
              $stmt->bindValue(5, $data["fecha_nacimiento"]);
              $stmt->bindValue(6, $data["correo"]);
              $stmt->bindValue(7, $data["sueldo"]);
             */
            if ($stmt->execute()) {
                // $id = $conn->lastInsertId();
                $msg = "OK";
            } else {
                $msg = "No se pudo registrar empleado";
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
        return $msg;
    }

    public function Editar($data) {
        $msg = "";
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $db->set_names();

            $sql = "update Empleado set nombres=?,ape_paterno=?,ape_materno=?,genero=?,"
                    . "fecha_nacimiento=?,correo=?,sueldo=? "
                    . "where id_empleado=? ";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $data->nombres);
            $stmt->bindValue(2, $data->ape_paterno);
            $stmt->bindValue(3, $data->ape_materno);
            $stmt->bindValue(4, $data->genero);
            $stmt->bindValue(5, $data->fecha_nacimiento);
            $stmt->bindValue(6, $data->correo);
            $stmt->bindValue(7, $data->sueldo);
            $stmt->bindValue(8, $data->id_empleado);

            if ($stmt->execute()) {
                $msg = "OK";
            } else {
                $msg = "No se pudo editar empleado";
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
        return $msg;
    }

    public function Eliminar($id) {
        $msg = "";
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $db->set_names();

            $sql = "delete from Empleado where id_empleado=?";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);

            if ($stmt->execute()) {
                $msg = "OK";
            } else {
                $msg = "No se pudo eliminar empleado";
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
        return $msg;
    }

    function ListarTodos() {
        $db = new Database();
        $conn = $db->getConnection();
        $db->set_names();

        $sql = "select * from Empleado";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function BuscarPorId($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $db->set_names();

        $sql = "select * from Empleado where id_empleado=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetch();
    }

}

?>