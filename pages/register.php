<?php

session_start();

if (isset($_SESSION["name"])) {
    header("Location: ../pages/home.php");
} else {

	require_once('../includes/functions.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm-password'];
		if ($password !== $confirm_password) {
			$error = "Senhas não coincidem. Tente novamente.";
		} else {
			$error = register($name, $email, $password);
		}
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
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
	<title>Recikla Maricá - Cadastro</title>
</head>

<body>
	<div class="container">
	<div class="d-flex align-items-center justify-content-center h-100">
            <div class="col-md-6">
                <div class="text-center">
                    <img src="../assets/imgs/logo_recikla_marica.jpg" alt="Logo ReciKla Maricá" class="img-fluid logo-img">
				</div>
				<h2 class="text-center mb-4">Cadastre-se</h2>

                <form method="POST" class="row g-3">
					<div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-12">
                        <label for="confirm-password" class="form-label">Confirme a senha</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                    </div>
                    <div class="col-12 <?php echo isset($error) && !empty($error) ? 'd-block' : 'd-none'; ?>">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="col-12">
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-success">Registrar</button>
							<a href="../index.html" class="btn btn-primary">Voltar</a>
						</div>
                    </div>
                </form>
			</div>
		</div>
	</div>
	<br>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>