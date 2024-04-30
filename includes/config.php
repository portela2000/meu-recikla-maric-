<?php
    // Define a opção de banco de dados (mysql ou postgres)
    $databaseOption = 'mysql';

    // Define as informações de conexão com o banco de dados
    if ($databaseOption === 'mysql') {
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'recikla');

        // Conecta com o banco de dados MySQL
        $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verifica se houve erro na conexão
        if (!$db) {
            die("Erro ao conectar com o banco de dados MySQL: " . mysqli_connect_error());
        }
    } elseif ($databaseOption === 'postgresql') {
        define('DB_HOST', 'localhost');
        define('DB_PORT', '5432');
        define('DB_USER', 'postgres');
        define('DB_PASS', '123');
        define('DB_NAME', 'recikla');

        // Conecta com o banco de dados PostgreSQL
        $db = pg_connect("host=" . DB_HOST . " port=" . DB_PORT . " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);

        // Verifica se houve erro na conexão
        if (!$db) {
            die("Erro ao conectar com o banco de dados PostgreSQL: " . pg_last_error());
        }
    } else {
        die("Opção de banco de dados inválida.");
    }
