<?php
class PlantillaModelo{

    public function Urls($url)
    {
       if (file_exists("vista/paginas/$url.php")) {

           include ("vista/paginas/$url.php");

       }else{

           include("vista/paginas/error404.php");
           
       }
    }
}