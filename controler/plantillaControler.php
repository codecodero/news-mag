<?php
class PlantillaControler
{
    public function urls()
    {
        # code...
        if (isset($_GET["url"])) {
            $url = $_GET["url"];
        } else {
            $url = "inicio";
        }
        $pantillaModel = new PlantillaModelo();
        $pantillaModel->urls($url);
    }
}
