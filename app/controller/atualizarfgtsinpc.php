<!DOCTYPE html>
<html>
    <head>
         <meta charset = "utf-8"> <!--conjunto de caracter com  os caracteres especiais do portugues brasil-->
         <link rel="stylesheet" type = "text/css" href="Css/style.css">

         <title>Gerar indice jam</title>
    </head>
    <body>
        <header>
            <h1>Gerar os indices, somente de atualização do mês</h1>
        </header>        
        
<?php 
require_once('../config/config.php');
require_once('../model/sql.php');
require_once('../model/classeindex.php');
// criar as variáveis
$Id=0;
$Mes;
$Ano;
$IndiceJAN3;
$IndiceINPC_E;
$Juros3_E;
$NovoIndice_E;
try{
      $conn = new PDO('mysql:dbname=bd_acaofgts;host=localhost:3306','chico','chic@oSQL2020'); // conecatar com mysql   
}
catch(exception $ex){
    echo $ex->getMessage();
}
// Exemplo de scrip para exibir os nomes obtidos no arquivo CSV de exemplo
$delimitador = ',';
$cerca = '"';
// recebe o array com od dados do Arquivo selecionado
$dadosArq = $_FILES['arquivoTxt'];
//$newfileArq = 'C:\Users\\fasso\\OneDrive\\Documents\\temp\\FGTS Manoel\\creditojan.csv'; 
//$newfileArq = 'C:\Users\\fasso\\OneDrive\\Documents\temp\\FGTS Francisco\\creditojan.csv';
//$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan 13766.csv'; 
//$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan 7529.csv';  
//$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan 30423.csv';  
//$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan 149038.csv'; 
//$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan 208109.csv'; 
//$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan 13766.csv'; 
$fileArq =$_FILES['arquivoTxt']['tmp_name'];
$parteName=explode(" ",$dadosArq["name"]);
$namcsv=ltrim($parteName[4], "0");
$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan'.$namcsv;
 //Ler o arquivo para um array;
$arrayDados = file($fileArq);
 $f = fopen($fileArq, 'r');
$delimitador = ';';
$cerca = ' ';
if ($f) { 
    $newfile = fopen($newfileArq,"w+");
    //fwrite($newfile,'Data;indiceJAM3;INPC_E; Juros3_E; Novo indice_E');
    fwrite($newfile,'Data;Lancamentos;Valor;Total');
    // Ler cabecalho do arquivo
    $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
    // Enquanto nao terminar o arquivo
    while (!feof($f)) { 

        // Ler uma linha do arquivo
        $linha = fgetcsv($f, 0, $delimitador, $cerca);
        if (!$linha) {
            continue;
        }

        // Montar registro com valores indexados pelo cabecalho
        $registro = array_combine($cabecalho, $linha);
        // Obtendo dados do arquivo
        $Id++;
/*         $vetordata = explode('/',TRIM($registro['Data']));
        $Mes =  $vetordata[1];
        $Ano =   $vetordata[2];
        $IndiceJAN3 = TRIM($registro['indiceJAM3']);
        $IndiceINPC_E = TRIM($registro['INPC_E']);
        $Juros3_E = TRIM($registro['Juros3_E']);
        $NovoIndice_E = TRIM($registro['Novoindice_E']);
        $Id++;
        $vetordata = explode('/',TRIM($registro['Data']));
        $Mes =  (int)$vetordata[1];
        $Ano =   (int)$vetordata[2];
        $IndiceJAN3 = (float)str_replace(',','.',TRIM($registro['indiceJAM3']));
        $IndiceINPC_E = (float)str_replace(',','.',TRIM($registro['INPC_E']));
        $Juros3_E = (float)str_replace(',','.',TRIM($registro['Juros3_E']));
        $NovoIndice_E = (float)str_replace(',','.',TRIM($registro['Novoindice_E'])); */
        if(substr(TRIM($registro['Lancamentos']),0,7)=='CREDITO')
            fwrite($newfile,TRIM($registro['Data']).";".TRIM($registro['Lancamentos']).";".TRIM($registro['Valor']).PHP_EOL);

/*             $class = new Classeindex ("",$Mes,$Ano,$IndiceJAN3,$IndiceINPC_E,$Juros3_E,$NovoIndice_E); 
            $class->insertIndex(); */
        }
    }
fclose($f);
fclose($newfile);
echo "Finalização da criação do arquivo csv das atualizações do FGTS.";
?>
    </body>
</html>