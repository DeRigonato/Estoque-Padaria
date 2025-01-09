<?php

class Conexao {
    private $host = 'localhost';
    private $dbname = 'padaria';
    private $user = 'root';
    private $pass = '';
    protected $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        } catch (PDOException $e) {
            die( 'Erro na conexão com o banco de dados' . $e->getMessage());
        }
    }

    public function getConexao() {
        return $this->conexao;
    }



}
?>