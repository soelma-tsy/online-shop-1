<?php

$pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

$pdo->exec("INSERT INTO users (name, email, password) VALUES ('IVAN', 'ivan@mail.ru', 'qwerty123')");

$statement = $pdo->query("SELECT * FROM users");

$data = $statement->fetchALL();
echo "<pre>";

print_r($data);
echo "<pre>";



