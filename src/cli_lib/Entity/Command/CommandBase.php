<?php

namespace CliLib\Entity\Command;

use CliLib\Entity\Argument;
use CliLib\Entity\Parameter;
use CliLib\IO\Output\CommonOutputInterface;
use CliLib\ConsoleApp;
use CliLib\Entity\Command\Config;
use CliLib\Exception\{UnlinkedApplicationException, ArgumentException, ParameterException};

/**
 * Абстрактный класс реализующий общие методы присущие всем командам
 * а также определяющий методы обязательные для реализации дочерними классами.
 *
 * Class CommandBase
 * @package CliLib\Entity\Command
 */
abstract class CommandBase
{
    /**
     * @var Название команды
     */
    private $name;
    /**
     * @var Описание команды
     */
    private $description;
    /**
     * @var Набор описания аргументов команды.
     */
    private $arguments;
    /**
     * @var Набор описания параметров команды.
     */
    private $parameters;
    /**
     * @var Свойство для хранения объекта приложения.
     */
    private $application;
    /**
     * @var Является ли стандартной командой.
     */
    protected $isDefault;

    /**
     * Вызывает инициализацию в рамках которой должны быть установлены название, описание
     * и доступные наборы аргументов и параметров.
     *
     * CommandBase constructor.
     * @param string|null $name
     */
    public function __construct(string $name = null)
    {
        if ($name) {
            $this->setName($name);
        }
        $this->initConfig();
    }

    /**
     * Возвращает название команды.
     *
     * @return mixed    Название команды.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Устанавливает название команды.
     *
     * @param string $name   Название команды.
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Возвращает описание команды.
     *
     * @return mixed    Описание команды.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Устанавливает описание команды.
     *
     * @param string $description   Описание команды.
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Сохраняет объект приложения для взаимодействия.
     *
     * @param ConsoleApp $app   Объект основного приложения.
     */
    public function linkApplication(ConsoleApp $app)
    {
        $this->application = $app;
    }

    /**
     * Возвращает привязанное приложение.
     *
     * @throws UnlinkedApplicationException Выбрасывается если приложение не привязано в момент вызова метода.
     * @return mixed
     */
    public function getApplication()
    {
        if ($this->application) {
            return $this->application;
        }
        throw new UnlinkedApplicationException('Application was not linked to current command');
    }

    /**
     * Сохраняет аргумент если он ещё не был сохранен,
     * в противном случае выбрасывает исключение.
     * 
     * @throws ArgumentException Выбрасывает если аргумент уже был задан.
     * @param Argument $arg      Объект аргумента.
     */
    public function addArgument(Argument $arg)
    {
        $argName = $arg->getName();
        if (!$this->arguments[$argName]) {
            $this->arguments[$argName] = $arg;
        } else {
            throw new ArgumentException(sprintf('Argument "%s" was already set.', $argName));
        }
    }

    /**
     * Метод для сохранения несколько аргументов сразу.
     *
     * @param array $arguments  Массив объектов аргументов.
     */
    public function addArguments($arguments = [])
    {
        if ($arguments) {
            foreach ($arguments as $arg) {
                $this->addArgument($arg);
            }
        }
    }

    /**
     * Метод возвращает сохраненный набор аргументов.
     *
     * @return mixed    Набор аргументов.
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Сохраняет параметр если он ещё не был сохранен,
     * в противном случае выбрасывает исключение.
     *
     * @throws ParameterException   Выбрасывает если параметр уже был задан.
     * @param Parameter $param      Объект параметра.
     */
    public function addParameter(Parameter $param)
    {
        $paramName = $param->getName();
        if (!$this->options[$paramName]) {
            $this->parameters[$paramName] = $param;
        } else {
            throw new ParameterException(sprintf('Parameter "%s" was already set.', $paramName));
        }
    }

    /**
     * Метод для сохранения несколько аргументов сразу.
     *
     * @param array $parameters Массив объектов параметров.
     */
    public function addParameters($parameters = [])
    {
        if ($parameters) {
            foreach ($parameters as $param) {
                $this->addParameter($param);
            }
        }
    }

    /**
     * Метод для получения сохраненных параметров.
     *
     * @return mixed    Набор сохраненных параметров.
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Метод определяет является ли команда стандартной (предустановленной).
     *
     * @return mixed
     */
    public function isDefault()
    {
        return $this->isDefault;
    }

    /**
     * Метод для реализации дочерними классами.
     * Отвечает за непосредственное выполнение действий.
     *
     * @param CommonOutputInterface $output             Объект вывода
     * @param \CliLib\Entity\Command\Config $config   Объект обработанных входящих параметров и аргументов.
     */
    abstract function performAction(CommonOutputInterface $output, Config $config);
    
}
