<?php

namespace AppData\Commands;

use CliLib\Entity\Argument;
use CliLib\Entity\Command\{CommandBase, Config};
use CliLib\IO\Output\CommonOutputInterface;
use CliLib\Entity\Parameter;

/**
 * Демо-команда для демонстрации использования библиотеки и базового класса команды.
 *
 * Class DemoCommand
 * @package AppData\Commands
 */
class DemoCommand extends CommandBase
{
    /**
     * Выводит все переданные аргументы и параметры.
     *
     * @param CommonOutputInterface $output Объект вывода.
     * @param Config $config                Объект обработанных аргументов и параметров.
     */
    public function performAction(CommonOutputInterface $output, Config $config)
    {
        $output->addLineBreak();
        $output->print('Called command: '.$config->getName(), true);
        $output->addLineBreak();
        $arguments = $config->getArguments();
        if ($arguments) {
            $output->print('Arguments:', true);
            foreach ($arguments as $arg) {
                $output->print("\t".$arg, true);
            }
        }
        $params = $config->getParams();
        if ($params) {
            $output->addLineBreak();
            $output->print('Parameters:', true);
            foreach ($params as $paramName => $paramValues) {
                $output->print("\t".$paramName, true);
                foreach ($paramValues as $value) {
                    $output->print("\t\t".$value, true);
                }
            }
        }
    }

    /**
     * Установка описания параметров и аргументов.
     * Установка названия и описания команды.
     */
    public function initConfig()
    {
        $this->setName('demo_command');
        $this->setDescription('This is demo command');
        $this->addArgument(new Argument('test', 'This is test argument'));
        $this->addArgument(new Argument('test_2', 'This is test argument 2'));
        $this->addParameter(new Parameter('param', 'This is test parameter'));
        $this->addParameter(new Parameter('param_1', 'This is test parameter 2'));
        $this->addArguments(
            [
                new Argument('test_3', 'This is test argument 3'),
                new Argument('test_4', 'This is test argument 4')
            ]
        );
        $this->addParameters(
            [
                new Parameter('param_3', 'This is test parameter 3'),
                new Parameter('param_4', 'This is test parameter 4')
            ]
        );
    }
}
