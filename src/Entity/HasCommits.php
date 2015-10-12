<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 19:09
 */
namespace MBrzuchalski\WebHookIntegration\Entity;

/**
 * Trait HasCommits
 * @package MBrzuchalski\WebHookIntegration\Entity
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
trait HasCommits
{
    /** @var Commit[] */
    private $commits;

    /**
     * @return Commit[]
     */
    public function getCommits()
    {
        return $this->commits;
    }

    /**
     * @return bool
     */
    public function hasCommits()
    {
        return is_array($this->commits) && sizeof($this->commits) > 0;
    }
}
