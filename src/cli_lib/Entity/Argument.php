<?php

namespace CliLib\Entity;

/**
 * Класс использующийся в рамках конфигурации команды.
 * Объект данного класса добавляется как аргумент к команде.
 *
 * Class Argument
 * @package CliLib\Entity
 */
class Argument
{
    /**
     * @var string Свойство для название аргумента.
     */
    private $name;
    /**
     * @var string Свойство для описания аргумента.
     */
    private $description;

    /**
     * Конструктор принимает на вход обязательное название и опционально - описание.
     *
     * Argument constructor.
     * @param string $name          Название аргумента.
     * @param string $description   Описание аргумента.
     */
    public function __construct(string $name, string $description = '')
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * Возвращает название аргумента.
     *
     * @return string   Название аргумента.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Возвращает описание аргумента.
     *
     * @return string   Описание аргумента.
     */
    public function getDescription()
    {
        return $this->description;
    }
}
