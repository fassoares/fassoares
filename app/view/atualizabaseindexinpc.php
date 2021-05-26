<?php
    require_once('../../vendor/autoload.php');
    require_once('../config/config.php');
    require_once('../functions/functions.php');
    //(new \app\core\RouterCore());
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"> <!--conjunto de caracter com  os caracteres especiais do portugues brasil-->
        <!-- <link rel="stylesheet" type = "text/css" href="Css/style.css"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSS -->
        <link rel="stylesheet" type = "text/css" href="../../bootstrap337/Css/bootstrap.min.css">
        <link rel="stylesheet" type = "text/css" href="../../bootstrap337/Css/bootstrap-theme.min.css">

         <title>Criar arquivo CSV</title>
    </head>
    <body class="container">
        <header>
            <h1 class="text-center text-uppercase">Criar a base de dados para atualizar os valores FGTS</h1>
            <h1 class="text-center text-uppercase">através da leitura do arquivo extraido da base de atualização do site https://acessoseguro.sso.caixa.gov.br/portal/</h1>
        </header>
        <form method="post" action ="../controller/atualizarfgtsinpc.php" enctype="multipart/form-data">
            <label>Buscar Arquivo Extratofgts.csv</label><br><br>
            <input type="file" name="arquivoTxt" value = 'busca'><br><br>
            <input type="submit" value="Ler arquivo"><br><br>
        </form>
    </body>
</html>