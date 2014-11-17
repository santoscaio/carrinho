<?php
session_start();
error_reporting(E_ALL);

include('class/conexaoClass.php');
include('class/menuClass.php');

$conexaoObj = new Conexao();
$menuObj = new Menu();

$lista = $_SESSION['lista'];

if ($_POST) {
    $dados = $_POST;
    $_SESSION['dados'] = $dados;
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
                        <li class="active"><a href="carrinho.php" title="Carrinho"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></a></li>
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
                        <li class="active"><a href="carrinho.php">Carrinho</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <form class="form" role="form" name="carrinho" id="carrinho" method="post" action="finalizar.php">
                        <input type="hidden" name="confirma" id="confirma" value="true" />
                        <h1 class="page-header">Confirmação de compra</h1>
                        <h2 class="sub-header">Confirme seu pedido</h2>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $vTotal = 0;
                                        foreach ($lista as $id => $campos) {
                                            $vLinha = $campos['qtd'] * $campos['preco'];
                                            $vTotal = $vTotal + $vLinha;
                                            ?>
                                            <tr>
                                                <td><?php echo $campos['nome']; ?></td>
                                                <td><input class="form-control" type="text" name="qtd<?php echo $id; ?>" id="qtd<?php echo $id; ?>" value="<?php echo $campos['qtd']; ?>" disabled="disabled" /></td>
                                                <td>R$ <?php echo number_format($vLinha, 2, ",", "."); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td></td>
                                            <td>Total</td>
                                            <td>R$ <?php echo number_format($vTotal, 2, ",", "."); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h2 class="sub-header">Confirme seus dados</h2>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?php echo $dados['nome']; ?>" disabled="disabled" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo $dados['email']; ?>" disabled="disabled" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="telefone">Telefone</label>
                                <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="<?php echo $dados['telefone']; ?>" disabled="disabled" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 form-group">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço" value="<?php echo $dados['endereco']; ?>" disabled="disabled" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" value="<?php echo $dados['bairro']; ?>" disabled="disabled" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="<?php echo $dados['cidade']; ?>" disabled="disabled" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" value="<?php echo $dados['estado']; ?>" disabled="disabled" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="pais">Pais</label>
                                <input type="text" class="form-control" name="pais" id="pais" placeholder="Pais" value="<?php echo $dados['pais']; ?>" disabled="disabled" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="texto">Observação</label>
                                <textarea class="form-control" name="texto" id="texto" rows="3" disabled="disabled"><?php echo $dados['texto']; ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-md-offset-10 form-group">
                                <button type="submit" class="btn btn-success">Finalizar Compra</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/jquery-2.0.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="custom/js/ie10-viewport-bug-workaround.js"></script>
    <script>

    </script>
</body>
</html>
