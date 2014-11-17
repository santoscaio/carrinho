<?php
/**
 * Classe de gestão de dados relacionado a pedido
 */
class Menu {

    function queryMenu() {
        $query = "SELECT
                        id,
                        nome
                    FROM
                        categoria
                    ORDER BY
                        nome ASC;";
        return $query;
    }
}
