<head>
    <title>NYC - Início</title>
    <link rel="stylesheet" href="css/default.css">
</head>

<?php
include_once("php/banco.php");

// Seleciona todas as matérias
$sql = 'SELECT * FROM tb06_disciplinas';
$p = $banco->prepare($sql);
$p->execute([]);
$materias = $p->fetchAll();


?>


<div class="container" style="text-align: center;">
    <h1 style="text-align:center;">
        Início
    </h1>

    <div class="quemSomosBanner">
        <h1>Quem somos?</h1>
    </div>

    <div id="listaMateria" class="col-12" style="margin-top: 10px;">
        <div class="row justify-content-center">
            <?php
            foreach ($materias as $k) {
                // Mostra todas as matérias na tela principal
                echo '
                <a style="height: fit-content;" href="?page=conteudo#' . $k['tb06_nome_disciplina'] . '">
                    <div class="materia">
                        <img src="http://pudim.com.br/pudim.jpg">
                        <p>' . $k['tb06_nome_disciplina'] . '</p>
                    </div>
                </a>
                ';
            }
            ?>
        </div>
    </div>
</div>