<?php

/**
 * Classe de configuração e utilização de conexão com o Banco de Dados
 */
class Conexao {

    var $host = "localhost";
    var $user = "root";
    var $senha = "";
    var $dbase = "carrinho";
    var $query;
    var $link;
    var $resultado;

    /**
     * Instancia o Objeto para podermos usar
     */
    function MySQL() {
        
    }

    /**
     * Cria a função para efetuar conexão ao Banco MySQL (não é muito diferente da conexão padrão).
     * Veja que abaixo, além de criarmos a conexão, geramos condições personalizadas para mensagens de erro.
     */
    function conecta() {
        $this->link = @mysql_connect($this->host, $this->user, $this->senha);
        if (!$this->link) {
            return false;
        } elseif (!mysql_select_db($this->dbase, $this->link)) {
            return false;
        }
    }

    /**
     * Executa a "query" no Banco de Dados e retorna dados e erro
     * @param string $query
     * @param boolean $ins
     * @return string
     */
    function sql_query($query, $ins = false) {
        if (!$this->conecta()) {
            $dados['result'] = false;
            $dados['erro'] = 'Erro de retorno de dados.';
        }
        $this->query = $query;
        if ($this->resultado = mysql_query($this->query)) {
            $dados['result'] = $this->resultado;
            $dados['erro'] = false;
        } else {
            $dados['result'] = false;
            $dados['erro'] = 'Erro na consulta aos dados.';
        }
        if ($ins) {
            $dados['id'] = mysql_insert_id();
        }
        $this->desconecta();
        return $dados;
    }

    /**
     * Função para Desconectar do Banco MySQL
     */
    function desconecta() {
        return mysql_close($this->link);
    }

}
?>