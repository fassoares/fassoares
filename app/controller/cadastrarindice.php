<!DOCTYPE html>
<html>
    <head>
         <meta charset = "utf-8"> <!--conjunto de caracter com  os caracteres especiais do portugues brasil-->
         <link rel="stylesheet" type = "text/css" href="Css/style.css">

         <title>Lista Unidade de Produtos</title>
    </head>
    <body>
        <header>
            <h1>Lista  Unidade de Produtos</h1>
        </header>        
        <div>
            <table border=1>
                <tr>
                    <td>mês</td>
                    <td>Ano</td>
                    <td>Lançamento</td>
                    <td>Valor R$</td>
                    <td>Índice JAM 3%</td>
                    <td>Valor Creditado R$</td>
                </tr>
<?php 
// criar as variáveis
 $Id;
$Mes;
$Ano;
$ValorJAM;
$IndiceJAN3;
$ValorCreditado;
$IndiceINPC_E;
$Juros3_E;
$NovoIndice_E;
$NovoCredito;
$DiferencaCredito;
$Correcao;
$TotalCorrigido;
$Pessoas_ID;
try{
    echo"_____________________________________________________________________________<BR>";
     $conn = new PDO('mysql:dbname=bd_acaofgts;host=localhost:3306','chico','chic@oSQL2020'); // conecatar com mysql
    //$conn = new PDO('sqlsrv:DataBase=mercado;server=localhost\sqlexpress;ConnectionPooling=0','chico','basedadossql'); // conecatar com mysql
    echo "<br> Conectado com a base de dados DB_ACAOFGTS! Cadastrar índice de atualização INPC</br>";
    echo"_____________________________________________________________________________<BR>";
}
catch(exception $ex){
    echo $ex->getMessage();
}


// Exemplo de scrip para exibir os nomes obtidos no arquivo CSV de exemplo
$delimitador = ',';
$cerca = '"';
// recebe o array com od dados do Arquivo selecionado
$dadosArq = $_FILES['arquivoTxt'];
//var_dump ($_FILES);
 
//$newfileArq = 'C:\Users\\fasso\\OneDrive\\Documents\\temp\\FGTS Manoel\\creditojan.csv'; 
$newfileArq = 'C:\Users\\fasso\\OneDrive\\Documents\temp\\FGTS Marcelo\\creditojanII.csv';
$fileArq =$_FILES['arquivoTxt']['tmp_name'];
 //Ler o arquivo para um array;
$arrayDados = file($fileArq);
 $f = fopen($fileArq, 'r');
$delimitador = ';';
$cerca = ' ';
if ($f) { 
    $newfile = fopen($newfileArq,"w+");
    fwrite($newfile,'Data;Lancamentos;Valor');
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
        $desc=substr($registro['Lancamentos'],0,7);
        
        if ($desc=="CREDITO"){
            $vetordata = explode('/',TRIM($registro['Data']));
            $Mes =  $vetordata[1];
            $Ano =   $vetordata[2];
            $lancamento = TRIM($registro['Lancamentos']);
            $ValorJAM = (float)str_replace(',','.',TRIM($registro['Valor']));
            $IndiceJAN3 = (float)str_replace(',','.',substr(TRIM($registro['Lancamentos']),-8));
            $ValorCreditado = ($ValorJAM/$IndiceJAN3) ;

            //fwrite($newfile,TRIM($registro['Data']).";".TRIM($registro['Lancamentos']).";".TRIM($registro['Valor']).PHP_EOL);
            ?>
            <tr>
                    <td><?php echo $Mes; ?></td>
                    <td><?php echo $Ano; ?></td>
                    <td><?php echo $lancamento; ?></td>
                    <td><?php echo $ValorJAM; ?></td>
                    <td><?php echo $IndiceJAN3; ?></td>                    
                    <td><?php echo $ValorCreditado; ?></td>
                </tr> 
            <?php
        }
        else {
            //echo " pulou "."<br>";
        }
        $desc="";
    }
    fclose($f);
    fclose($newfile);
    echo "Finalização da criação do arquivo csv das atualizações do FGTS.";
}
?>

            </table>
                    
        </div>
    </body>
</html>