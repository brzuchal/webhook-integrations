<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.11.15
 * Time: 14:53
 */
namespace WebHookEvents\RepositoryEvents;

use Psr\Http\Message\RequestInterface;

/**
 * Interface Provider
 * @package WebHookEvents\RepositoryEvents
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
interface Provider
{
    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function satisfies(RequestInterface $request);

    /**
     * @param RequestInterface $request
     * @return Event
     */
    public function create(RequestInterface $request);
}
