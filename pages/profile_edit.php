<?php

require_once('../includes/functions.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $error = profile_edit($name, $email, $id);
} else {

    $user_id = $_SESSION['id'];
    $user_name = $_SESSION['name'];
    $user_email = $_SESSION['email'];

    if (!empty($_SESSION['img_profile'])) {
        // Se não estiver vazio, exibe a imagem do usuário usando o caminho fornecido
        $image = $_SESSION['img_profile'];
    } else {
        // Se estiver vazio, exibe uma imagem padrão
        // $image = dirname(__DIR__) . '/assets/imgs/profile/default.jpeg';
        $image = '../assets/imgs/profile/default.jpeg';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome_5.15.3_css_all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <title>Recikla Maricá - Editar Perfil</title>
</head>
<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="col-md-6">
                <br>
                <h2 class="text-center mb-4">Editar Perfil</h2>
                <div class="profile-image-container">
                    <div class="profile-image-edit">
                        <img id="profile-img" src="<?= $image; ?>" alt="Imagem de Perfil">
                        <form action="../includes/image_save.php" method='POST' enctype="multipart/form-data">
                            <label for="image-upload" class="custom-upload-label">
                                <div class="upload-icon">
                                    <!-- <i class="fas fa-camera"><input type="file" id="image-upload" accept="image/*" name="image"><h5>Editar</h5></i> -->
                                    <input type="file" id="image-upload" accept="image/*" name="image"><h5><span type="button" class="btn btn-success btn-sm">Editar</span></h5>
                                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                </div>
                            </label>
                        </form>
                    </div>
                </div>

                <form method="POST" class="row g-3">
					<div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user_name; ?>" required>
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id_user; ?>" required>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  value="<?= $user_email; ?>"required>
                    </div>
                    <div class="col-12 <?php echo isset($error) && !empty($error) ? 'd-block' : 'd-none'; ?>">
                        <div class="alert alert-<?php if ($error == 'error') { echo 'danger'; } else { echo 'success'; }; ?> alert-dismissible fade show" role="alert">
                            <?php if ($error == 'success') { echo 'Dados alterados com sucesso'; } else { echo 'Erro ao editar o perfil. Tenta novamente.'; }; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="col-12">
						<div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Alterar Senha</button>
                            <a href="../pages/home.php" class="btn btn-primary">Voltar</a>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar Senha</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/password_edit.php?id=<?= $user_id; ?>" method="POST">
                        <div class="mb-3">
                            <label for="senha_atual">Senha Atual:</label>
                            <input type="password" id="senha_atual" name="senha_atual" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nova_senha">Nova Senha:</label>
                            <input type="password" id="nova_senha" name="nova_senha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirma_senha">Confirme a Nova Senha:</label>
                            <input type="password" id="confirma_senha" name="confirma_senha" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar Senha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Alteração de Senha -->
    <!-- <div class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="senhaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="senhaModalLabel">Alterar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../includes/password_edit.php?id=<?php //echo $_SESSION['id']; ?>" method="POST">
                        <div class="form-group">
                            <label for="senha_atual">Senha Atual:</label>
                            <input type="password" id="senha_atual" name="senha_atual" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha:</label>
                            <input type="password" id="nova_senha" name="nova_senha" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirma_senha">Confirme a Nova Senha:</label>
                            <input type="password" id="confirma_senha" name="confirma_senha" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mx-1 my-1" data-dismiss="modal" >Fechar</button>
                            
                            <button type="submit" class="btn btn-primary mx-1 my-1">Salvar Senha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
        
</body>

</html>

