<?php

namespace spec\WebHookEvents\RepositoryEvents\Entity;

use DateTime;
use WebHookEvents\RepositoryEvents\Entity\Author;
use PhpSpec\ObjectBehavior;

class CommitSpec extends ObjectBehavior
{
    function let(DateTime $timestamp, Author $author)
    {
        $this->beConstructedWith('a', 'Commit', $timestamp, $author, null);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('WebHookEvents\RepositoryEvents\Entity\Commit');
    }

    function it_can_getId()
    {
        $this->getId()->shouldReturn('a');
    }

    function it_can_getMessage()
    {
        $this->getMessage()->shouldReturn('Commit');
    }

    function it_can_getTimestamp(DateTime $timestamp)
    {
        $this->getTimestamp()->shouldReturn($timestamp);
    }

    function it_can_getAuthor(Author $author)
    {
        $this->getAuthor()->shouldReturn($author);
    }

    function it_can_getUrl()
    {
        $this->getUrl()->shouldBeNull();
    }
}
