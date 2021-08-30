<?php
require_once "controllers/plantillacontroller.php";
require_once "controllers/categoriascontroller.php";
require_once "controllers/clientescontroller.php";
require_once "controllers/productoscontroller.php";
require_once "controllers/usuarioscontroller.php";
require_once "controllers/ventascontroller.php";

require_once "models/categoriasmodels.php";
require_once "models/clientesmodels.php";
require_once "models/productosmodels.php";
require_once "models/usuariosmodels.php";
require_once "models/ventasmodels.php";


$plantilla = new ControllerPlantilla();
$plantilla -> ctrPlantilla();
