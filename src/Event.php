<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.11.15
 * Time: 15:07
 */
namespace WebHookEvents\RepositoryEvents;

use WebHookEvents\RepositoryEvents\Entity\Repository;

/**
 * Interface RepositoryEvent
 * @package WebHookEvents\RepositoryEvents
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
interface Event
{
    /**
     * @return Repository
     */
    public function getRepository();
}
