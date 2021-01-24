<?php

namespace CliLib\Entity\Command\Defaults;

use CliLib\Entity\Argument;
use CliLib\Entity\Command\{CommandBase, Config};
use CliLib\IO\Output\CommonOutputInterface;
use CliLib\Entity\Parameter;

/**
 * Класс реализующий команду помощи.
 * Выводит все установленные для команды аргументы и параметры, а также их описания.
 *
 * Class HelpCommand
 * @package CliLib\Entity\Command\Defaults
 */
class HelpCommand extends CommandBase
{
    /**
     * Выводит аргументы и параметры
     *
     * @param CommonOutputInterface $output Объект вывода
     * @param Config $config                Объект обработанных параметров и аргументов
     */
    public function performAction(CommonOutputInterface $output, Config $config)
    {
        $application = $this->getApplication();
        $commandName = $config->getHelpCommand();
        $command = $application->getCommandByName($commandName);
        $output->print('Description: '.$command->getDescription(), true);
        $arguments = $command->getArguments();
        if ($arguments) {
            $output->print('Allowed arguments:', true);
            foreach ($arguments as $arg) {
                $output->print("\t".'Argument name: '.$arg->getName(), true);
                $output->print("\t".'Argument description: '.$arg->getDescription(), true);
            }
        }
        $params = $command->getParameters();
        if ($params) {
            $output->print('Allowed params:', true);
            foreach ($params as $param) {
                $output->print("\t".'Param name: '.$param->getName(), true);
                $output->print("\t".'Param description: '.$param->getDescription(), true);
            }
        }
    }

    /**
     * Инициализация команды. Установка названия и описания.
     */
    public function initConfig()
    {
        $this->isDefault = true;
        $this->setName('help');
        $this->setDescription('Default command to show help for any other registered command');
    }
}
