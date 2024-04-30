<?php

require_once('../includes/functions.php');
check_login();
require_once('../includes/config.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha_atual = $_POST["senha_atual"];
    $nova_senha = $_POST["nova_senha"];
    $confirma_senha = $_POST["confirma_senha"];

    // Verifica se o ID do usuário foi passado
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];

        // Recupera os dados do perfil do usuário do banco de dados
        $sql = "SELECT password FROM users WHERE id='$id' LIMIT 1";
        $result = mysqli_query($db, $sql);
        $usuario = mysqli_fetch_assoc($result);
        // $result = pg_query($db, $sql);
        // $usuario = pg_fetch_all($result);

        if ($usuario) {
            // Verificar se a senha está correta
            if (password_verify($senha_atual, $usuario['password'])) {
                if ($nova_senha !== $confirma_senha) {
                    echo '<script>alert("As senhas não coincidem.");</script>';
                    header("Location: ../pages/home.php");
                    exit();
                } else {
                    // Criptografar a nova senha
                    $senhaCriptografada = password_hash($nova_senha, PASSWORD_DEFAULT);

                    // Atualizar a senha no banco de dados
                    $sql = "UPDATE users SET password='$senhaCriptografada' WHERE id='$id'";
                    $result = mysqli_query($db, $sql);

                    if ($result) {
                        echo '<script>alert("Senha alterada com sucesso.");</script>';
                        echo '<script>window.location.href = "../perfil/profile_edit.php?id=' . $id . '";</script>';
                        exit();
                    } else {
                        echo '<script>alert("Ocorreu um erro ao atualizar a senha.");</script>';
                        echo '<script>window.location.href = "../perfil/profile_edit.php?id=' . $id . '";</script>';
                        exit();
                    }
                }
            } else {
                echo '<script>alert("Senha atual incorreta.");</script>';
                echo '<script>window.location.href = "../perfil/profile_edit.php?id=' . $id . '";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Usuário não encontrado.");</script>';
            header("Location: ../perfil/home.php");
            exit();
        }
    } else {
        echo '<script>alert("ID do usuário não fornecido.");</script>';
        header("Location: ../perfil/home.php");
        exit();
    }
}
?>
