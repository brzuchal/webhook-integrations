<?php

namespace spec\MBrzuchalski\WebHookIntegration\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthorSpec extends ObjectBehavior
{
    const NAME = 'Michał Brzuchalski';
    const EMAIL = 'michal.brzuchalski@gmail.com';

    function let()
    {
        $this->beConstructedWith(self::NAME, self::EMAIL);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MBrzuchalski\WebHookIntegration\Entity\Author');
    }

    function it_can_getName()
    {
        $this->getName()->shouldReturn(self::NAME);
    }

    function it_can_getEmail()
    {
        $this->getEmail()->shouldReturn(self::EMAIL);
    }
}
