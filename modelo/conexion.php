<?php
/**
 *
 */
class Conexion
{
    private $driver;
    private $host;
    private $bd;
    private $user;
    private $contrasena;

    public function __construct($bd_config)
    {
        # code...
        $this->driver     = $bd_config['driver'];
        $this->host       = $bd_config["host"];
        $this->bd         = $bd_config["bd"];
        $this->user       = $bd_config["usuario"];
        $this->contrasena = $bd_config['contrasena'];
    }

    public function Conectar()
    {
        try {
            
            $con = new PDO($this->driver.$this->host.$this->bd, $this->user, $this->contrasena);
            
        } catch (PDOException $e) {

            echo "Error en: " . $e->getMessage();

        }
        return $con;
    }

}
