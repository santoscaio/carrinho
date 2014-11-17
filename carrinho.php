<?php
session_start();
error_reporting(E_ALL);

include('class/conexaoClass.php');
include('class/carrinhoClass.php');
include('class/menuClass.php');

$conexaoObj = new Conexao();
$carrinhoObj = new Carrinho();
$menuObj = new Menu();

$lista = '';
$add = $rem = $upd = 0;
if (isset($_GET['a'])) {
    $add = trim($_GET['a']);
}
if (isset($_GET['r'])) {
    $rem = trim($_GET['r']);
}
if (isset($_GET['u'])) {
    $upd = trim($_GET['u']);
}
if (isset($_GET['q'])) {
    $qtd = trim($_GET['q']);
}
if (isset($_GET['i'])) {
    $idp = trim($_GET['i']);
}

if ($add == 1 && $idp > 0) {
    if (isset($_SESSION['lista'])) {
        $addProduto = $_SESSION['lista'];
    }
    if (array_key_exists($idp, $addProduto)) {
        $addProduto[$idp]['qtd'] = $addProduto[$idp]['qtd'] + 1;
    } else {
        $query0 = $carrinhoObj->queryProduto($idp);
        $executar0 = $conexaoObj->sql_query($query0);
        $resultado0 = mysql_fetch_assoc($executar0['result']);

        $addProduto[$idp]['nome'] = $resultado0['nome'];
        $addProduto[$idp]['preco'] = $resultado0['preco'];
        $addProduto[$idp]['qtd'] = 1;
    }
    $_SESSION['lista'] = $addProduto;
    $lista = $addProduto;
}

if ($rem == 1 && $idp > 0) {
    $remProduto = $_SESSION['lista'];
    unset($remProduto[$idp]);
    $_SESSION['lista'] = $remProduto;
    $lista = $remProduto;
}

if ($upd == 1 && $idp > 0 && $qtd > 0) {
    $updProduto = $_SESSION['lista'];
    $updProduto[$idp]['qtd'] = $qtd;
    $_SESSION['lista'] = $updProduto;
    $lista = $updProduto;
}

if ($upd == 0 && $rem == 0 && $add == 0) {
    if (isset($_SESSION['lista'])) {
        $lista = $_SESSION['lista'];
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
                    <form class="form" role="form" name="carrinho" id="carrinho" method="post" action="confirmar.php">
                        <h1 class="page-header">Carrinho</h1>
                        <h2 class="sub-header">Confira os produtos</h2>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th colspan="2"></th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $vTotal = 0;
                                        if (is_array($lista)) {
                                            foreach ($lista as $id => $campos) {
                                                $vLinha = $campos['qtd'] * $campos['preco'];
                                                $vTotal = $vTotal + $vLinha;
                                                ?>
                                                <tr>
                                                    <td><?php echo $campos['nome']; ?></td>
                                                    <td><input class="form-control" type="text" name="qtd<?php echo $id; ?>" id="qtd<?php echo $id; ?>" value="<?php echo $campos['qtd']; ?>" /></td>
                                                    <td><a href="#" valor="<?php echo $id; ?>" title="Atualizar" class="update"><span class="glyphicon glyphicon-refresh"></span></a></td>
                                                    <td><a href="carrinho.php?r=1&i=<?php echo $id; ?>" title="Excluir"><span class="glyphicon glyphicon-remove"></span></a></td>
                                                    <td>R$ <?php echo number_format($vLinha, 2, ",", "."); ?></td>
                                                </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Total</td>
                                            <td>R$ <?php echo number_format($vTotal, 2, ",", "."); ?></td>
                                        </tr>
                                        <?php } else { ?>
                                        <tr>
                                            <td colspan="5">Não há itens no carrinho</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h2 class="sub-header">Preencha seus dados</h2>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required="required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required="required" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="telefone">Telefone</label>
                                <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="Telefone" required="required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 form-group">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço" required="required" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required="required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" required="required" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" required="required" />
                            </div>
                            <div class="col-sm-12 col-md-4 form-group">
                                <label for="pais">Pais</label>
                                <input type="text" class="form-control" name="pais" id="pais" placeholder="Pais" required="required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="texto">Observação</label>
                                <textarea class="form-control" name="texto" id="texto" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-md-offset-10 form-group">
                                <button type="submit" class="btn btn-success">Finalizar</button>
                                <button type="reset" class="btn btn-default">Limpar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/jquery-2.0.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.maskedinput.min.js"></script>
    <script src="custom/js/ie10-viewport-bug-workaround.js"></script>
    <script>
        $('.update').click(function () {
            var id = $(this).attr('valor');
            var qtd = $('#qtd' + id).val();
            if (qtd == 0) {
                alert('Quantidade não pode ser 0(zero).');
            } else {
                var url = 'carrinho.php?u=1&i=' + id + '&q=' + qtd;
                $(location).attr('href', url);
            }
        });

        $(document).ready(function () {
            $('input[type=tel]').mask("(99) 9999-9999?9").ready(function (event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });
        });
    </script>
</body>
</html>
