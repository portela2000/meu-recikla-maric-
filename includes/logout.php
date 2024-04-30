<?php

    session_start();

    // Limpa todas as variáveis de sessão
    session_unset();

    // Destrói a sessão atual
    session_destroy();

    header("Location: ../pages/login.php"); // redireciona para a página de login

?>