<?php

namespace CliLib\IO\Output;

/**
 * Класс для вывода в CLI.
 *
 * Class CliOutput
 * @package CliLib\IO\Output
 */
class CliOutput implements CommonOutputInterface
{
    /**
     * @var Свойство для хранения потока вывода.
     */
    private $stream;

    /**
     * CliOutput constructor.
     * Инициализирует поток вывода.
     */
    public function __construct()
    {
        $this->initStream();
    }

    /**
     * Инициализиция потока вывода stdout
     */
    private function initStream()
    {
        $this->stream = @fopen('php://stdout', 'w');
    }

    /**
     * Метод вывода строки в CLI. Может также добавлять перенос строки.
     *
     * @param string $text          Текст для вывода.
     * @param bool $needLineBreak   Нужен ли перенос строки в конце текста.
     */
    public function print(string $text, $needLineBreak = false)
    {
        @fwrite($this->stream, $text);
        if ($needLineBreak) {
            $this->addLineBreak();
        }
    }

    /**
     * Метод для добавления переноса строки без текста.
     */
    public function addLineBreak()
    {
        @fwrite($this->stream, PHP_EOL);
    }
}
