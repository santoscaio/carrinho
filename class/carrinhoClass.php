<?php
/**
 * Classe de gestão de dados relacionado a pedido
 */
class Carrinho {

    function queryProduto($produto) {
        $query = "SELECT
                        nome,
                        preco
                    FROM
                        produto
                    WHERE
                        id = " . $produto . "
                    LIMIT 1;";
        return $query;
    }
}
