<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 20:21
 */
namespace WebHookEvents\RepositoryEvents;

use DateTime;
use Psr\Http\Message\RequestInterface;
use stdClass;
use UnexpectedValueException;
use WebHookEvents\RepositoryEvents\Entity\Author;
use WebHookEvents\RepositoryEvents\Entity\Commit;
use WebHookEvents\RepositoryEvents\Entity\Pusher;
use WebHookEvents\RepositoryEvents\Entity\Repository;

/**
 * Class GitLab
 * @package WebHookEvents\RepositoryEvents\Provider
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class GitLabProvider extends ProviderBase
{
    protected static $acceptedContentType = [
        self::JSON_MIME,
    ];

    /**
     * @param RequestInterface $request
     * @return bool|void
     */
    public function satisfies(RequestInterface $request)
    {
        return !empty($request->getHeader('X-Gitlab-Event')) && $this->requestContentTypeIsAcceptable($request);
    }

    /**
     * @param RequestInterface $request
     * @return null|PushEvent
     */
    public function create(RequestInterface $request)
    {
        if (false === $this->requestContentTypeIsJson($request)) {
            throw new UnexpectedValueException('Given request has different Content-Type, expected JSON');
        }

        $payload = json_decode($request->getBody());

        if (!$payload && json_last_error() !== JSON_ERROR_NONE) {
            throw new UnexpectedValueException("Malformed payload content, expecting JSON.");
        }
        if (empty($payload->object_kind)) {
            throw new UnexpectedValueException("Empty object kind");
        }

        switch ($payload->object_kind) {
            case 'push':
                return $this->createPushEvent($payload);
            default:
                throw new UnexpectedValueException("Unrecognized object kind");
        }
    }

    /**
     * @param stdClass $payload JSON payload
     * @return PushEvent
     */
    public function createPushEvent(stdClass $payload)
    {
        $commits = [];
        foreach ($payload->commits as $commit) {
            $timestamp = DateTime::createFromFormat(DateTime::ATOM, $commit->timestamp);
            $author = new Author($commit->author->name, $commit->author->email);
            $commits[] = new Commit($commit->id, $commit->message, $timestamp, $author, $commit->url);
        }
        $pusher = new Pusher($payload->user_name, $payload->user_email);
        $repository = new Repository($payload->repository->name, $payload->repository->url, $payload->repository->homepage);
        $pushEvent = new PushEvent($payload->ref, $payload->before, $payload->after, $commits, $pusher, $repository);

        return $pushEvent;
    }
}
