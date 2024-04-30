<?php

require_once('../includes/functions.php');
check_login();

require_once('../includes/config.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se um arquivo de imagem foi selecionado
    if (isset($_FILES["image-upload"]) && $_FILES["image-upload"]["error"] == 0) {
        // Configurações do banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "96204684";
        $database = "recikla";

        // Conecta ao banco de dados
        $conn = new mysqli($servername, $username, $password, $database);

        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Prepara a consulta SQL para inserir a imagem no banco de dados
        $stmt = $conn->prepare("INSERT INTO perfil (imagem) VALUES (?)");
        $stmt->bind_param("s", $imageData);

        // Lê o conteúdo do arquivo de imagem
        $imageData = base64_encode(file_get_contents($_FILES["image-upload"]["tmp_name"]));

        // Executa a consulta SQL
        if ($stmt->execute()) {
            echo "Imagem salva com sucesso no banco de dados.";
        } else {
            echo "Erro ao salvar a imagem no banco de dados.";
        }

        // Fecha a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    } else {
        echo "Nenhuma imagem selecionada.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome_5.15.3_css_all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <title>Edição de Perfil</title>
</head>
<body>
    <h1>Edição de Perfil</h1>
    <form method="POST" enctype="multipart/form-data" id="profile-form">
        <div class="profile-form">
            <div class="profile-image">
                <label for="image-upload" class="custom-upload-label">
                    <div class="upload-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <img id="profile-img" src="https://www.pngall.com/wp-content/uploads/5/Profile.png" alt="Imagem de Perfil">
                </label>
                <input type="file" id="image-upload" name="image-upload" accept="image/*">
            </div>
        </div>
    </form>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/scripts.js"></script>

    <script>
        document.getElementById("image-upload").addEventListener("change", function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById("profile-img");
                imgElement.src = reader.result;

                // Envio automático do formulário
                document.getElementById("profile-form").submit();
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
</body>
</html>
