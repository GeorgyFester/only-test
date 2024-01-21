<?php

require_once __DIR__ . '/../validator.php';
require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../db.php';

$name = $_POST['name'] ?? null;
$phone = $_POST['phone'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordConfirmation = $_POST['password_confirmation'] ?? null;

if (empty($name)) {
    setValidationError('name', 'Неверное имя');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setValidationError('email', 'Неверный формат');
}

if (empty($password)) {
    setValidationError('password', 'Пароль пустой');
}

if ($password !== $passwordConfirmation) {
    setValidationError('password', 'Пароли не совпадают');
}

if (findUser($email)) {
    setValidationError('email', "Пользователь с почтой $email уже существует");
}

if (findUser($phone)) {
    setValidationError('phone', "Пользователь с номером $phone уже существует");
}

if (!empty($_SESSION['validation'])) {
    setOldValue('name', $name);
    setOldValue('email', $email);
    setOldValue('phone', $phone);
    header("Location: /register.php");
    die();
}

$pdo = getPDO();

$query = "INSERT INTO users (name, phone, email, password) VALUES (:name, :phone, :email, :password)";

$params = [
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
} catch (\Exception $e) {
    die($e->getMessage());
}

header("Location: /");
die();
