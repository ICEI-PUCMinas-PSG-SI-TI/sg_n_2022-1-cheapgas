<?php // CLASSES A PRIMEIRA LETRA É MAISCULA
//IMPOTAR ARQUIVOS
// INCLUDE - importar um arquivo dar mensagem de erro e continuar a execução. (Utilizado para incluir conteudos html)
// REQUIRE - importar um arquivo dar mensagem de erro e parar a execução.(utilizado toda vez que tratarmos de classes)
// require_once // include_once -> once vai importar o arquivo uma unica vez.
require_once "Conexao.php";
class Usuarios
{
    // ATRIBUTOS
    public $CODIGO;
    public $NOME;
    public $SEXO;
    public $EMAIL;
    public $ENDERECO;
    public $TELEFONE;
    public $SENHA;

    //METODOS (SELECT / UPDADTE INSERT DELETE)
    // METODO PARA LISTAR TODOS ALUNOS (select * from alunos)

    public function inserir()
    {
        try {


            $this->EMAIL = $_POST["email"];
            $this->SENHA = $_POST["senha"];

            $bd = new Conexao();

            // criar a variavel para receber a conexao
            $con = $bd->conectar();

            //criar o comando para o sql ser executado no banco de dados
            $sql = $con->prepare("select * from usuarios where email = ? ");

            $sql->execute(array($this->EMAIL));
            $result=$sql->fetchObject();
            //$sql->debugDumpParams(); die();
            //testar se o comando deu certo
            if($sql->rowCount() < 1){ // abrir o if
            // var_dump($_POST);die();
            //TESTAR SE RECEBEU OS DADOS DO FORMULARIO
                if (isset($_POST["nome"]) && isset($_POST["sexo"])) {
                    // PREENCHER OS ATRIBUTOS COM DADOS DO FORM
                    $this->nome = $_POST["nome"];
                    $this->sexo = $_POST["sexo"];
                    $this->email = $_POST["email"];
                    $this->endereco = $_POST["endereco"];
                    $this->telefone = $_POST["telefone"];
                    $this->senha = $_POST["senha"];
                    //CRIAR UMA INSTANCIA DA CLASSE DE CONEXÃO
                    $bd = new Conexao();
                    //criar variavel para receber conexão
                    $con = $bd->conectar();
                    //Comnado sql para inseir aluinos
                    $sql = $con->prepare("insert into usuarios(codigo,nome,sexo,email,endereco,telefone,senha)
                                                    values(null,?,?,?,?,?,?);");
                    //EXECUTAR O COMANDO NO BANCO DE DADOS
                    $sql->execute(array(
                        $this->nome,
                        $this->sexo,
                        $this->email,
                        $this->endereco,
                        $this->telefone,
                        $this->senha
                    ));
                    //testar se o comando deu certo -> 0 isert deu errado / 1 ou mais insert deu certo
                    if ($sql->rowCount() > 0) {
                        //redirecionar usuario para tela de index
                        header("location: login.php");
                    }
                } else { // DEVOLVER O USUARIO PARA A TELA DE CADASTRO
                    header("location: registrar.php");                
                }
            }else{
                header("location:registrar.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel. {$msg->getMessage()}";
        }
    }






    public function login()   {// abrir login 

        try{//abrir o try 
            // testar se recebeu o email e a senha 
            if(isset($_POST["email"]) && isset($_POST["senha"])){// abrir o if 
                //preencher os atributos com os valores recebidos da tela 
                $this->EMAIL = $_POST["email"];
                $this->SENHA = $_POST["senha"];

                // criar a instancia da classer conexao 
                $bd = new Conexao();

                // criar a variavel para receber a conexao 
                $con = $bd->conectar();

                //criar o comando para o sql ser executado no banco de dados 
                $sql = $con->prepare("select * from usuarios where email = ? and senha = ?");

                // executar o comando no banco de dados 
                $sql->execute(array($this->EMAIL, $this->SENHA));
               //$sql->debugDumpParams(); die();
                //testar se o comando deu certo

                if($sql->rowCount() > 0){ // abrir o if 
                     $_SESSION["usuario"]= $sql->fetchObject();
                    // login funcionou corretamente, usuario entra no sistema
                    header("location: home_sistema.php");

                }// fechar o if 

                else {// abrir o else 
                    // email ou senha incorretos 
                    header("location: login.php");
                }// fechar o else 


            }// fechar o if
                else {// abrir o else 
                    // nao recebeu nenhum, voltar para o index
                 header("location: login.php");
                }// fechar o else 
       }// fechar o try 
       catch (PDOException $msg){
            echo "Não foi possivel fazer o login. {$msg->getMessage()}";
        }
       

    }// fechar login


    public function ListarLancamentos(){
        try{
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("SELECT c.TIPO, SUM(l.VALOR) AS VALOR FROM lancamento l INNER JOIN contas c ON l.CONTAS_CODIGO = c.CODIGO WHERE c.USUARIOS_CODIGO = ? GROUP BY c.TIPO;");
            $sql->execute(array($_SESSION["usuario"]->CODIGO));
            return $sql->fetchAll(PDO::FETCH_CLASS);
        }catch (PDOException $msg){
            echo "Não foi possível listar. {$msg->getMessage()}";
        }
    }

















    public function excluir($codigo)
    {

        try {
            //VERIFICAR SE RECEBEU A MATRICULA
            if (isset($codigo)) {
                // PREENCHER O ATRIBUTO COM O VALOR ENVIADO PELO FORMULARIO

                $this->CODIGO = $codigo;
                //INSTANCIAR A CLASSE CONEXÃO
                $bd = new Conexao();
                //CRIAR O OBJETO CONTENTO A CONEXÃO
                $con = $bd->conectar();
                //CRIAR O COMANDO SQL PARA ENVIAR AO BANCO
                $sql = $con->prepare("delete from usuarios where codigo = ?");
                //EXECUTAR O COMANDO PASSANDO PASSANDO O PARAMETRO MATRICULA
                $sql->execute(array($this->CODIGO));
                //TESTAR SE RETORNOU OS VALORES
                //die("1");
                if ($sql->rowCount() > 0) {

                    header("location:home_sistema.php");

                }

            } else {// SE NÃO TEM MATRUICULA DEVOLVER PARA INDEX_ALUNOS
                header("location:index.html");
            }
        } catch (PDOException $msg) {
            echo " Não foi possivel excluir o aluno:" . $msg->getMessage();
        }}


        public function listarTodos()
    {
        try {
            // CRIAR UMA INSTANCIA DA CLASSE DE CONEXÃO
            $bd = new Conexao();
            // CRIAR UMA VARIAVEL PARA RECEBER A CONEXÃO
            $con = $bd->conectar();
            //CRIAR O COMNADO SQL QUE SERÁ EXECUTADO NO SERVIDOR
            $sql = $con->prepare("select * from usuarios");
            //EXECUTAR O COMANDO SQL
            $sql->execute();
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
public function listarCad($codigo){
    try{
        if(isset($codigo)){
            $this->CODIGO = $codigo;
            //instanciar classe conexão
            $bd = new Conexao();
            // Criar o objeto contento a conexao
            $con = $bd->conectar();
            // Cria o comando sql para enviar ao banco
            $sql = $con->prepare("select * from usuarios where codigo = ?");
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
        echo "Não foi possivel Listar: ".$msg->getMessage();
    }
}


}

