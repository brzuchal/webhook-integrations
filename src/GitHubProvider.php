<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 20:19
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
 * Class GitHub
 * @package WebHookEvents\RepositoryEvents
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class GitHubProvider extends ProviderBase
{
    protected static $acceptedContentType = [
        self::JSON_MIME,
        self::URLENCODED_FORM_MIME,
    ];

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function satisfies(RequestInterface $request)
    {
        return !empty($request->getHeader('X-Github-Event') && $this->requestContentTypeIsAcceptable($request));
    }

    /**
     * @param RequestInterface $request
     * @return void|Event
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

        $type = reset($request->getHeader('X-Github-Event'));
        if (empty($type)) {
            throw new UnexpectedValueException("Empty object kind");
        }

        switch ($type) {
            case 'push':
                return $this->createPushEvent($payload);
            default:
                throw new UnexpectedValueException("Unrecognized object kind");
        }
    }

    /**
     * TODO: implement commit added, modified and removed
     * @param stdClass $payload
     * @return PushEvent
     */
    public function createPushEvent(stdClass $payload)
    {
        $commits = [];
        foreach ($payload->commits as $commit) {
            $timestamp = DateTime::createFromFormat(DateTime::ATOM, $commit->timestamp);
            $author = new Author($commit->author->name, $commit->author->email, $commit->author->username);
            $commits[] = new Commit($commit->id, $commit->message, $timestamp, $author, $commit->url);
        }
        $pusher = new Pusher($payload->pusher->name, $payload->pusher->email);
        $repository = new Repository($payload->repository->name, $payload->repository->url, $payload->repository->homepage ?: $payload->repository->html_url);
        $pushEvent = new PushEvent($payload->ref, $payload->before, $payload->after, $commits, $pusher, $repository);

        return $pushEvent;
    }
}
