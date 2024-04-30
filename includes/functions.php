<?php

function check_login() {
    session_start();
    if (!isset($_SESSION["name"])) {
        header("Location: ../pages/login.php");
    }
}

function check_account($email, $password) {

    require_once(__DIR__ . '/config.php');
    
    if ($databaseOption == 'mysql') {
        $email = mysqli_real_escape_string($db, $email);
        $password = mysqli_real_escape_string($db, $password);
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $sql);
        $usuario = mysqli_fetch_assoc($result);
    } else if ($databaseOption == 'postgresql') {
        $email = pg_escape_string($db, $email);
        $password = pg_escape_string($db, $password);
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = pg_query($db, $sql);
        $usuario = pg_fetch_all($result);
    }

    if ($usuario) {
        if (password_verify($password, $usuario['password'])) {
            session_start();

            $_SESSION["id"] = $usuario['id'];
            $_SESSION["name"] = $usuario['name'];
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["img_profile"] = $usuario["img_profile"];

            // foreach ($_SESSION as $key => $value) {
            //     echo $key . ' => ' . $value . '<br>';
            // }

            $databaseOption == 'mysql' ? mysqli_close($db) : pg_close($db);
            header("Location: ../pages/home.php");
        } else {
            $databaseOption == 'mysql' ? mysqli_close($db) : pg_close($db);
            return "Senha incorreta.";
        }
    } else {
        $databaseOption == 'mysql' ? mysqli_close($db) : pg_close($db);
        return "Usuário não cadastrado.";
    }
}

function register($name, $email, $password) {

    require_once(__DIR__ . '/config.php');

    if ($databaseOption == 'mysql') {
        $name = mysqli_real_escape_string($db, $name);
        $email = mysqli_real_escape_string($db, $email);
        $password = mysqli_real_escape_string($db, $password);
        $passwordCriptografada = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $sql);
        $usuario = mysqli_fetch_assoc($result);
    } else if ($databaseOption == 'postgresql') {
        $name = pg_escape_string($db, $name);
        $email = pg_escape_string($db, $email);
        $password = pg_escape_string($db, $password);
        $passwordCriptografada = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = pg_query($db, $sql);
        $usuario = pg_fetch_all($result);
    }

    if ($usuario) {
        $databaseOption == 'mysql' ? mysqli_close($db) : pg_close($db);
        return "Este e-mail já está cadastrado. Por favor, tente novamente com um e-mail diferente.";
    } else {
        $sql = "INSERT INTO users (name, email, password, status) VALUES ('$name', '$email', '$passwordCriptografada', true)";
        if ($databaseOption == 'mysql') {
            if (mysqli_query($db, $sql)) {
                mysqli_close($db);
                header("Location: ../pages/login.php");
            } else {
                mysqli_close($db);
                return "Erro ao inserir registro. Tenta novamente.";
            }
        } else if ($databaseOption == 'postgresql') {
            if (pg_query($db, $sql)) {
                pg_close($db);
                header("Location: ../pages/login.php");
            } else {
                pg_close($db);
                return "Erro ao inserir registro. Tenta novamente.";
            }
        }
    }
}

function get_imagem($imagem) {
    return $imagem;
}

function profile_edit($name, $email, $id) {

    require_once(__DIR__ . '/config.php');

    if ($databaseOption == 'mysql') {
        $id = mysqli_real_escape_string($db, $id);
        $name = mysqli_real_escape_string($db, $name);
        $email = mysqli_real_escape_string($db, $email);
        $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
        if (mysqli_query($db, $sql)) {
            mysqli_close($db);
            header("Location: ../pages/profile_edit.php");
        } else {
            mysqli_close($db);
            return "Erro ao editar o perfil. Tenta novamente.";
        }
    } else if ($databaseOption == 'postgresql') {
        $id = pg_escape_string($db, $id);
        $name = pg_escape_string($db, $name);
        $email = pg_escape_string($db, $email);
        $data = array('name' => $name, 'email' => $email);
        $condition = array('id' => $id);
        $res = pg_update($db, 'users', $data, $condition);
        if ($res) {
            echo '<script>alert("Dados alterados com sucesso!");</script>';
            header("Location: ../pages/home.php");
            pg_close($db);
        } else {
            return "erro";
            pg_close($db);
        }
    }
}

?>