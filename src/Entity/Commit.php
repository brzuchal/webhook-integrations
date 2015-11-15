<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 19:04
 */
namespace WebHookEvents\RepositoryEvents\Entity;

use DateTime;

/**
 * Class Commit
 * @package WebHookEvents\RepositoryEvents\Entity
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class Commit
{
    /** @var string */
    private $id;
    /** @var string */
    private $message;
    /** @var DateTime */
    private $timestamp;
    /** @var Author */
    private $author;
    /** @var string */
    private $url;

    public function __construct($id, $message, DateTime $timestamp, Author $author, $url = null)
    {
        $this->id = $id;
        $this->message = $message;
        $this->timestamp = $timestamp;
        $this->author = $author;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
