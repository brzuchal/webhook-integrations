<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 12.10.15
 * Time: 18:46
 */
namespace MBrzuchalski\WebHookIntegration\Entity;

/**
 * Class Repository
 * @package MBrzuchalski\WebHookIntegration\Entity
 * @author Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
class Repository
{
    /** @var string */
    private $name;
    /** @var string */
    private $url;
    /** @var string */
    private $homepage;

    public function __construct($name, $url, $homepage)
    {
        $this->name = $name;
        $this->url = $url;
        $this->homepage = $homepage;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }
}
