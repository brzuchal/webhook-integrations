<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 20:21
 */
namespace MBrzuchalski\WebHookIntegration\Provider;

use DateTime;
use MBrzuchalski\WebHookIntegration\Entity\Author;
use MBrzuchalski\WebHookIntegration\Entity\Commit;
use MBrzuchalski\WebHookIntegration\Entity\Pusher;
use MBrzuchalski\WebHookIntegration\Entity\PushEvent;
use MBrzuchalski\WebHookIntegration\Entity\Repository;
use UnexpectedValueException;

/**
 * Class GitLab
 * @package MBrzuchalski\WebHookIntegration\Provider
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class GitLab
{
    /**
     * @param $jsonString
     * @return PushEvent
     */
    public static function createFromJson($jsonString)
    {
        $json = json_decode($jsonString);
        if (empty($json->object_kind)) {
            throw new UnexpectedValueException("Unrecognized object kind");
        }
        switch ($json->object_kind) {
            case 'push':
                $commits = [];
                foreach ($json->commits as $commit) {
                    $timestamp = DateTime::createFromFormat(DateTime::ATOM, $commit->timestamp);
                    $author = new Author($commit->author->name, $commit->author->email);
                    $commits[] = new Commit($commit->id, $commit->message, $timestamp, $author, $commit->url);
                }
                $pusher = new Pusher($json->user_name, $json->user_email);
                $repository = new Repository($json->repository->name, $json->repository->url, $json->repository->homepage);
                $pushEvent = new PushEvent($json->ref, $json->before, $json->after, $commits, $pusher, $repository);

                return $pushEvent;
        }

        throw new UnexpectedValueException("Unrecognized object kind, given: {$json->object_kind}");
    }
}
