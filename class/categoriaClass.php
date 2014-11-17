<?php
/**
 * Classe de gestão de dados relacionado a pedido
 */
class Categoria {

    function queryProdutos($categoria) {
        $query = "SELECT
                        p.id,
                        p.nome,
                        p.imagem,
                        p.preco,
                        p.descricao
                    FROM
                        produto_categoria AS pc
                    INNER JOIN
                        produto AS p ON p.id = pc.id_produto
                    WHERE
                        pc.id_categoria = " . $categoria . ";";
        return $query;
    }
}
