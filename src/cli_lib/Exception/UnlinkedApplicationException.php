<?php

namespace CliLib\Exception;

/**
 * Используется при попытке доступа к объекту приложения из команды когда
 * объект не был привязан.
 *
 * Class UnlinkedApplicationException
 * @package CliLib\Exception
 */
class UnlinkedApplicationException extends \Exception
{
}
