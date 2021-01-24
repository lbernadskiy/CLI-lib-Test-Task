<?php

namespace CliLib\IO\Output;

/**
 * Интерфейс определяет набор методов которые должны реализовать
 * все имплементирующие его классы.
 *
 * Interface CommonOutputInterface
 * @package CliLib\IO\Output
 */
interface CommonOutputInterface
{
    /**
     * Функция для вывода сообщения.
     *
     * @param string $text Текст который необходимо вывести.
     */
    public function print(string $text);
}
