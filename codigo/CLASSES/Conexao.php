<?php session_start();

// Classe é uma estrutura de um objeto contendo atributos e metodos
// Atributos são caracteristicas que descrevem as Classes (Campos da Tabela)
// Metodos são as ações das Classes (Inserir, deletar, atualizar e selecionar na tabela) CRUD
class Conexao
{
// ATRIBUTOS PARA CRIAR UMA CONEXÃO SÃO (SERVIDOR ; BANCO DE DADOS ; USUARIO ; SENHA)
// VISIBILIDADE public ; private
    private $servidor;
    private $banco;
    private $usuario;
    private $senha;

// METODOS REPRESENTADO POR FUNCTION
    function __construct() { // EXECUTADA TODA VEZ QUE INSTACIAMOS A CLASSE
        $this->servidor = "localhost"; // this faz referencia a classe
        $this->banco = "enviar";
        $this->usuario = "root";
        $this->senha = "";
    }
    // METODO PARA CRIAR UAM CONEXÃO AO MYSQL COM PDO
    // METODO PUBLIC VAI SER VISIVEL FORA DA CLASSE
    public function conectar()
    {
        try { // Tenta executar esse bloco}
            // Criar a conexão com msql utilizando o PDO -> new-> Cria uma instancia da classe
            $con = new PDO("mysql:host={$this->servidor};dbname={$this->banco};charset=utf8;", $this->usuario, $this->senha);
            return $con;

        } catch (PDOException $msg) {// se der erro retorna msq
            echo "Não foi possivel conectar ao Banco de Dados {$msg->getMessage()}";
        }
    }

}