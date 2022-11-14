<?php

include_once('php/banco.php');

$p = $banco->prepare('SELECT tb01_Id_Usuario as "id" FROM tb01_usuario');
$p->execute();
$usuarios = $p->fetchAll();

foreach ($usuarios as $remetente) {
    foreach ($usuarios as $destinatario) {
        if ($remetente['id'] != $destinatario['id']) {
            // echo $remetente['id'] . " " . $destinatario['id'] . '<br>';
            $sql = 'SELECT * FROM tb05_mensagem WHERE
                (tb05_remetente = ' . $remetente['id'] . ' AND tb05_destinatario = ' . $destinatario['id'] . ') OR
                (tb05_destinatario = ' . $remetente['id'] . ' AND tb05_remetente = ' . $destinatario['id'] . ')
                ORDER BY tb05_id_mensagem DESC LIMIT 1';

            $p = $banco->prepare($sql);
            $p->execute();
            $x = $p->fetchAll()[0];
            echo 'De:' . $remetente['id'];
            echo ' Para:' . $destinatario['id'] . " ";
            echo $x['tb05_mensagem'];
            echo '<br>';
        }
    }
}
