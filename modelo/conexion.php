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

    public function __construct()
    {
        # code...
        $this->driver = "mysql:";
        $this->host = "host=localhost;";
        $this->bd = "dbname=news_mag";
        $this->user = "root";
        $this->contrasena = "";
    }

    public function Conectar()
    {
        try {

            $con = new PDO($this->driver . $this->host . $this->bd, $this->user, $this->contrasena);

        } catch (PDOException $e) {

            echo "Error en: " . $e->getMessage();

        }
        return $con;
    }

}
