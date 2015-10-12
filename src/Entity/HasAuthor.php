<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 19:10
 */
namespace MBrzuchalski\WebHookIntegration\Entity;

/**
 * Trait HasAuthor
 * @package MBrzuchalski\WebHookIntegration\Entity
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
trait HasAuthor
{
    /** @var Author */
    private $author;

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
