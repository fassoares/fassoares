<?php
    class Conexao
    {
        private static $connection;
        
        private function __construct(){}
    
        public static function getConnection() {
            /* configuração para conexão SQLSERVER*/
            $pdoConfig  = DB_DRIVER . ":". "Server=" . DB_HOST . ";";
             $pdoConfig .= "Database=".DB_NAME.";"; 
             echo  $pdoConfig;
            /* configuração para conexão mysql
            $pdoConfig  = DB_DRIVER . ":". "dbname=" . DB_HOST . ";";
            $pdoConfig .= "host=".DB_NAME.";";*/
            try {
                if(!isset($connection)){
                    $connection =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                return $connection;
            } catch (PDOException $e) {
                $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                $mensagem .= "\nErro: " . $e->getMessage();
                throw new Exception($mensagem);
            }
        }
    }
?>