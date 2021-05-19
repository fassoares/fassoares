<?php

class Classeatualizavalor {
    private $Id;
    private $id_trabalhador;
    private $id_empresa;
    private $CNPJ;
    private $empresa;
    private $cpf;
    private $nome;
    private $numeroContafgts;
    private $valorJAM;
    private $valorCreditado;
    private $novoCredito;
    private $diferencaCredito;
    private $correcao;
    private $totalCorrigido;


    private $lin;
    private $linha;
    private $linhas;
    private $strsql;
    private $Descricao;


     //Criar acesso aos atributos da cleasse, os GET informa o valor & SET recebe o valor

    //Campo ID
    public function getId(){
        return $this->Id;
    } 
    public function setId($value){
        $this->Id = $value;
    }

    //Campo ID_TRABALHADOR
    public function getId_trabalhador(){
        return $this->id_trabalhador;
    } 
    public function setId_trabalhador($value){
        $this->id_Trabalhador = $value;
    }

    //Campo CPF
    public function getCPF(){
        return $this->cpf;
    }
    public function setCPF($value){
        $this->cpf = $value;
    }

    //Campo NOME
    public function getnome(){
        return $this->nome;
    }
    public function setnome($value){
        $this->nome = $value;
    }

    //Campo ID_EMPRESA
    public function getId_empresa(){
        return $this->id_empresa;
    }
    public function setId_empresa($value){
        $this->id_empresa = $value;
    }

    //Campo EMPRESA
    public function getempresa(){
        return $this->empresa;
    }
    public function setempresa($value){
        $this->empresa = $value;
    }

    //Campo CNPJ
    public function getCNPJ(){
        return $this->CNPJ;
    }
    public function setCNPJ($value){
        $this->CNPJ = $value;
    }

    //Campo  NUMERO CONTA FGTS
    public function getcontafgts(){
        return $this->numeroContafgts;
    }
    public function setcontafgts($value){
        $this->numeroContafgts = $value;
    }

    //Campo valorJAM
    public function getvalorJAM(){
        return $this->valorJAM;
    }
    public function setvalorJAM($value){
        $this->valorJAM = $value;
    }
    
    //Campo VALOR CREDITADO
    public function getvalorCreditado(){
        return $this->valorCreditado;
    }
    public function setvalorCreditado($value){
        $this->valorCreditado = $value;
    }

    //Campo NOVO VALOR
    public function getnovoCredito(){
        return $this->novoCredito;
    }
    public function setnovoCredito($value){
        $this->novoCredito = $value;        
    }

    //Campo DIFERENÇA CREDITO
    public function getdiferencaCredito(){
            return $this->diferencaCredito;
    }
    public function setdiferencaCredito($value){
            $this->diferencaCredito=$value;
    }

    //Campo CORREÇÃO
    public function getCorrecao(){
        return $this->Correcao;
    }
    public function setCorrecao($value){
        $this->correcao = $value;
    }

    //Campo TOTAL CORRIGIDO
    public function gettotalCorrigido(){
        return $this->totalCorrigido;
    }
    public function settotalCorrigido($value){
        $this->totalCorrigido = $value;
    }



    public function setData($data){
        //Aimenta a classe com os valores
        $this->setid($data['Id']);
        $this->setId_empresa($data['id_empresa']);
        $this->setCNPJ($data['CNPJ']);
        $this->setempresa($data['empresa']);
        $this->setId_trabalhador($data['Id_trabalhador']);
        $this->setCPF($data['cpf']);
        $this->setnome($data['nome']);
        $this->setcontafgts($data['numeroContafgts']);
        $this->setvalorJAM($data['ValorJAM']);
        $this->setvalorCreditado($data['ValorCreditado']);
        $this->setnovoCredito($data['NovoCredito']);
        $this->setdiferencaCredito($data['DiferençaCredito']);
        $this->setCorrecao($data['Correcao']);
        $this->settotalCorrigido($data['TotalCorrigido']);


    }

    public function loadByCPF($Id){
        $sql = new Sql();
        /*$results = $sql->selectSQL("SELECT T3.ID,T3.NumeroContaFGTS,T1.ID,T1.CPF,T1.Nome,T2.ID,T2.CNPJ,T2.Empresa 
                                    from (trabalhadordadosfgts as T3 inner join pessoas as T1 on T3.Pessoas_ID=T1.ID) 
                                    inner join Empresas T2 on T3.empresas_Id = T2.ID where CPF ='20747853215'", array(":CPF"=>$Id)); */
        $results = $sql->selectSQL("SELECT T3.ID,T3.NumeroContaFGTS,T1.ID,T1.CPF,T1.Nome,T2.ID,T2.CNPJ,T2.Empresa 
        from (trabalhadordadosfgts as T3 inner join pessoas as T1 on T3.Pessoas_ID=T1.ID) 
        inner join Empresas T2 on T3.empresas_Id = T2.ID ");
        
        if (count($results) > 0){
            $this->setData($results[0]);          
        }
    }

    public function __construct( $id = "",$id_empresa = "",$CNPJ = "",$id_trabalhador = "",$cpf = "",$nome = "",$numeroContafgts = "",$valorJAM="",
                                $valorCreditado="",$novoCredito="",$diferencaCredito= "",$correcao = "",$totalCorrigido = "")
        {
        if($id <>""){
            $this->setId($id);
        }
        $this->setId_empresa($id_empresa);
        $this->setCNPJ($CNPJ);
        $this->setId_trabalhador($id_trabalhador);
        $this->setCpf($cpf);
        $this->setnome($nome);
        $this->setcontafgts($numeroContafgts);
        $this->setvalorJAM($valorJAM);
        $this->setvalorCreditado($valorCreditado);
        $this->setnovoCredito($novoCredito);
        $this->setdiferencaCredito($diferencaCredito);
        $this->setCorrecao($correcao);
        $this->settotalCorrigido($totalCorrigido);

    }

}

?>