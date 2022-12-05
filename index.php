<!DOCTYPE html>
<html lang="pt-br">

<?php
session_start();

if (isset($_SESSION['logged']) && !isset($_GET['page'])) {
    header('Location: ?page=inicio');
}
?>

<head>
    <meta charset="utf-8" />
    <!-- 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        -->

    <!-- include libraries(jQuery, bootstrap) -->
    <!-- <link rel="stylesheet" href="bootstrap-4.6.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- <script src="bootstrap-4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <link rel="icon" type="image/x-icon" href="img/NYC_Logo.jpg">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="js/hamburger_menu.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <!-- <script type="text/javascript" src="js/navbar_selection.js"></script> -->

    <link href="css/style.css" rel="stylesheet">
    <!-- <title>NYC</title> -->

</head>

<body style="height: 100%;">

    <div id="content" style="margin-top: 80px;">
        <?php
        // Verifica se está logado ou não
        if (!$_SESSION["logged"]) { // Se não estiver ou mostra a tela de login ou a tela de cadastro
            if (isset($_GET['cadastro']))
                include_once("pages/cadastro_aluno.php");
            else if (isset($_GET['cadastroProfessor']))
                include_once("pages/cadastro_professor.php");
            else
                include_once("pages/login.php");
        } else { // Se estiver logado...
            // Faz a navegação das páginas
            switch ($_GET["page"]) {
                case 'inicio':
                    // Mostrar a tela de início
                    include_once("pages/inicio.php");
                    break;
                case 'perfil':
                    // Mostrar a tela de perfil
                    include_once("pages/perfil.php");
                    break;
                case 'conteudo':
                    // Mostrar a tela de conteúdos
                    if (!isset($_GET['post']))
                        include_once("pages/conteudo.php");
                    else
                        include_once("pages/conteudo_pagina.php");
                    break;
                case 'chat':
                    // Mostrar a tela de chat
                    include_once("pages/chat.php");
                    break;
                case 'upload':
                    // Mostrar a tela de upload dos conteúdos
                    include_once("pages/upload.php");
                    break;
                default:
                    // Caso não esteja em nenhuma das anteriores mostra o erro 404
                    include_once("pages/manutencao.html");
            }
            // Mostra a topnav
            include_once("pages/topnav.php");
        }
        ?>

    </div>
    
    <script type="text/javascript" src="js/input_filters.js"></script>
</body>

</html>