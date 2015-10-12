<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 20:41
 */
use MBrzuchalski\WebHookIntegration\Entity\Author;
use MBrzuchalski\WebHookIntegration\Entity\Commit;
use MBrzuchalski\WebHookIntegration\Entity\Pusher;
use MBrzuchalski\WebHookIntegration\Entity\PushEvent;
use MBrzuchalski\WebHookIntegration\Entity\Repository;
use MBrzuchalski\WebHookIntegration\Provider\GitLab;

/**
 * Class GitLab
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class GitLabTest extends PHPUnit_Framework_TestCase
{
    /** @var PushEvent */
    private $pushEvent;

    public function setUp()
    {
        $pushEventJsonString = file_get_contents(__DIR__ . '/../examples/gitlab-push-event.json');
        $this->pushEvent = GitLab::createFromJson($pushEventJsonString);
    }

    public function testPushEventObjectIsProper()
    {
        $pushEvent = $this->pushEvent;
        $this->assertInstanceOf(PushEvent::class, $pushEvent);
        $this->assertInternalType('string', $pushEvent->getRef());
        $this->assertInternalType('string', $pushEvent->getBefore());
        $this->assertInternalType('string', $pushEvent->getAfter());
    }

    public function testPushEventObjectHasRepository()
    {
        $repository = $this->pushEvent->getRepository();
        $this->assertInstanceOf(Repository::class, $repository);
        $this->assertInternalType('string', $repository->getName());
        $this->assertInternalType('string', $repository->getUrl());
        $this->assertInternalType('string', $repository->getHomepage());
    }

    public function testPushEventHasCommits()
    {
        $this->assertInternalType('bool', $this->pushEvent->hasCommits());
        $this->assertTrue($this->pushEvent->hasCommits());
    }

    public function testPushEventObjectHasCommitsArray()
    {
        $commits = $this->pushEvent->getCommits();
        $this->assertInternalType('array', $commits);
        /** @var Commit $commit */
        foreach ($commits as $commit) {
            $this->assertInstanceOf(Commit::class, $commit);
            $this->assertInternalType('string', $commit->getId());
            $this->assertInternalType('string', $commit->getMessage());
            $this->assertInternalType('string', $commit->getUrl());
            $this->assertInstanceOf(DateTime::class, $commit->getTimestamp());
            $this->assertInstanceOf(Author::class, $commit->getAuthor());
            $this->assertInternalType('string', $commit->getAuthor()->getName());
            $this->assertInternalType('string', $commit->getAuthor()->getEmail());
        }
    }

    public function testPushEventHasPusher()
    {
        $pusher = $this->pushEvent->getPusher();
        $this->assertInstanceOf(Pusher::class, $pusher);
        $this->assertInternalType('string', $pusher->getName());
        $this->assertInternalType('string', $pusher->getEmail());
    }
}
