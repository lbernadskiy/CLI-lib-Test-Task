<?php

require_once __DIR__.'/vendor/autoload.php';

/*
 * Инициализируем и запускаем приложение.
 * Регистрация произвольных команд происходит в методе registerCommands
 * с использование методов CLI-библиотеки.
 * Здесь просто точка входа.
 */
$app = new AppData\Application();
$app->run();
