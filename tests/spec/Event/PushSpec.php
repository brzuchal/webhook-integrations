<?php

namespace spec\WebHookEvents\RepositoryEvents\Event;

use WebHookEvents\RepositoryEvents\Entity\Commit;
use WebHookEvents\RepositoryEvents\Entity\Pusher;
use WebHookEvents\RepositoryEvents\Entity\Repository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PushEventSpec extends ObjectBehavior
{
    function let(Commit $commit1, Commit $commit2, Pusher $pusher, Repository $repository)
    {
        $this->beConstructedWith('a', 'b', 'c', array($commit1, $commit2), $pusher, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('WebHookEvents\RepositoryEvents\Event\PushEvent');
    }

    function it_can_getRef()
    {
        $this->getRef()->shouldReturn('a');
    }

    function it_can_getBefore()
    {
        $this->getBefore()->shouldReturn('b');
    }

    function it_can_getAfter()
    {
        $this->getAfter()->shouldReturn('c');
    }

    function it_can_get_commits(Commit $commit1, Commit $commit2)
    {
        $commits = $this->getCommits();
        $commits->shouldBeArray();
        $commits[0]->shouldBe($commit1);
        $commits[1]->shouldBe($commit2);
    }

    function it_can_getPusher(Pusher $pusher)
    {
        $this->getPusher()->shouldReturn($pusher);
    }

    function it_can_getRepository(Repository $repository)
    {
        $this->getRepository()->shouldreturn($repository);
    }
}
