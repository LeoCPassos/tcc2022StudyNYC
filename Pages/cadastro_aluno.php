<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet">
    <title>NYC - Cadastro</title>
</head>

<body style="text-align: center;">
    <div class="container">
        <div>
            <div class="row">
                <h1>
                    <img src="img/NYC_Logo.jpg">
                </h1>
            </div>

            <div class="row">
                <b>
                    <p>
                        Seja bem vindo ao aplicativo que tudo que você procura você acha!
                        <br>
                        Conteúdos de muita qualidade para melhor aproveitamento dos estudos.
                    </p>
                </b>
            </div>

            <form method="post" action="php/cadastrar_aluno.php">
                <div class="row">
                    <div class="col">
                        <label style="width: 50px; text-align: center;">Nome:</label>
                        <input class="input-text onlyLetterNumbers" type="text" id="txtNome" name="nome" placeholder="Digite seu nome." required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label style="width: 50px; text-align: center;">Login:</label>
                        <input class="input-text noSChar" id="txtLogin" name="login" placeholder="Digite seu login aqui." required>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col">
                        <label style="width: 50px; text-align: center;">Senha:</label>
                        <input class="input-text" type="password" id="txtSenha" name="senha" placeholder="Digite sua senha aqui." required>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col">
                        <label style="width: 50px; text-align: center;"></label>
                        <input class="input-text" type="password" id="txtCSenha" name="confirmsenha" placeholder="Confirme sua senha aqui." required>
                    </div>
                </div><br>


                <div class="row">
                    <div class="col-md-3 col-sm-1"></div>

                    <div class="col-md-3 col-sm-5">
                        <input type="submit" value="Cadastrar"></input>
                    </div>

                    <div class="col-md-3 col-sm-5">
                        <a href="?"><button type="button">Voltar</button></a>
                    </div>

                    <div class="col-md-3 col-sm-1"></div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-1 col-md-4">
                    </div>
                    <div class="col-sm-10 col-md-4">
                        <?php
                        session_start();
                        if (isset($_SESSION['cadastroSucesso'])) {
                            echo '<div class="successBox">';
                            echo '<p>Conta cadastrada com sucesso.</p>';
                            echo '</div>';

                            unset($_SESSION['cadastroSucesso']);
                        }
                        if (isset($_SESSION['cadastroErro'])) {
                            echo '<div class="errorBox">';
                            echo '<p>Esse login já foi cadastrado.</p>';
                            echo '</div>';

                            unset($_SESSION['cadastroErro']);
                        }

                        if (isset($_SESSION['senhaErro'])) {
                            echo '<div class="errorBox">';
                            echo '<p>As senhas não batem.</p>';
                            echo '</div>';

                            unset($_SESSION['senhaErro']);
                        }

                        ?>
                    </div>
                    <div class="col-sm-1 col-md-4">
                    </div>
                </div>
            </form>

        </div>
</body>

</html>