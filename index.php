<?php
// TODO: dar permiso a carpeta => sudo chmod -R 777 /nombre-carpeta
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
/*
TODO: iniciar apache arch sudo systemctl restart httpd
 *
 *
FIXME: php install=> apt install php7.4 libapache2-mod-php7.4 php7.4-mysql php-common php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-readline
 */
