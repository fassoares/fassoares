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
            <table border=0>
                <tr>
                    <td>id</td>
                    <td>mês</td>
                    <td>Ano</td>
                    <td>Indice JAN</td>
                    <td>Índice INPC</td>
                    <td>Juros</td>
                    <td>Novo Índice</td>
                </tr>
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
var_dump ($_FILES);
 
//$newfileArq = 'C:\Users\\fasso\\OneDrive\\Documents\\temp\\FGTS Manoel\\creditojan.csv'; 
//$newfileArq = 'C:\Users\\fasso\\OneDrive\\Documents\temp\\FGTS Francisco\\creditojan.csv';
$newfileArq = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\FGTS Marcelo\\creditojan.csv'; 
$fileArq =$_FILES['arquivoTxt']['tmp_name'];
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

            ?>
            <!-- <tr>
                    <td><?php echo $Id; ?></td>
                    <td><?php echo $Mes; ?></td>
                    <td><?php echo $Ano; ?></td>
                    <td><?php echo $IndiceJAN3; ?></td>
                    <td><?php echo $IndiceINPC_E; ?></td>
                    <td><?php echo $Juros3_E; ?></td>                    
                    <td><?php echo $NovoIndice_E; ?></td>
                </tr> -->
            <?php 
/*             $class = new Classeindex ("",$Mes,$Ano,$IndiceJAN3,$IndiceINPC_E,$Juros3_E,$NovoIndice_E); 
            $class->insertIndex(); */
        }
    }
fclose($f);
fclose($newfile);
echo "Finalização da criação do arquivo csv das atualizações do FGTS.";
?>

            </table>
                    
        </div>
    </body>
</html>