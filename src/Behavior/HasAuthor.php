<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 19:10
 */
namespace WebHookEvents\RepositoryEvents\Behavior;

use WebHookEvents\RepositoryEvents\Entity\Author;

/**
 * Trait HasAuthor
 * @package WebHookEvents\RepositoryEvents\Behavior
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
