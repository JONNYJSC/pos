<?php

require_once "../controllers/usuarioscontroller.php";
require_once "../models/usuariosmodels.php";

class AjaxUsuarios
{
    // Editar Usuario

    public $idUsuario;

    public function ajaxEditarUsuario()
    {
        $item = "id";
        $valor = $this -> idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }
}

// Editar Usuario

if (isset($_POST["idUsuario"])) {
    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();
}
