<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 20:31
 */
namespace WebHookEvents\RepositoryEvents\Entity;

/**
 * Class Person
 * @package WebHookEvents\RepositoryEvents\Entity
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
abstract class Person
{
    /** @var string */
    private $name;
    /** @var string */
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
