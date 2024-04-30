<?php

require_once('../includes/functions.php');
check_login();

require_once('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se um arquivo de imagem foi enviado
    if ($_FILES["image"]["name"]) {
        $caminhoImagem = "../perfil/imagens/" . basename($_FILES["image"]["name"]);
        $extensaoImagem = strtolower(pathinfo($caminhoImagem, PATHINFO_EXTENSION));

        // Verifica se o arquivo é uma imagem
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "O arquivo enviado não é uma imagem válida.";
            exit();
        }

        // Move o arquivo para o diretório de imagens do perfil
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $caminhoImagem)) {
            echo "Ocorreu um erro ao fazer o upload da imagem. Tente novamente.";
            exit();
        }

        // Atualiza o caminho da imagem no banco de dados
        $id = $_SESSION['id'];
        $sql = "UPDATE users SET img_profile='$caminhoImagem' WHERE id=$id";
        if (mysqli_query($db, $sql)) {
            header("Location: ../perfil/home.php");
            exit();
        } else {
            echo "Erro ao atualizar perfil: " . mysqli_error($db);
        }
    } else {
        echo "Nenhum arquivo de imagem enviado.";
    }
}
?>