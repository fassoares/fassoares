<?php
require_once("config.php");
class IndexINPC {
    private $id;
    private $mes;
    private $ano;
    private $valorJAM;
    private $IndiceJAN3;
    private $ValorCreditado;
    private $IndiceINPC_E;
    private $Juros3_E;
    private $NovoIndice_E;
    private $NovoCredito;
    private $DiferencaCredito;
    private $Correcao;
    private $TotalCorrigido;
    private $Pessoas_ID;


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
        return $this->Mes;
    }
    public function setMes($value){
        return $this->Mes = $value;
    }

    //campo ano
    public function getano(){
        return $this->ano;        
    }
    public function setano($value){
        return $this->ano = $value;
    }

    //campo valorJAM
    public function getvalorJAM(){
        return $this->valorJAM;
    }
    public function setvalorJAM($value){
        return $this->valorJAM = $value;
    }

    //campo IndiceJAN3
    public function getIndiceJAN3(){
        return $this->IndiceJAN3;
    }
    public function setIndiceJAN3($value){
        return $this->IndiceJAN3 = $value;
    }

    //campo ValorCreditado
    public function getValorCreditado(){
        return $this->ValorCreditado;
    }  
    public function setValorCreditado($value){
        return $this->ValorCreditado = $value;
    }

    //Campo IndiceINPC_E Mes do tipo de fornecedor
    public function getIndiceINPC_E(){
        return $this->IndiceINPC_E;
    }
    public function setIndiceINPC_E($value){
        return $this->IndiceINPC_E = $value;
    }

    //Campo IndiceINPC_E Mes do Nome fantasia
    public function getJuros3_E(){
        return $this->Juros3_E;        
    }
    public function setJuros3_E($value){
        return $this->Juros3_E = $value;        
    }
    
    //Campo IndiceINPC_E 
    public function getNovoIndice_E(){
        return $this->NovoIndice_E;        
    }
    public function setNovoIndice_E($value){
        return $this->NovoIndice_E = $value;        
    }

    //Campo NovoCredito 
    public function getNovoCredito(){
        return $this->NovoCredito;        
    }
    public function setNovoCredito($value){
        return $this->NovoCredito = $value;        
    }

    //Campo DiferencaCredito
    public function getDiferencaCredito(){
        return $this->DiferencaCredito;
    } 
    public function setDiferencaCredito($value){
        $this->DiferencaCredito= $value;
    }

    //Campo Correcao
    public function getCorrecao(){
        return $this->Correcao;
    } 
    public function setCorrecao($value){
        $this->Correcao= $value;
    }

    //Campo TotalCorrigido
    public function getTotalCorrigido(){
        return $this->TotalCorrigido;
    } 
    public function setTotalCorrigido($value){
        $this->TotalCorrigido= $value;
    }

    //Campo Pessoas_ID
    public function getPessoas_ID(){
        return $this->Pessoas_ID;
    } 
    public function setPessoas_ID($value){
        $this->Pessoas_ID= $value;
    }


    public function setData($data){
        //Aimenta a classe com os valores
            $this->setId($data['id']);
            $this->setMes($data['Mes']);
            $this->setano($data['ano']);
            $this->setvalorJAM($data['valorJAM']);
            $this->setIndiceJAN3($data['IndiceJAN3']);
            $this->setValorCreditado($data['ValorCreditado']);
            $this->setIndiceINPC_E($data['IndiceINPC_E']);
            $this->setJuros3_E($data['Juros3_E']);
            $this->setNovoIndice_E($data['NovoIndice_E']);
            $this->setNovoCredito($data['NovoCredito']);
            $this->setIndiceINPC_E($data['DiferencaCredito']);
            $this->setJuros3_E($data['Correcao']);
            $this->setNovoIndice_E($data['TotalCorrigido']);
            $this->setNovoCredito($data['Pessoas_ID']);

    }
    public function loadById($Id){
        require_once("config.php");
        $sql = new Sql();
        $results = $sql->selectSQL("Select t2.CPF,T2.Nome,Id,Mes,Ano,ValorJAM,IndiceJAN3,ValorCreditado,IndiceINPC_E,Juros3_E,NovoIndice_E,NovoCredito,DiferencaCredito,Correcao,TotalCorrigido,Pessoas_ID " 
        . " FROM fgtsatualizarpessoa T1 inner join pessoa t2  on T1.pessoas_id = t2.id where t2.id = :ID", array(
            ":ID"=>$Id
        ));
        if (count($results) > 0){
            $this->setData($results[0]);            
        }
    }
    public static function getListPessoa(){
        $sql = new Sql();
        $results = $sql->selectSQL("Select ID, CPF, Nome, email, senha, create_time FROM pessoas T1");
        return $results;
    }
    public function searchPessoa($nome){
        $sql = new Sql();
        $results = $sql->selectSQL("Select ID, CPF, Nome, email, senha, create_time FROM pessoas T1 where T1.nome like :SEARCH order by t1.nome", array(
            ':SEARCH'=>"%".$nome."%") );
        return $results;
    }
    public function insertIndex(){
        $sql= new Sql();
        try{
            $results = $sql -> selectSQL(" CALL SPInsertIndexInpc(           
                :Mes,
                :ano,
                :valorJAM,
                :IndiceJAN3,
                :ValorCreditado,
                :Juros3_E,
                :NovoIndice_E,
                :NovoCredito,
                :DiferencaCredito,
                :v_Correcao,
                :TotalCorrigido,
                :Pessoas_ID)", array(
                    ':Mes'=>$this->getMes(),
                    ':ano'=>$this->getano(),
                    ':valorJAM'=>$this->getvalorJAM(),
                    ':IndiceJAN3'=>$this->getIndiceJAN3(),
                    ':ValorCreditado'=>$this->getValorCreditado(),
                    ':Juros3_E'=>$this->getJuros3_E(),
                    ':NovoIndice_E'=>$this->getNovoIndice_E(),
                    ':NovoCredito'=>$this->getNovoCredito(),
                    ':DiferencaCredito'=>$this->getDiferencaCredito(),
                    ':Correcao'=>$this->getCorrecao(),
                    ':TotalCorrigido'=>$this->getTotalCorrigido(),
                    ':Pessoas_ID'=>$this->getPessoas_ID()
                ));
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
            $results = $sql -> selectSQL("CALL SPalterIndiceINPC(
                :id,
                :Mes,
                :ano,
                :valorJAM,
                :IndiceJAN3,
                :ValorCreditado,
                :Juros3_E,
                :NovoIndice_E,
                :NovoCredito,
                :DiferencaCredito,
                :v_Correcao,
                :TotalCorrigido,
                :Pessoas_ID)", array( ':id '=> $this->getId(),
                    ':Mes'=>$this->getMes(),
                    ':ano'=>$this->getano(),
                    ':valorJAM'=>$this->getvalorJAM(),
                    ':IndiceJAN3'=>$this->getIndiceJAN3(),
                    ':ValorCreditado'=>$this->getValorCreditado(),
                    ':Juros3_E'=>$this->getJuros3_E(),
                    ':NovoIndice_E'=>$this->getNovoIndice_E(),
                    ':NovoCredito'=>$this->getNovoCredito(),
                    ':DiferencaCredito'=>$this->getDiferencaCredito(),
                    ':Correcao'=>$this->getCorrecao(),
                    ':TotalCorrigido'=>$this->getTotalCorrigido(),
                    ':Pessoas_ID'=>$this->getPessoas_ID()
            ));
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
    public function DelFornecedor($Id_Fornecedor,$Mes,$ano,$Juros3_E){
        $sql = new Sql();
        $classindexinpc = new IndexINPC;
        try{
            $sql->query("DELETE FROM tb_fornecedor WHERE Id_Fornecedor=:ID",array(
                ':ID'=>$Id_Fornecedor
            ));
            echo "Você acabou de deletar da base dadados o registro ". $Id_Fornecedor."-".$Mes.", ano: ".$ano." Fornecedor: ".$Juros3_E;

        } catch (exception $ex){
                echo $ex->getMessage();
        }

    }

    public function __construct( $id = "",$Mes = "",$ano = "",$valorJAM = "",$IndiceJAN3 = "",$ValorCreditado = "",$IndiceINPC_E= "",
    $Juros3_E="",$NovoIndice_E="",$NovoCredito="",$DiferencaCredito="",$Correcao="",$TotalCorrigido="",$Pessoas_ID=""){
        if($id <>""){
            $this->setId($id);
        }
        $this->setMes($Mes);
        $this->setano($ano);
        $this->setvalorJAM($valorJAM);
        $this->setIndiceJAN3($IndiceJAN3);
        $this->setValorCreditado($ValorCreditado);
        $this->setIndiceINPC_E($IndiceINPC_E);
        $this->setJuros3_E($Juros3_E);
        $this->setNovoIndice_E($NovoIndice_E);
        $this->setNovoCredito($NovoCredito);
        $this->setDiferencaCredito($DiferencaCredito);
        $this->setCorrecao($Correcao);
        $this->setTotalCorrigido($TotalCorrigido);
        $this->setPessoas_ID($Pessoas_ID);

    }
    public function __toString(){
        return json_encode(array(
            "ID " => $this->getId(),
            "Mês " => $this->getMes(),
            "ano " => $this->getano(), 
            "Valor JAM " => $this->getvalorJAM(),
            "Indice JAM 3%" => $this->getIndiceJAN3(),
            "Valor Creditado " => $this->getValorCreditado(),
            "INPC mês " => $this->getIndiceINPC_E(),
            "Juros 3% ano " => $this->getJuros3_E(),
            "Indice Atualizado "=> $this->getNovoIndice_E(),
            "Credito Atualizado " => $this->getNovoCredito(),
            "Diferença Credito " => $this->getDiferencaCredito(),
            "Correção " => $this->getCorrecao(),
            "Valor Acumulado " => $this->getTotalCorrigido()
        ));
    }
}


?>