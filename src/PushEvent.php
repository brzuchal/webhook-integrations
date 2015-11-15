<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 18:41
 */
namespace WebHookEvents\RepositoryEvents;

use WebHookEvents\RepositoryEvents\Behavior\HasCommits;
use WebHookEvents\RepositoryEvents\Behavior\HasRepository;
use WebHookEvents\RepositoryEvents\Entity\Pusher;
use WebHookEvents\RepositoryEvents\Entity\Repository;

/**
 * Class Push
 * @package WebHookEvents\RepositoryEvents\Event
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class PushEvent implements Event
{
    use HasRepository;
    use HasCommits;

    /** @var string */
    private $ref;
    /** @var string */
    private $before;
    /** @var string */
    private $after;
    /** @var Pusher */
    private $pusher;

    public function __construct($ref, $before, $after, array $commits, Pusher $pusher, Repository $repository)
    {
        $this->ref = $ref;
        $this->before = $before;
        $this->after = $after;
        $this->commits = $commits;
        $this->pusher = $pusher;
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @return string
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @return Pusher
     */
    public function getPusher()
    {
        return $this->pusher;
    }
}
