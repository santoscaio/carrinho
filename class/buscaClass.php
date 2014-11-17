<?php
/**
 * Classe de gestão de dados relacionado a pedido
 */
class Busca {

    function queryProdutos($busca) {
        $query = "SELECT
                        p.id,
                        p.nome,
                        p.imagem,
                        p.preco,
                        p.descricao
                    FROM
                        produto AS p
                    LEFT JOIN
                        produto_categoria AS pc ON p.id = pc.id_produto
                    INNER JOIN
                        categoria AS c ON c.id = pc.id_categoria
                    WHERE
                        LOWER(p.nome) LIKE '%" . $busca . "%'
                        OR LOWER(c.nome) LIKE '%" . $busca . "%'
                    GROUP BY
                        p.id
                    ORDER BY
                        p.nome ASC;";
        return $query;
    }
}
