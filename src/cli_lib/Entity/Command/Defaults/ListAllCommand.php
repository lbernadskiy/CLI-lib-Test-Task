<?php

namespace CliLib\Entity\Command\Defaults;

use CliLib\Entity\Argument;
use CliLib\Entity\Command\{CommandBase, Config};
use CliLib\IO\Output\CommonOutputInterface;
use CliLib\Entity\Parameter;

/**
 * Дефолтная команда для вывода списка всех зарегистрированных команд.
 * Вызывается если не передана конкретная команда.
 *
 * Class ListAllCommand
 * @package CliLib\Entity\Command\Defaults
 */
class ListAllCommand extends CommandBase
{
    /**
     * Выводит список зарегистрированных команд кроме стандартных.
     *
     * @param CommonOutputInterface $output Объект вывода.
     * @param Config $config                Объект обработанных параметров и аргументов.
     */
    public function performAction(CommonOutputInterface $output, Config $config)
    {
        $application = $this->getApplication();
        $commands = $application->getCommands();
        $output->print('List of stored commands:', true);
        foreach ($commands as $command) {
            if (!$command->isDefault()) {
                $output->print('-------', true);
                $output->print('Command name: '.$command->getName(), true);
                $output->print('Command description: '.$command->getDescription(), true);
                $output->print('-------', true);
            }
        }
    }

    /**
     * Инициализация команды. Установка названия и описания.
     */
    public function initConfig()
    {
        $this->isDefault = true;
        $this->setName('show_all_commands');
        $this->setDescription('Prints all registered commands and theirs descriptions');
    }
}
