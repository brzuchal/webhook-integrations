<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 18:41
 */
namespace MBrzuchalski\WebHookIntegration\Entity;

/**
 * Class PushEvent
 * @package MBrzuchalski\WebHookIntegration\Entity
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class PushEvent
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
