<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Cadastre-se</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="css/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="css/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="css/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/mainn.css">

</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(images/laura.png);">
					<span class="login100-form-title-1">
						Cadastre-se
					</span>
            </div>
                    <!-- Nome -->
                <form action="registrar.php" method="post" class="login100-formm validate-form" >
                    <div class="wrap-input100 validate-input m-b-26"  data-validate="Informe o seu nome">
                        <span class="label-input100">Nome</span>
                        <input class="input100" type="text"  id="nome" name="nome" placeholder="Maria">
                        <span class="focus-input100"></span>
                    </div>

                    <!-- Sexo -->
                    <div class="wrap-input100 validate-input m-b-26">
                        <span class="label-input100">Sexo</span>
                        <select name="sexo" id="sexo" class="form-control" required>
                            <option value=""> Escolha uma opção </option>
                            <option value="F"> Feminino </option>
                            <option value="M"> Masculino </option>
                            <option value="O"> Outro </option>
                            <option value="NA"> Prefiro não Declarar</option>
                        </select>
                    </div>

                    <!-- E-mail -->
                    <div class="wrap-input100 validate-input m-b-18"  data-validate="Informe o seu E-mail">
                        <span class="label-input100">E-mail</span>
                        <input class="input100" type="email"  id="email" name="email" placeholder="Ex: maria@teste.com" required>
                        <span class="focus-input100"></span>
                    </div>

                    <!-- Endereço --> 
                    <div class="wrap-input100 validate-input m-b-18" data-validate="Informe o seu Endereço">
                        <span class="label-input100">Endereço</span>
                        <input class="input100" type="text"  id="endereco" name="endereco" placeholder="Rua 12" required>
                        <span class="focus-input100"></span>
                    </div>

                    <!-- Telefone -->
                    <div class="wrap-input100 validate-input m-b-18" data-validate="Informe seu número de telefone">
                        <span class="label-input100">Telefone</span>
                        <input class="input100" type="tel"  id="telefone" name="telefone" placeholder="(33)33333-3333" oninput="mascara_telefone()" minlength="10" maxlength="14" size="2" required>
                        <span class="focus-input100"></span>
                    </div>


                    <!-- Senha -->

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Você precisa criar uma senha">
                        <span class="label-input100">Senha</span>
                        <input class="input100" type="password"  id="senha" name="senha" placeholder="******" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn text-center">
                        <button class="login100-form-btn" name="Salvar"> Salvar </button> 
                        
                        <a href="login.php" class="login100-form-btn">Voltar</a>
                    </div>

                </form>

        </div>
    </div>
</div>


<script src="css/jquery/jquery-3.2.1.min.js"></script>
<script src="css/animsition/js/animsition.min.js"></script>
<script src="css/bootstrap/js/popper.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
<script src="css/select2/select2.min.js"></script>
<script src="css/daterangepicker/moment.min.js"></script>
<script src="css/daterangepicker/daterangepicker.js"></script>
<script src="css/countdowntime/countdowntime.js"></script>
<script src="JS/main.js"></script>

</body>


<script>

    function mascara_telefone() {
        var tel_formatado = document.getElementById("telefone").value
        if(tel_formatado[0]!="(")
        {
            if(tel_formatado[0]!=undefined)
            {
                document.getElementById("telefone").value="("+tel_formatado[0]
            }
        }
        if (tel_formatado[3]!=")")
        {
            if (tel_formatado[3]!=undefined)
            {
                document.getElementById("telefone").value=tel_formatado.slice(0,3)+")"+tel_formatado[3]
            }
        }
        if (tel_formatado[9]!="-")
        {
            if (tel_formatado[9]!=undefined)
            {
                document.getElementById("telefone").value=tel_formatado.slice(0,9)+"-"+tel_formatado[9]
            }
        }
    }

</script>    

</html>
