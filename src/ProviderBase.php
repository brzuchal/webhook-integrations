<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 15.11.15
 * Time: 12:12
 */

namespace WebHookEvents\RepositoryEvents;


use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;

abstract class ProviderBase implements Provider
{
    const JSON_MIME = 'application/json';
    const URLENCODED_FORM_MIME = 'application/x-www-form-urlencoded';

    protected static $acceptedContentType = [];
    protected static $contentTypes = [
        self::JSON_MIME,
        self::URLENCODED_FORM_MIME,
    ];

    /**
     * @param RequestInterface $request
     * @return bool
     */
    protected function requestContentTypeIsAcceptable(RequestInterface $request)
    {
        $contentTypes = $request->getHeader('Content-Type');
        if (empty($contentTypes)) {
            throw new InvalidArgumentException("Given request is missing Content-Type header");
        }
        $contentType = reset($contentTypes);

        foreach (static::$acceptedContentType as $acceptedContentType) {
            if (substr($contentType, 0, strlen($acceptedContentType)) == $acceptedContentType) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    protected function requestContentTypeIsJson(RequestInterface $request)
    {
        $contentTypes = $request->getHeader('Content-Type');
        if (empty($contentTypes)) {
            throw new InvalidArgumentException("Given request is missing Content-Type header");
        }
        $contentType = reset($contentTypes);

        return substr($contentType, 0, 16) === self::JSON_MIME;
    }
}