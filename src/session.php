<?php

session_start();

function setOldValue(string $key, mixed $value): void
{
    $_SESSION['old'][$key] = $value;
}

function old(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

function hasMessage(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

function getMessage(string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function logout(): void
{
    unset($_SESSION['user']['id']);
    header("Location: /");
    die();
}

function checkAuth(): void
{
    if (!isset($_SESSION['user']['id'])) {
        header("Location: /");
        die();
    }
}

function checkGuest(): void
{
    if (isset($_SESSION['user']['id'])) {
        header("Location: /profile.php");
        die();
    }
}