<head>
    <!-- include summernote css/js -->
    <title>NYC - Conteúdo</title>
    <link href="css/conteudos.css" rel="stylesheet">
</head>
<?php

include_once 'php/banco.php';

// Seleciona as matérias do banco
$p = $banco->prepare('SELECT * FROM tb06_disciplinas');
$p->execute([]);
$materias = $p->fetchAll();
?>

<body>
    <div class="container">
        <div class="col">
            <?php
            // Mostra na tela os containers de todas as matérias cadastradas no banco
            foreach ($materias as $materia) {
                echo '<div style="transform: translateY(-80px);" id="' . $materia["tb06_nome_disciplina"] . '"></div>';
                echo '<div class="row">';
                echo '<h2>' . $materia["tb06_nome_disciplina"] . ':</h2>';
                echo '</div>';

                // Seleciona os conteudos da matéria desse container
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
                // Checa se há algum post nessa matéria
                if ($posts != array()) {
                    foreach ($posts as $post) {
                        // Se tiver algum post nessa matéria, mostra na tela todos os posts no container
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
                    // Se não tiver, mostra na tela uma mensagem dizendo que não há matérias
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