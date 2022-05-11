<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Login</title>
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
						LOGIN
					</span>
            </div>

                <form action="login.php" method="post" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">E-mail</span>
                        <input class="input100" type="email"  id="email" name="email" placeholder="email@email.com">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Senha</span>
                        <input class="input100" type="password"  id="senha" name="senha" placeholder="*******">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">

                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="Logar"> Login </button>
                        <a href="registrar.html" class="login100-form-btn">Registre-se</a>
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
<script src="cssa/daterangepicker/daterangepicker.js"></script>
<script src="cssjavinha/countdowntime/countdowntime.js"></script>
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
