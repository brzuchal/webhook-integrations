<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 19:07
 */
namespace MBrzuchalski\WebHookIntegration\Entity;

/**
 * Trait HasRepository
 * @package MBrzuchalski\WebHookIntegration\Entity
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
trait HasRepository
{
    /** @var Repository */
    private $repository;

    /**
     * @return Repository
     */
    public function getRepository()
    {
        return $this->repository;
    }
}
