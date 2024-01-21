<?php
require_once __DIR__ . '/src/session.php';
require_once __DIR__ . '/src/validator.php';

checkGuest();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="assets/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>

<form class="card" action="src/actions/login.php" method="post">
    <h2>Вход</h2>

    <?php if(hasMessage('error')): ?>
        <div class="notice error"><?php echo getMessage('error') ?></div>
    <?php endif; ?>

    <label for="login">
        Телефон или Email
        <input
            type="text"
            id="login"
            name="login"
            placeholder="ivanivanov@ya.ru"
            value="<?php echo old('login') ?>"
            <?php echo validationErrorAttr('login'); ?>
        >
        <?php if(hasValidationError('login')): ?>
            <small><?php echo validationErrorMessage('login'); ?></small>
        <?php endif; ?>
    </label>

    <label for="password">
        Пароль
        <input
            type="password"
            id="password"
            name="password"
            placeholder="******"
        >
    </label>

    <div
            id="captcha-container"
            class="smart-captcha"
            data-sitekey="<ключ_клиента>"
    ></div>

    <button
        type="submit"
        id="submit"
    >Продолжить</button>
</form>

<p>У меня еще нет <a href="/register.php">аккаунта</a></p>

<script>
    function onloadFunction() {
        if (window.smartCaptcha) {
            const container = document.getElementById('captcha-container');

            const widgetId = window.smartCaptcha.render(container, {
                sitekey: '<ключ_клиента>',
                hl: 'en',
            });
        }
    }
</script>
</body>
</html>
