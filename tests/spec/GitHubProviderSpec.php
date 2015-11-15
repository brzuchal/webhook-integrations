<?php

namespace spec\WebHookEvents\RepositoryEvents;

use Guzzle\Http\Message\RequestInterface;
use function GuzzleHttp\Psr7\parse_request;
use GuzzleHttp\Psr7\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use UnexpectedValueException;
use WebHookEvents\RepositoryEvents\PushEvent;

class GitHubProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('WebHookEvents\RepositoryEvents\GitHubProvider');
    }

    function it_satisfies_PushEvent_with_request()
    {
        $request = new Request(
            'POST',
            '/test',
            [
                'X-Github-Event' => 'push',
                'Content-Type' => 'application/json',
            ]
        );
        $this->satisfies($request)->shouldReturn(true);
    }

    function it_creates_PushEvent_from_request()
    {
        $payload = file_get_contents(__DIR__ . '/../examples/github-push-event.json');
        $request = new Request(
            'POST',
            '/test',
            [
                'X-Github-Event' => 'push',
                'Content-Type' => 'application/json'
            ],
            $payload
        );
        $this->create($request)->shouldHaveType(PushEvent::class);
    }

    function it_cant_create_PushEvent_from_malformed_json()
    {
        $request = new Request(
            'POST',
            '/test',
            [
                'X-Github-Event' => 'push',
                'Content-Type' => 'application/json'
            ],
            '#@'
        );
        $this->shouldThrow(UnexpectedValueException::class)->during('create', [$request]);
    }

    function it_cant_create_PushEvent_from_unrecognized_kind_json()
    {
        $request = new Request(
            'POST',
            '/test',
            [
                'X-Github-Event' => 'unrecognized',
                'Content-Type' => 'application/json'
            ],
            ''
        );
        $this->shouldThrow(UnexpectedValueException::class)->during('create', [$request]);
    }

    function it_cant_create_PushEvent_from_empty_kind_json()
    {
        $request = new Request(
            'POST',
            '/test',
            [
                'X-Github-Event' => '',
                'Content-Type' => 'application/json'
            ],
            '{}'
        );
        $this->shouldThrow(UnexpectedValueException::class)->during('create', [$request]);
    }
}
