<?php

namespace CliLib;

use CliLib\Entity\Command\{CommandBase};
use CliLib\IO\Output\{CommonOutputInterface, CliOutput};
use CliLib\IO\Input\{CommonInputInterface, CliInput};
use CliLib\Entity\Command\Defaults\{ListAllCommand, HelpCommand};
use CliLib\Exception\{UnknownCommandException, ParameterException};

/**
 * Данный класс позволяет регистрировать нужные команды в рамках хита,
 * отвечает за запуск необходимой команды при вызове, а также за обрабокту
 * входящих параметров. Является основной входной точкой библиотеки.
 */
class ConsoleApp
{
    /**
     * @var array Массив для хранения объектов зарегистрированных команд
     */
    private $storedCommands = [];
    /**
     * @var string Название команды которая будет отрабатывать по умолчанию когда не передана команда
     */
    private $defaultCommand;

    /**
     * ConsoleApp конструктор.
     * Устанавливает название дефолтной команды.
     * Инициализирует и регистрирует две дефолтный команды - показ списка всех команд и команда помощи.
     */
    public function __construct()
    {
        $this->defaultCommand = 'show_all_commands';
        $this->initDefaultCommands();
    }

    /**
     * Регистрирует команду.
     *
     * @param CommandBase $command Объект класса команды, класс должен наследовать базовый абстрактный класс.
     */
    public function addCommand(CommandBase $command)
    {
        $this->storedCommands[$command->getName()] = $command;
    }

    /**
     * Инициализирует объекты ввода/вывода если они не переданы изначально.
     * Обрабатывает входящие параметры и аргументы для дальнейшего использования.
     * Проверяет необходимость запуска дефолтной команды списка и команды помощи.
     * Запускает переданную команду если она была зарегистрирована, в противном случае выбрасывает исключение.
     *
     * @param CommonInputInterface|null $input   Объект имплементирующий интерфейс ввода. По дефолту - используется класс для ввода аргументов из CLI.
     * @param CommonOutputInterface|null $output Объект имплементирующий интерфейс вывода. По дефолту - используется класс для вывода в CLI.
     * @throws UnknownCommandException Выбрасывается при передаче неизвестной (незарегистрированной команды).
     */
    public function run(CommonInputInterface $input = null, CommonOutputInterface $output = null)
    {
        if ($output === null) {
            $output = $this->getDefaultOutput();
        }
        if ($input === null) {
            $input = $this->getDefaultInput();
        }
        try {
            $commandConfig = $input->getCommandConfig();
            if (!$commandConfig->getName()) {
                $commandConfig->setName($this->defaultCommand);
            } elseif ($commandConfig->isSetArgument('help')) {
                $commandConfig->setHelpCommand($commandConfig->getName());
                $commandConfig->setName('help');
            }
            $command = $this->commandLookup($commandConfig->getName());
            $command->performAction($output, $commandConfig);
        } catch (UnknownCommandException $e) {
            $output->print($e->getMessage());
        } catch (ParameterException $e) {
            $output->print($e->getMessage());
        }

    }

    /**
     * Возвращает массив содержащий набор объектов зарегистрированных команд.
     *
     * @return array Массив объектов зарегистрированных команд.
     */
    public function getCommands()
    {
        return $this->storedCommands;
    }

    /**
     * Возвращает конкретную зарегистрированную команду из массива по названию.
     *
     * @param string $name Название команды которую необходимо вернуть.
     * @return mixed       Возвращает объект команды или null если такой команды нет среди зарегистрированных.
     */
    public function getCommandByName(string $name)
    {
        return $this->storedCommands[$name];
    }

    /**
     * Инициализирует дефолтные команды списка и помощи.
     * Также привязывает объект приложения к объекту команды для обратного доступа.
     */
    private function initDefaultCommands()
    {
        $listAllCommand = new ListAllCommand();
        $listAllCommand->linkApplication($this);
        $this->addCommand($listAllCommand);
        $helpCommand = new HelpCommand();
        $helpCommand->linkApplication($this);
        $this->addCommand($helpCommand);
    }

    /**
     * Ищет команду среди сохраненных. В случае неудачи выбрасывает исключение.
     *
     * @param string $commandLookupName Название команды.
     * @return mixed                    Объект команды.
     * @throws UnknownCommandException Выбрасывается при передаче неизвестной (незарегистрированной команды).
     */
    private function commandLookup(string $commandLookupName)
    {
        foreach ($this->storedCommands as $command) {
            if ($command->getName() == $commandLookupName) {
                return $command;
            }
        }
        throw new UnknownCommandException(sprintf('Unknown command "%s".', $commandLookupName));
    }

    /**
     * Возвращает объект обработки вывода по умолчанию
     *
     * @return CliOutput
     */
    private function getDefaultOutput()
    {
        return new CliOutput();
    }

    /**
     * Возвращает объект обработки ввода по умолчанию
     *
     * @return CliInput
     */
    private function getDefaultInput()
    {
        return new CliInput();
    }
}
