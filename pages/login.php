<?php

session_start();

if (isset($_SESSION["name"])) {
    header("Location: ../pages/home.php");
} else {
    require_once('../includes/functions.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo 'POST request received<br>';
        // echo '$email = ' . $_POST['email'] . '<br>';
        // echo '$password = ' . $_POST['password'] . '<br>';
        // exit;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error = check_account($email, $password);
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
    <title>Recikla Maricá</title>
</head>

<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="col-md-6">
                <div class="text-center">
                    <img src="../assets/imgs/logo_recikla_marica.jpg" alt="Logo ReciKla Maricá" class="img-fluid logo-img">
                </div>
                <h2 class="text-center mb-4">Entrar</h2>
                <form method="POST" class="row g-3">
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-12 <?php echo isset($error) && !empty($error) ? 'd-block' : 'd-none'; ?>">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="col-12">
						<div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Login</button>
                            <a href="../pages/register.php" class="btn btn-primary">Cadastre-se</a>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>