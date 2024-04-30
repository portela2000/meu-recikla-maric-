<?php

require_once('../includes/functions.php');
check_login();
include_once('../includes/config.php');

$id_user = $_SESSION['id'];

// Recupera os dados do perfil do usuário do banco de dados
$sql = "SELECT * FROM users WHERE id='$id_user'";


$id_user = $_SESSION["id"];
require_once(dirname(__DIR__) . '/includes/config.php');

if ($databaseOption == 'mysql') {
    $result = mysqli_query($db, $sql);
    $usuario = mysqli_fetch_assoc($result);
} else if ($databaseOption == 'postgresql') {
    $result = pg_query($db, $sql);
    $usuario = pg_fetch_assoc($result);
}

$user_name = $usuario['name'];
$user_email = $usuario['email'];

if (!empty($usuario['img_profile'])) {
    // Se não estiver vazio, exibe a imagem do usuário usando o caminho fornecido
    $image = $usuario['img_profile'];
} else {
    // Se estiver vazio, exibe uma imagem padrão
    $image = "https://th.bing.com/th/id/OIP.1yoSL-WO0YU5mQKROudvswHaHa?pid=ImgDet&rs=1";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <title>Recikla Maricá</title>
</head>

<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="col-md-6">
                <br>
                <div class="text-center">
                    <img src="../assets/imgs/logo_recikla_marica.jpg" alt="Logo ReciKla Maricá" class="img-fluid logo-img">
				</div>
                <div class="text-center">
                    <h3>Bem-vindo(a) à página inicial, </strong> <?= $user_name; ?>!</h3>
                    <img src="<?php echo $image ?>" alt="Imagem de Perfil" class="profile-image">
                </div><br>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">Blog</a>
                            <a href="./profile_edit.php" class="btn btn-primary">Editar Perfil</a>
                            <!-- <a href="#" class="btn btn-primary">Solicitar Coleta</a>
                            <a href="#" class="btn btn-primary">Lista de Coletas</a> -->
                            <a href="../includes/logout.php" class="btn btn-primary">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>