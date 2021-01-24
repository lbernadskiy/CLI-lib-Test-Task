<?php

namespace CliLib\Entity;

/**
 * Класс использующийся в рамках конфигурации команды.
 * Объект данного класса добавляется как параметр к команде.
 *
 * Class Parameter
 * @package CliLib\Entity
 */
class Parameter
{
    /**
     * @var string Свойство для хранения названия параметра.
     */
    private $name;
    /**
     * @var string Свойство для хранения описания параметра.
     */
    private $description;

    /**
     * Конструктор принимает на вход обязательное название и опционально - описание.
     *
     * Parameter constructor.
     * @param string $name          Название параметра.
     * @param string $description   Описание параметра.
     */
    public function __construct(string $name, string $description = '')
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * Возвращает название параметра.
     *
     * @return string Название параметра.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Возвращает описание параметра.
     *
     * @return string Описание параметра.
     */
    public function getDescription()
    {
        return $this->description;
    }
}
