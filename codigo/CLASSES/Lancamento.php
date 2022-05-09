<?php

require_once "Conexao.php";
class Lancamento
{
    public $CODIGO;
    public $VALOR;
    public $CONTAS_CODIGO;

    public function inserir()
    {
        try {
            // var_dump($_POST);die();
            //TESTAR SE RECEBEU OS DADOS DO FORMULARIO
            if (isset($_POST["valor"])) {
                // PREENCHER OS ATRIBUTOS COM DADOS DO FORM
                $this->VALOR = $_POST["valor"];
                $this->CONTAS_CODIGO = $_POST["conta"];

                //CRIAR UMA INSTANCIA DA CLASSE DE CONEXÃO
                $bd = new Conexao();
                //criar variavel para receber conexão
                $con = $bd->conectar();
                //Comnado sql para inseir categorias
                $sql = $con->prepare("insert into lancamento(valor, contas_codigo, usuarios_codigo)
                                                values(?,?, ?);");
                //EXECUTAR O COMANDO NO BANCO DE DADOS
                $sql->execute(array(
                    $this->VALOR,
                    $this->CONTAS_CODIGO,
                    $_SESSION["usuario"]->CODIGO
                ));
                // var_dump($sql->errorInfo());die();
                //testar se o comando deu certo -> 0 isert deu errado / 1 ou mais insert deu certo
                if ($sql->rowCount() > 0) {
                    //redirecionar usuario para tela de index
                    header("location: lancamento.php");
                }
            } else { // DEVOLVER O USUARIO PARA A TELA DE CADASTRO

                header("location: lancamento.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel. {$msg->getMessage()}";
        }
    }
    public function listarTodos()
    {
        try {
            // CRIAR UMA INSTANCIA DA CLASSE DE CONEXÃO
            $bd = new Conexao();
            // CRIAR UMA VARIAVEL PARA RECEBER A CONEXÃO
            $con = $bd->conectar();
            //CRIAR O COMNADO SQL QUE SERÁ EXECUTADO NO SERVIDOR
            $sql = $con->prepare("SELECT l.CODIGO, l.VALOR, c.NOME as CONTA, c.TIPO FROM LANCAMENTO l JOIN CONTAS c ON l.CONTAS_CODIGO = c.CODIGO; where usuarios_codigo = ?");
            //EXECUTAR O COMANDO SQL
            $sql->execute(array($_SESSION["usuario"]->CODIGO));
            //$sql->debugDumpParams(); die();
            // testar se retornou valores da tabela de alunos
            if ($sql->rowCount() > 0) {
                //retornar os dados para html
                return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                //FETCHALL -> TRAZ TODAS AS LINHAS // FETCH_CLASS -> RETORNA NO FORMATO CLASSE -> ATRIBUTOS
                // FETCH_CLASS retorna no formato classe-> ALUNOS->MATRICULA
                // FETCH_ASSOC RETORNA NO FORMATO ARRAY-> ALUNOS["MATRICULA"]
            }

        } catch (PDOException $msg) {
            echo "Não foi possivel listar os dados {$msg->getMessage()}";
        }
    }









    public function listarContas(){
        try {
            // CRIAR UMA INSTANCIA DA CLASSE DE CONEXÃO
            $bd = new Conexao();
            // CRIAR UMA VARIAVEL PARA RECEBER A CONEXÃO
            $con = $bd->conectar();
            //CRIAR O COMNADO SQL QUE SERÁ EXECUTADO NO SERVIDOR
            $sql = $con->prepare("select CODIGO, concat(nome, ' - ', tipo) as NOME from contas where usuarios_codigo = ?");
            //EXECUTAR O COMANDO SQL
            $sql->execute(array($_SESSION["usuario"]->CODIGO));
            //$sql->debugDumpParams(); die();
            // testar se retornou valores da tabela de alunos
            if ($sql->rowCount() > 0) {
                //retornar os dados para html
                return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                //FETCHALL -> TRAZ TODAS AS LINHAS // FETCH_CLASS -> RETORNA NO FORMATO CLASSE -> ATRIBUTOS
                // FETCH_CLASS retorna no formato classe-> ALUNOS->MATRICULA
                // FETCH_ASSOC RETORNA NO FORMATO ARRAY-> ALUNOS["MATRICULA"]
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel listar os dados {$msg->getMessage()}";
        }
    }

    public function excluir($codigo)
    {

        try {
            //VERIFICAR SE RECEBEU O CODIGO
            if (isset($codigo)) {
                // PREENCHER O ATRIBUTO COM O VALOR ENVIADO PELO FORMULARIO

                $this->CODIGO = $codigo;
                //INSTANCIAR A CLASSE CONEXÃO
                $bd = new Conexao();
                //CRIAR O OBJETO CONTENTO A CONEXÃO
                $con = $bd->conectar();
                //CRIAR O COMANDO SQL PARA ENVIAR AO BANCO
                $sql = $con->prepare("delete from lancamento where codigo = ?");
                //EXECUTAR O COMANDO PASSANDO PASSANDO O PARAMETRO MATRICULA
                $sql->execute(array($this->CODIGO));
                //TESTAR SE RETORNOU OS VALORES
                //die("1");
                if ($sql->rowCount() > 0) {
                    header("location: lancamento.php");
                }

            } else {// SE NÃO TEM MATRUICULA DEVOLVER PARA INDEX_ALUNOS
                header("location:index.html");
            }
        } catch (PDOException $msg) {
            echo " Não foi possivel excluir o aluno:" . $msg->getMessage();
        }}

    public function listarID($categoria){
        try{
            if(isset($categoria)){
                $this->CODIGO = $categoria;
                //instanciar classe conexão
                $bd = new Conexao();
                // Criar o objeto contento a conexao
                $con = $bd->conectar();
                // Cria o comando sql para enviar ao banco
                $sql = $con->prepare("select * from lancamento where codigo = ?");
                // Executar o comando
                $sql->execute(array($this->CODIGO));
                //TESTAR SE RETORNOU OS VALORES
                if ($sql->rowCount() > 0){
                    // Se tem resultado devolver os dados do aluno ao HTML
                    return $result = $sql->fetchObject();
                    //fetchAll -> linhas / colunas
                }
            }
        }catch(PDOException $msg){
            echo "Não foi possivel Listar o Aluno: ".$msg->getMessage();
        }
    }

    public function  alterar(){
        try{
            // verificar  se recebeu  valores do  formulario
            if(isset($_POST["Alterar"])) {

                $this->CODIGO=$_GET["lancamento"];
                $this->VALOR=$_POST["valor"];
                $this->CONTAS_CODIGO = $_POST["conta"];

                //  instanciar  classe conexao
                $bd = new Conexao();
                // criar o  objeto  contento  a conexao
                $con=$bd->conectar();
                // cria  o comando sql  para enviar  ao  banco  passando  parametros ?
                $sql= $con->prepare("update lancamento set valor = ?, contas_codigo = ? where codigo = ?");
                // executar  o comando  passando os  valores  recebidos  do formulario

                $sql->execute(array(
                    $this->VALOR,
                    $this->CONTAS_CODIGO,
                   $this->CODIGO
                ));
                // testar  se retornou valores
                if($sql->rowCount()>0){
                    //se conseguiu  alterar  no banco de dados retornar  para pagina  index_alunos.php
                    header("location:lancamento.php");
                }
            }else{
                //se  o usuario não preencheu  os valores  devolver para  o index_alunos.php
                header("location:index_alunos.php");

            }
        }catch (PDOException $msg){
            echo "Não foi possivel  alterar o aluno  ".$msg->getMessage();
        }



    }
















}