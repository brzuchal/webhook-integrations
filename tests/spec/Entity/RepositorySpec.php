<?php

namespace spec\WebHookEvents\RepositoryEvents\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('name', 'url', 'homepage');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('WebHookEvents\RepositoryEvents\Entity\Repository');
    }

    function it_can_getName()
    {
        $this->getName()->shouldReturn('name');
    }

    function it_can_getUrl()
    {
        $this->getUrl()->shouldReturn('url');
    }

    function it_can_getHomepage()
    {
        $this->getHomepage()->shouldreturn('homepage');
    }
}
