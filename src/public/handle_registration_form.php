<?php

print_r($_GET);

$name = $_GET['name'];
$email = $_GET['email'];
$password = $_GET['psw'];
$passwordRepeat = $_GET['psw-repeat'];

$pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

$pdo->exec("INSERT INTO users (name, email, password, passwordRepeat) VALUES ('name', 'email', 'psw', 'psw-repeat')");
