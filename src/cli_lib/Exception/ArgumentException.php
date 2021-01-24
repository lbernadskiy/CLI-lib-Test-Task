<?php

namespace CliLib\Exception;

/**
 * Исключение для использования при проблемах с передаваемыми в CLI-строке аргументах.
 * Также выбрасывается при попытке установки уже заданного аргумента в рамках конфигурирования объекта команды.
 *
 * Class ArgumentException
 * @package CliLib\Exception
 */
class ArgumentException extends \Exception
{
}
