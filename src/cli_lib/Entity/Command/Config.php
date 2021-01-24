<?php

namespace CliLib\Entity\Command;

/**
 * Объекты данного класса используются для хранения обработанных аргументов
 * и параметров переданных на запуск команды.
 *
 * Class Config
 * @package CliLib\Entity\Command
 */
class Config
{
    /**
     * @var string Свойство для хранения названия команды.
     */
    private $commandName;
    /**
     * @var array Свойство для хранения набора аргументов.
     */
    private $arguments;
    /**
     * @var array Свойство для хранения набора параметров.
     */
    private $parameters;
    /**
     * @var string Свойство для хранения названия команды по которой нужно показать помощь.
     */
    private $helpCommand;

    /**
     * Опционально принимает название, аргументы и параметры.
     *
     * Config constructor.
     * @param string $name
     * @param array $args
     * @param array $params
     */
    public function __construct(string $name = '', array $args = [], array $params = [])
    {
        $this->commandName = $name;
        $this->arguments = $args;
        $this->parameters = $params;
    }

    /**
     * Устанавливает название команды.
     *
     * @param string $name  Название команды.
     */
    public function setName(string $name)
    {
        $this->commandName = $name;
    }

    /**
     * Возвращает название команды.
     *
     * @return string   Название команды.
     */
    public function getName()
    {
        return $this->commandName;
    }

    /**
     * Сохраняет параметр.
     *
     * @param string $name  Название параметра.
     * @param $value        Значение параметра.
     */
    public function setParam(string $name, $value)
    {
        $this->parameters[$name][] = $value;
    }

    /**
     * Возвращает сохраненные параметры.
     *
     * @return array    Массив сохраненных параметров.
     */
    public function getParams()
    {
        return $this->parameters;
    }

    /**
     * Сохраняет аргумент.
     *
     * @param string $value Значение аргумента.
     */
    public function setArgument(string $value)
    {
        $this->arguments[] = $value;
    }

    /**
     * Возвращает сохраненные аргументы.
     *
     * @return array    Массив сохраненных аргументов.
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Проверяет если среди аргументов есть определенное значение.
     *
     * @param string $arg   Искомое значение.
     * @return bool         Найдено или нет.
     */
    public function isSetArgument(string $arg)
    {
        return array_search($arg, $this->arguments) !== false;
    }

    /**
     * Устанавливает название команды по которой нужно показать помощь.
     *
     * @param string $command   Название команды.
     */
    public function setHelpCommand(string $command)
    {
        $this->helpCommand = $command;
    }

    /**
     * Возвращает название команды по которой нужно получить помощь.
     *
     * @return mixed    
     */
    public function getHelpCommand()
    {
        return $this->helpCommand;
    }
}
