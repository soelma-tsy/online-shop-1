<?php

if (empty($_GET)) {
    exit("Пожалуйста, заполните форму регистрации.");
}

$name = $_GET['name'];
$email = $_GET['email'];
$password = $_GET['psw'];
$passwordRep = $_GET['psw_repeat'];

$errors = [];

if (strlen($name) < 2) {
    $errors[] = 'Имя должно содержать более 2 символов' . "<br>";
}

if (strlen($email) < 3) {
    $errors[] = 'Email должен содержать более 3 символов' . "<br>";
}

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Email введен некорректно, пожалуйста, проверьте правильность ввода' . "<br>";
}

if (strlen($password) < 6) {
    $errors[] = 'Пароль должен содержать более 6 символов' . "<br>";
}

if ($password != $passwordRep) {
    $errors[] = 'Пароли не совпадают, повторите попытку' . "<br>";
}

if (empty($name) || empty($email) || empty($password)) {
    $errors[] = 'Все поля должны быть заполнены!' . "<br>";
}

if (empty($errors)) {
    $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT)
    ]);



    echo "<h2>Регистрация прошла успешно! Добро пожаловать, $name!</h2>";
    echo "Ваше имя: " . $name . "<br>";
    echo "Ваш email: " . $email;
} else {
    echo "Ошибка! Проверьте правильность введенных вами данных и повторите попытку";
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}


