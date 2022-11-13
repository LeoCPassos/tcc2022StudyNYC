<head>
    <!-- include summernote css/js -->
    <title>NYC - Conteúdo</title>
    <link href="css/conteudos.css" rel="stylesheet">
</head>
<?php

include_once 'php/banco.php';

// // Faz o select retornando apenas o usuario que tiver o login e a senha iguais aos inseridos
// $cmd = 'SELECT * FROM  tb04_conteudos';
// // Executa o comando
// $stmt = $banco->prepare($cmd);
// $stmt->execute();
// // Coloca os valores retornados pelo banco na variavel "posts"
// $posts = $stmt->fetchAll();

$sql = 'SELECT * FROM tb06_disciplinas';
$p = $banco->prepare($sql);
$p->execute([]);
$materias = $p->fetchAll();

// print_r($materias);

?>

<body>
    <div class="container">
        <div class="col">
            <?php
            foreach ($materias as $materia) {
                echo '<div style="transform: translateY(-80px);" id="' . $materia["tb06_nome_disciplina"] . '"></div>';
                echo '<div class="row">';
                echo '<h2>' . $materia["tb06_nome_disciplina"] . ':</h2>';
                echo '</div>';

                $sql = 'SELECT * 
                FROM tb04_conteudos 
                INNER JOIN tb07_series
                ON tb04_serie = tb07_id_serie
                WHERE tb04_materia = ? 
                ORDER BY tb04_Id_Conteudo DESC';
                $p = $banco->prepare($sql);
                $p->execute([$materia['tb06_id_disciplina']]);
                $posts = $p->fetchAll();

                echo '<div class="lista row" style="height: 600px;">';
                
                if ($posts != array()) {
                    foreach ($posts as $post) {
                        echo '<div style="transform: translateY(-160px);" id="' . $post['tb04_Id_Conteudo'] . '"></div>';
                        echo '<a class="item" href="?page=conteudo&post=' . $post['tb04_Id_Conteudo'] . '" alt="' . $post['tb04_serie'] . '">';
                        echo '<div class="post">';
                        echo '<img src="https://picsum.photos/200/">';
                        echo '<label class="text-truncate">' . $post["tb04_titulo"] . '</label>';
                        echo '<label style="float: right; color: var(--text-color);">' . $post["tb07_nome_serie"] . '</label>';
                        echo '</div>';
                        echo '</a>';
                    }
                }
                else{
                    echo '<div class="col-12" style="margin-top: 60px;">';
                    echo '<h2 style="text-align: center;">Está vazio...</h2>';
                    echo '</div>';
                }
                echo '</div>';
            }

            ?>

        </div>
    </div>

</body>