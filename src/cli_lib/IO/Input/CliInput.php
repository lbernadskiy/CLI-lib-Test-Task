<?php

namespace CliLib\IO\Input;

use CliLib\Entity\Command\Config;
use CliLib\Exception\ParameterException;

/**
 * Класс реализующий обработку аргументов и параметров переданных
 * на запуск команды.
 *
 * Class CliInput
 * @package CliLib\IO\Input
 */
class CliInput implements CommonInputInterface
{
    /**
     * @var array Свойство для хранения необработанных входящих аргументов и параметров.
     */
    private $argsRaw;

    /**
     * CliInput constructor.
     * Сохраняет в свойство серверный argv.
     */
    public function __construct()
    {
        $this->argsRaw = $_SERVER['argv'] ?: [];
    }

    /**
     * Выполняет обработку "сырых" аргументов, в случае некорректных данных выбрасывает исключение.
     *
     * @return Config             Объект класса содержащего обработанные аргументы и параметры для запуска команды.
     * @throws ParameterException Выбрасывается в случае если для параметра не передано значение или передано пустое значение.
     */
    public function getCommandConfig()
    {
        $config = new Config();
        if ($this->argsRaw) {
            array_shift($this->argsRaw);
            $commandName = $this->getCommand();
            if ($commandName) {
                $config->setName($commandName);
            }
            foreach ($this->argsRaw as $rawLine) {
                if (preg_match('/\[(.{1,})\]/', $rawLine)) {
                    $paramContent = str_replace(['[', ']'], '', $rawLine);
                    $paramNameToValue = explode('=', $paramContent);
                    if (count($paramNameToValue) < 2) {
                        throw new ParameterException(
                            sprintf('Incorrect format for parameter "%s".', $paramNameToValue[0])
                        );
                    } elseif (!$paramNameToValue[1]) {
                        throw new ParameterException(
                            sprintf('No value passed for parameter "%s".', $paramNameToValue[0])
                        );
                    } else {
                        $config->setParam($paramNameToValue[0], $paramNameToValue[1]);
                    }
                } else {
                    $argumentContent = str_replace(['{', '}'], '', $rawLine);
                    $config->setArgument($argumentContent);
                }
            }
        }

        return $config;
    }

    /**
     * Метод для получения названия команды.
     * Возвращает первый по счету аргумент.
     *
     * @return mixed Первый переданный в CLI-строке аргумент.
     */
    public function getCommand()
    {
        return array_shift($this->argsRaw);
    }
}
