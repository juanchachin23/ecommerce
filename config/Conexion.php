<?php

class Database {

    private $hostname="localhost";
    private $db="drurban";
    private $user="root";
    private $pass="";
    //private $charset="utfa8"; 

    // . "; charset=" . $this->charset

    function conectar()
    {
        try{
        $conexion = "mysql:host=".$this->hostname."; dbname=".$this->db;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo = new PDO($conexion, $this->user, $this->pass, $options);

        return $pdo;

    }   catch(PDOException $e){
        echo "Error de conexion: ".$e->getMessage();
        exit;
    }
    }
}