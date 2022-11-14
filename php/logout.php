<?php
// Inicia uma sessão
session_start();

// Limpa a sessão
session_destroy();
// Redireciona para o index
header('Location: ../');
?>