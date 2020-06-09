<?php
require_once 'modelo/blogModelo.php';
require_once 'modelo/paginacionModelo.php';
require_once 'controler/blogControler.php';
require_once 'controler/paginacionControler.php';

require_once "controler/plantillaControler.php";

$plantillaControl = new PlantillaControler();
$plantillaControl->urls();
