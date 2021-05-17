<?php

class Sql extends PDO {
    private $conexao;
    public function __construct(){
        $this -> conexao = new PDO("mysql:hot=localhost:3306;dbname=mercado_bd","chico","chic@oSQL2020");        
    }
    private function setParam($stmt,$key, $value){        
        $stmt -> bindParam($key, $value);
    }
    private function setParams($stmt, $parameters=array()){
        foreach($parameters as $key => $value){
            $this -> setParam($stmt,$key,$value);
        }
    }

    public function query($rawQuery,$params = array())    {
        $stmt = $this->conexao->prepare($rawQuery);
        $this->setParams($stmt,$params); 
        $stmt->execute();
        return $stmt;
    }

    public function selectSQL($rawQuery,$params = array()):array
    {
        try {
            $stmt= $this->query($rawQuery,$params);
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (exception $ex){
                echo $ex->getMessage();
        }
        
        
    }
}
?>