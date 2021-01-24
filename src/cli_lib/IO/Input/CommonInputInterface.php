<?php

namespace CliLib\IO\Input;

use CliLib\Entity\Command\Config;

/**
 * Интерфейс определяющий набор методов которые должны
 * реализовать классы имплементирующие данный интерфейс.
 *
 * Interface CommonInputInterface
 * @package CliLib\IO\Input
 */
interface CommonInputInterface
{
    /**
     * Возвращает название переданной на запуск команды.
     *
     * @return string Название переданной на запуск команды
     */
    public function getCommand();

    /**
     * @return Config Метод должен вернуть объект класса Config содержащего обработанные
     * параметры и аргументы переданные на запуск.
     */
    public function getCommandConfig();
}
