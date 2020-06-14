<?php
// TODO: dar permiso a carpeta => suudo chmod -R 777 /nombre-carpeta
//FIXME: dar permiso para mover archivos con php => sudo chmod -R 777 /nombre-ruta
require_once 'modelo/blogModelo.php';
require_once 'modelo/paginacionModelo.php';

require_once 'controler/blogControler.php';
require_once 'controler/paginacionControler.php';
// TODO: PHPMIler
require 'vendor/autoload.php';
require_once 'controler/contactoControler.php';

require_once "controler/plantillaControler.php";

$plantillaControl = new PlantillaControler();
$plantillaControl->urls();
