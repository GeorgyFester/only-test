<?php

require_once __DIR__ . '/../validator.php';
require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../db.php';

$name = $_POST['name'] ?? null;
$phone = $_POST['phone'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($name)) {
    setValidationError('name', 'Неверное имя');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setValidationError('email', 'Неверный формат');
}

if (empty($password)) {
    setValidationError('password', 'Пароль пустой');
}

if (!empty($_SESSION['validation'])) {
    setOldValue('name', $name);
    setOldValue('email', $email);
    setOldValue('phone', $phone);
    header("Location: /profile.php");
    die();
}

$pdo = getPDO();

$userId = $_SESSION['user']['id'];
$query = "UPDATE users SET name = :name, phone =  :phone, email = :email, password = :password WHERE id = $userId";

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
