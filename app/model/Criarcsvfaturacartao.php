<?php
$fileArq =$_FILES['arquivoTxt']['tmp_name'];
echo $fileArq;
$fileExist1 = 'C:\Users\\chico\\OneDrive\\Documents\\temp\\OUROCARD_VISA-Próxima_Fatura maio 2021.txt';
$fileExist ="C:\Users\\chico\\OneDrive\\Documents\\temp\\OUROCARD_VISA-Próxima_Fatura.txt";
$fileArq = "C:\Users\\chico\\OneDrive\\Documents\\temp\\fatura cartao maio 2021 previa.csv";
$arrayDatos = array();
if (file_exists($fileExist)){
    $fileName = fopen($fileExist,"r");
    $file = fopen($fileArq,"w+");
    fwrite($file,"Transações;valores;Eunice;Francisco \n\r");

    while (!feof($fileName)){
        $linha=trim(fgets($fileName));
        $linhaini=trim(substr($linha,0,10));
        if(!$linha==null || $linhaini==""){
            $transacoes = substr($linha,0,43);
            $valor = trim(substr($linha,56,14));
            fwrite($file,$transacoes.";".$valor.";0;0 \r\n");
        }
    }
    fclose($fileName);
    fclose($file);
    echo "Operação concluida!";

}else {
    echo "Não existe o arquivo ". $fileExist;
}

?> 