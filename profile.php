<?php
require_once __DIR__ . '/src/session.php';
require_once __DIR__ . '/src/db.php';
require_once __DIR__ . '/src/validator.php';

checkAuth();

$user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="assets/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>

<h1><?php echo $user['name'] ?></h1>

<form class="card" action="src/actions/update.php" method="post" enctype="multipart/form-data">
    <h4>Изменить данные</h4>

    <label for="name">
        Имя
        <input
            type="text"
            id="name"
            name="name"
            value="<?php echo old('name') ?>"
            <?php echo validationErrorAttr('name'); ?>
        >
        <?php if(hasValidationError('name')): ?>
            <small><?php echo validationErrorMessage('name'); ?></small>
        <?php endif; ?>
    </label>

    <label for="email">
        E-mail
        <input
            type="text"
            id="email"
            name="email"
            value="<?php echo old('email') ?>"
            <?php echo validationErrorAttr('email'); ?>
        >
        <?php if(hasValidationError('email')): ?>
            <small><?php echo validationErrorMessage('email'); ?></small>
        <?php endif; ?>
    </label>

    <label for="phone">
        Телефон
        <input
            type="text"
            id="phone"
            name="phone"
            value="<?php echo old('phone') ?>"
            <?php echo validationErrorAttr('phone'); ?>
        >
        <?php if(hasValidationError('phone')): ?>
            <small><?php echo validationErrorMessage('phone'); ?></small>
        <?php endif; ?>
    </label>

    <label for="password">
        Пароль
        <input
            type="password"
            id="password"
            name="password"
            placeholder="******"
            <?php echo validationErrorAttr('password'); ?>
        >
        <?php if(hasValidationError('password')): ?>
            <small><?php echo validationErrorMessage('password'); ?></small>
        <?php endif; ?>
    </label>

    <button
        type="submit"
        id="submit"
    >Изменить</button>
</form>

<form action="src/actions/logout.php" method="post">
    <button role="button">Выйти из аккаунта</button>
</form>
</body>
</html>
