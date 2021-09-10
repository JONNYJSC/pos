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

    // Activar Usuario
    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario()
    {
        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this -> activarUsuario;

        $item2 = "id";
        $valor2 = $this -> activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
    }
}

// Editar Usuario

if (isset($_POST["idUsuario"])) {
    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();
}

// Activar Usuario
if (isset($_POST["activarUsuario"])) {
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
    $activarUsuario -> activarId = $_POST["activarId"];
    $activarUsuario -> ajaxActivarUsuario();
}
