<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/animations.css" rel="stylesheet">
    <title>NYC - Login</title>

    <style>
        .vl {
            border-left: 6px solid white;
            height: 200px;
            position: absolute;
            left: 50%;
            margin-left: -3px;
            top: 0;
        }
    </style>

</head>

<body style="text-align: center;">
    <div class="container">
        <div>
            <div class="row justify-content-center">
                <div class="col" style="text-align: center;">
                    <img src="img/NYC_Logo.jpg" style="width: 200px;" >
                </div>
            </div>
            <div class="row align-items-center" style="text-align: center;">
                <div class="col-md-5 col-sm-12">
                    <form method="post" action="PHP\logar.php">
                        <div class="row">
                            <p>Faça login usando usa conta.</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="width: 60px; text-align: center;">Login:</label>
                                <input class="input-text noSChar" type="text" id="txtLogin" name="login" placeholder="Digite seu login." required>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label style="width: 60px; text-align: center;">Senha:</label>
                                <input class="input-text" type="password" id="txtSenha" name="senha" placeholder="Digite sua senha aqui." required>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <button type="submit">Entrar</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-1 col-md-2">
                            </div>
                            <div class="col-sm-10 col-md-8">
                                <?php
                                session_start();
                                // Checa se o servidor retornou a falha no login
                                if (isset($_SESSION['loginFalha'])) {
                                    // Mostra na tela o erro
                                    echo '<div class="errorBox">';
                                    echo '<p>Login ou senha incorretos.</p>';
                                    echo '</div>';
                                    unset($_SESSION['loginFalha']);
                                }
                                ?>
                            </div>
                            <div class="col-sm-1 col-md-2">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 col-sm-12">
                    <p style="text-align: center;">ou</p>
                </div>
                <div class="col-md-5 col-sm-12">
                    <p>Não tem uma conta?</p>
                    <a href="?cadastro"><button>Cadastre-se!</button></a>

                </div>
            </div>

        </div>
</body>

</html>