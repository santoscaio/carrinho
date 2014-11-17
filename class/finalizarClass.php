<?php

/**
 * Classe de gestão de dados relacionado a pedido
 */
class Finalizar {

    function insertPessoa($dados) {
        $query = "INSERT INTO
                    pessoa
                    (nome, email, telefone, endereco, bairro, cidade, estado, pais, observacao)
                VALUES
                    ('" . $dados['nome'] . "', '" . $dados['email'] . "', '" . $dados['telefone'] . "',
                    '" . $dados['endereco'] . "', '" . $dados['bairro'] . "', '" . $dados['cidade'] . "',
                    '" . $dados['estado'] . "', '" . $dados['pais'] . "', '" . $dados['texto'] . "')";
        return $query;
    }

    function insertPedido($idPessoa) {
        $data = date('Y-m-d H:i:s');
        $query = "INSERT INTO
                    pedido
                    (id_pessoa, data)
                VALUES
                    ('" . $idPessoa . "', '" . $data . "')";
        return $query;
    }

    function insertPedidoItem($idPedido, $idProduto, $qtd) {
        $data = date('Y-m-d H:i:s');
        $query = "INSERT INTO
                    pedido_item
                    (id_pedido, id_produto, quantidade)
                VALUES
                    ('" . $idPedido . "', '" . $idProduto . "', '" . $qtd . "')";
        return $query;
    }

}
