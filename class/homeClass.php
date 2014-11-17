<?php
/**
 * Classe de gestão de dados relacionado a pedido
 */
class Home {

    function queryProdutosHome() {
        $query = "SELECT
                        id,
                        nome,
                        imagem,
                        preco,
                        descricao
                    FROM
                        produto
                    ORDER BY
                        RAND()
                    LIMIT
                        12;";
        return $query;
    }
}
