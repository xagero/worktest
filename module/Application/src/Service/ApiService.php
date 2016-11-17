<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date   16.11.2016 18:59
 */

namespace Application\Service;

use Application\Service\Api\ApiInterface;
use Exception;
use Throwable;
use Zend\Cache\Storage\Adapter\AbstractAdapter as Cache;
use Zend\Http\Client;

/**
 * Class ApiService
 *
 * @package Application
 */
class ApiService
{
    CONST CACHE_KEY = 'usd-rate';

    /** @var array  */
    protected $configArray = [];

    /** @var Cache $cache */
    protected $cache;

    protected $resultValue = null;

    /**
     * @param array $configArray
     */
    public function setConfigArray(array $configArray)
    {
        $this->configArray = $configArray;
    }

    /**
     * @param mixed $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    /**
     * Init
     */
    public function init()
    {
        if (!$this->cache->hasItem(self::CACHE_KEY)) {
            $value = $this->process();
            $this->cache->setItem(self::CACHE_KEY, $value);
        }
    }

    public function process()
    {
        $sorted = $this->processSortOrder($this->configArray);

        while (is_null($this->resultValue) && count($sorted)) {

            $current = array_shift($sorted);

            if (null != ($data = $this->loadExternal($current['link']))) {
                $class = $current['api'];

                /** @var ApiInterface $api */
                $api = new $class;
                $this->resultValue = $api->fetchResult($data);

            }

            $api = null;

        }

        return $this->resultValue;
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function processSortOrder($data)
    {
        $result = [];
        foreach ($data as $k => $v) {
            $result[$v['order']] = $v;
        }

        ksort($result);

        return $result;
    }

    /**
     * Load data from external source
     *
     * @param $link
     * @return null|string
     */
    private function loadExternal($link)
    {
        $return = null;

        $client = new Client($link, [
            'maxredirects' => 5,
            'timeout'      => 10
        ]);

        try {

            $response = $client->send();

            if (200 != $response->getStatusCode()) {
                throw new Exception('Invalid status code');
            }

            $return = $response->getBody();

        } catch (Throwable $e) {
            //echo "Error to load {$link}, " . $e->getMessage();
        }

        return $return;
    }

    /**
     * @return null
     */
    public function getResultValue()
    {
        $this->resultValue = 0;
        if ($this->cache->hasItem(self::CACHE_KEY)) {
            $this->resultValue = $this->cache->getItem(self::CACHE_KEY);
        }

        return $this->resultValue;
    }
}
