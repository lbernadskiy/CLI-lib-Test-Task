<?php

namespace AppData;

use CliLib\ConsoleApp;

/**
 * Класс приложения которое использует CLI-библиотеку.
 *
 * Class Application
 * @package AppData
 */
class Application
{
    /**
     * @var Свойство для хранения объекта библиотеки.
     */
    private $consoleApp;

    /**
     * Инициализирует библиотеку.
     * Вызывает метод регистрирующий произвольные команды.
     *
     * Application constructor.
     */
    public function __construct()
    {
        $this->initConsoleApp();
        $this->registerCommands();
    }

    /**
     * Инициализация объекта CLI-библиотеки.
     */
    private function initConsoleApp()
    {
        $this->consoleApp = new ConsoleApp();
    }

    /**
     * Регистрация произвольных команд.
     */
    private function registerCommands()
    {
        $demoCommand = new Commands\DemoCommand();
        $this->consoleApp->addCommand($demoCommand);
    }

    /**
     *  Запуск обработки переданной команды и параметров.
     */
    public function run()
    {
        $this->consoleApp->run();
    }
}
