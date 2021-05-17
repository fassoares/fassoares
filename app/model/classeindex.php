<?php
require_once('../model/sql.php');
class Classeindex {
    private $id;
    private $mes;
    private $ano;
    private $IndiceJAN3;
    private $IndiceINPC_E;
    private $Juros3_E;
    private $NovoIndice_E;


    //Criar acesso aos atributos da cleasse, os GET informa o valor & SET recebe o valor

    //Campo ID_fornecedor
    public function getId(){
        return $this->id;
    } 
    public function setId($value){
        $this->Id = $value;
    }

    //campo descricão
    public function getMes(){
        return $this->mes;
    }
    public function setMes($value){
        return $this->mes = $value;
    }

    //campo ano
    public function getano(){
        return $this->ano;        
    }
    public function setano($value){
        return $this->ano = $value;
    }


    //campo IndiceJAN3
    public function getIndiceJAN3(){
        return $this->IndiceJAN3;
    }
    public function setIndiceJAN3($value){
        return $this->IndiceJAN3 = $value;
    }

    //Campo IndiceINPC_E Mes do tipo de fornecedor
    public function getIndiceINPC_E(){
        return $this->IndiceINPC_E;
    }
    public function setIndiceINPC_E($value){
        return $this->IndiceINPC_E = $value;
    }

    //Campo juros3_E Mes do Nome fantasia
    public function getJuros3_E(){
        return $this->Juros3_E;        
    }
    public function setJuros3_E($value){
        return $this->Juros3_E = $value;        
    }
    
    //Campo NovoIndiceINPC_E 
    public function getNovoIndice_E(){
        return $this->NovoIndice_E;        
    }
    public function setNovoIndice_E($value){
        return $this->NovoIndice_E = $value;        
    }


    public function setData($data){
        //Aimenta a classe com os valores
            $this->setId($data['id']);
            $this->setMes($data['mes']);
            $this->setano($data['ano']);
            $this->setIndiceJAN3($data['IndiceJAN3']);
            $this->setIndiceINPC_E($data['IndiceINPC_E']);
            $this->setJuros3_E($data['Juros3_E']);
            $this->setNovoIndice_E($data['NovoIndice_E']);

    }
    public function loadById($Id){
        $sql = new Sql();
        $results = $sql->selectSQL("SELECT Id,Mes,Ano,IndiceJAM3,indiceINPC,Juros3,NovoIndice FROM bd_acaofgts.indicesinpc where id = :ID", array(":ID"=>$Id));
        if (count($results) > 0){
            $this->setData($results[0]);            
        }
    }

    public function insertIndex(){
        $sql= new Sql();
        try{
            $results = $sql -> selectSQL(" CALL SPInsertIndexsInpc(           
                :Mes,
                :ano,
                :IndiceJAN3,
                :Juros3_E,
                :IndiceINPC_E,
                :NovoIndice_E)", array(
                    ':Mes'=>$this->getMes(),
                    ':ano'=>$this->getano(),
                    ':IndiceJAN3'=>$this->getIndiceJAN3(),
                    ':Juros3_E'=>$this->getJuros3_E(),
                    'IndiceINPC_E' =>$this->getIndiceINPC_E(),
                    ':NovoIndice_E'=>$this->getNovoIndice_E()));
                if(count($results) > 0){
                    $this->setData($results[0]);
                }
        } catch (exception $ex){
                echo $ex->getMessage();
        }
    }

    public function AlterindexINPC($Id,$Mes,$ano,$valorJAM,$IndiceJAN3,$ValorCreditado,$Juros3_E,$NovoIndice_E,$NovoCredito){
        $classindexinpc = new IndexINPC;
        $sql= new Sql();
        try 
        {
            $results = $sql -> selectSQL("CALL SPalterIndicexsINPC(
                :id,
                :Mes,
                :ano,
                :IndiceJAN3,
                :Juros3_E,                
                :IndiceINPC_E,
                :NovoIndice_E)", array( ':id '=> $this->getId(),
                    ':Mes'=>$this->getMes(),
                    ':ano'=>$this->getano(),
                    ':IndiceJAN3'=>$this->getIndiceJAN3(),
                    ':Juros3_E'=>$this->getJuros3_E(),
                    'IndiceINPC_E' =>$this->getIndiceINPC_E(),
                    ':NovoIndice_E'=>$this->getNovoIndice_E()));
            if(count($results) > 0)
            {
                $this->setData($results[0]);
            }
        } 
        catch (exception $ex)
        {
            echo $ex->getMessage();
        }        
    }
    public function DelIndiceINPC($Id,$Mes,$ano){
        $sql = new Sql();
        $classindexinpc = new IndexINPC;
        try{
            $sql->query("DELETE FROM indicesinpc WHERE id =:ID",array(':ID'=>$Id));
            echo "Você acabou de deletar da base dadados o registro ". $Id."-".$Mes.", ano: ".$ano;

        } catch (exception $ex){
                echo $ex->getMessage();
        }

    }

    public function __construct( $id = "",$Mes = "",$ano = "",$IndiceJAN3 = "",$IndiceINPC_E= "",$Juros3_E="",$NovoIndice_E=""){
        if($id <>""){
            $this->setId($id);
        }
        $this->setMes($Mes);
        $this->setano($ano);
        $this->setIndiceJAN3($IndiceJAN3);
        $this->setIndiceINPC_E($IndiceINPC_E);
        $this->setJuros3_E($Juros3_E);
        $this->setNovoIndice_E($NovoIndice_E);

    }
    public function __toString(){
        return json_encode(array(
            "ID " => $this->getId(),
            "Mês " => $this->getMes(),
            "ano " => $this->getano(), 
            "Indice JAM 3%" => $this->getIndiceJAN3(),
            "INPC mês " => $this->getIndiceINPC_E(),
            "Juros 3% ano " => $this->getJuros3_E(),
            "Indice Atualizado "=> $this->getNovoIndice_E()));
    }
}


?>