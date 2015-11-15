<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 05.11.15
 * Time: 13:01
 */
namespace WebHookEvents\RepositoryEvents;

use Psr\Http\Message\RequestInterface;

/**
 * Class Factory
 * @package WebHookEvents\RepositoryEvents
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Factory
{
    /** @var Provider[] */
    private $providers = [];

    /**
     * Factory constructor.
     * @param array $providers
     */
    public function __construct(array $providers = [])
    {
        if (empty($providers)) {
            $this->providers = [
                new GitLabProvider(),
                new GitHubProvider(),
            ];
        }

        foreach ($providers as $provider) {
            if ($provider instanceof Provider) {
                $this->providers[] = $provider;
            }
        }
    }

    /**
     * @param RequestInterface $request
     * @return null
     */
    public function create(RequestInterface $request)
    {
        foreach ($this->providers as $provider) {
            if ($provider->satisfies($request)) {
                return $provider->create($request);
            }
        }

        return null;
    }
}
