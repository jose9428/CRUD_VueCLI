<?php

require_once '../config/Config.php';
require_once '../modelo/EmpleadoDAO.php';

$dao = new EmpleadoDAO();

$accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";

if ($accion === "listar"):
    echo json_encode($dao->ListarTodos());
endif;

if ($accion === "buscar"):
    $params = json_decode(file_get_contents("php://input"));
    $data = $dao->BuscarPorId($params->id);
    echo json_encode($data);
endif;

if ($accion === "guardar"):
    $params = json_decode(file_get_contents("php://input"));
    $msg = $dao->Guardar($params);
    echo json_encode(array('msg' => $msg));
endif;

if ($accion === "editar"):
    $params = json_decode(file_get_contents("php://input"));
    $msg = $dao->Editar($params);
    echo json_encode(array('msg' => $msg));
endif;

if ($accion === "eliminar"):
    $params = json_decode(file_get_contents("php://input"));
    $msg = $dao->Eliminar($params->id);
    echo json_encode(array('msg' => $msg));
endif;
?>