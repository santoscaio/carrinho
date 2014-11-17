<?php
session_start();
error_reporting(E_ALL);

include('class/conexaoClass.php');
include('class/menuClass.php');
include('class/finalizarClass.php');

$conexaoObj = new Conexao();
$menuObj = new Menu();
$finalizarObj = new Finalizar();

if ($_POST) {
    $dados = $_SESSION['dados'];
    $lista = $_SESSION['lista'];
    if(is_array($dados) && is_array($lista)) {
        $query0 = $finalizarObj->insertPessoa($dados);
        $executar0 = $conexaoObj->sql_query($query0, true);
        if ($executar0['erro'] == false) {
            $cont = 1;
            $idPessoa = $executar0['id'];
            $query1 = $finalizarObj->insertPedido($idPessoa);
            $executar1 = $conexaoObj->sql_query($query1, true);
            if ($executar1['erro'] == false) {
                $cont = 2;
                $idPedido = $executar1['id'];
                foreach ($lista as $ids => $campos) {
                    $executar2 = $conexaoObj->sql_query($query2);
                    if ($executar2['erro'] == false) {
                        $cont = 3;
                    }
                    $query2 = '';
                }
            }
        }
        session_destroy();
    }
}

$query1 = $menuObj->queryMenu();
$executar1 = $conexaoObj->sql_query($query1);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Lab Carrinho</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="custom/css/layout.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="custom/js/ie-emulation-modes-warning.js"></script>
        <!--[if lt IE 9]>
            <script src="custom/js/html5shiv.min.js"></script>
            <script src="custom/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Carrinho de Compras</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" role="form" name="busca" id="busca" method="post" action="resultado.php">
                        <div class="input-group">
                            <input type="text" class="form-control" name="busca" id="busca" placeholder="Buscar..."><span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><span class=" glyphicon glyphicon-search" aria-hidden="true"></span>                         
                                </button>
                            </span>
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="carrinho.php" title="Carrinho"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li><a href="index.php">Home</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <?php while ($resultado1 = mysql_fetch_assoc($executar1['result'])) { ?>
                            <li><a href="categoria.php?i=<?php echo $resultado1['id']; ?>"><?php echo $resultado1['nome']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><a href="carrinho.php">Carrinho</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Obrigado,</h1>
                    <h2 class="sub-header"><?php echo $dados['nome']; ?>, logo entraremos em contato com o status do pedido.</h2>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/jquery-2.0.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.maskedinput.min.js"></script>
    <script src="custom/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
