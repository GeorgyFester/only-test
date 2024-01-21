<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../session.php';

$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($login)) {
    setOldValue('login', $login);
    setValidationError('login', 'Неверный логин');
    setMessage('error', 'Ошибка валидации');
    header("Location: /");
    die();
}

$user = findUser($login);

if (!$user) {
    setMessage('error', "Пользователь $login не найден");
    header("Location: /");
    die();
}

if (!password_verify($password, $user['password'])) {
    setMessage('error', 'Неверный пароль');
    header("Location: /");
    die();
}

$_SESSION['user']['id'] = $user['id'];

setOldValue('name', $user['name']);
setOldValue('email', $user['email']);
setOldValue('phone', $user['phone']);

header("Location: /profile.php");
die();