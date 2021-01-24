<?php

namespace CliLib\Exception;

/**
 * Исключение для использования при проблемах с передаваемыми в CLI-строке параметрах.
 * Также выбрасывается при попытке установки уже заданного параметра в рамках конфигурирования объекта команды.
 * 
 * Class ParameterException
 * @package CliLib\Exception
 */
class ParameterException extends \Exception
{
}
