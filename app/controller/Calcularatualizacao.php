<?php

require_once('../model/sql.php');
require_once("../config/config.php");
require_once('../model/classeatualizarValor.php');

$classatualizar = new Classeatualizavalor();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"> <!--conjunto de caracter com  os caracteres especiais do portugues brasil-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSS -->
        <link rel="stylesheet" type = "text/css" href="../../bootstrap337/Css/bootstrap.min.css">
        <link rel="stylesheet" type = "text/css" href="../../bootstrap337/Css/bootstrap-theme.min.css">
        

        <title>Atualizar FGTS com INPC</title>
    </head>
    <body>
        <!--background-color:#BDBDBD;-->
        <div class = "container">
            <header>
                <h1 class="text-center text-uppercase">Lista Fornecedor</h1>
            </header>
            <form>
                <input method = "post">
                <p>CPF:<input type = "text" name ="txtCPF"/></p>  
                <div>
                    <input type ="submit"/>
                </div>
            </form>
<?php
//$cpf=htmlspecialchars($_POST['txtCPF']);
$sql = new Sql();
$classatualizar->loadByCPF('20747853215');
?>

        
<div>
                <!--"table table-condensed table-dark table-striped table-bordered table_hover"-->
                <table class = "table table-condensed table-dark table-striped table-bordered table_hover">
                    <tr>
                        <td>Id</td>
                        <td>CPF</td>
                        <td>Nome</td>
                        <td>CNPJ</td>
                        <td>Empresa</td>
                        <td>Fantasia</td>
                        <td>Insc. Estadual</td>
                        <td>Insc. Municipal</td>
                    </tr>
                    <?php
                        foreach($classatualizar as $atualizars) {
                    ?>
                    <tr>
                        <td><?php echo $atualizars['Id']; ?></td>
                        <td><?php echo $atualizars['CPF']; ?></td>
                        <td><?php echo $atualizats['nome'];?></td>
                        <td><?php echo $atualizars['CNPJ']; ?></td>
                        <td><?php echo $atualizars['Empresa'];?></td>
                        <td><?php echo $atualizars['NmFantasia'];?></td>                    
                        <td><?php echo $atualizars['InscEstadual'];?></td>                
                        <td><?php echo $atualizars['InscMunicipal'];?></td>
                    </tr>  
                    <?php }?>             
                </table>
                        
            </div>
        </div>
        <footer>
            <script src="../../bootstrap337/js/jquery.js" type = "text/javascript"></script>
            <script src="../../bootstrap337/js/bootstrap.min.js" type = "text/javascript"></script>
        </footer>
    </body>
</html>