<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date   16.11.2016 19:09
 */

namespace Application\Service\Api;

use Throwable;

/**
 * Class YahooApiService
 *
 * @package Application\Service\Api
 */
class YahooApiService implements ApiInterface
{

    /**
     * @param $data
     *
     * @return mixed
     */
    public function fetchResult($data)
    {
        $result = null;

        try {

            $decoded = json_decode($data, true);

            if (isset($decoded['query']['results']['rate'])) foreach ($decoded['query']['results']['rate'] as $item) {

                if (!array_key_exists('id', $item)) {
                    continue;
                }

                if ('USDRUB' == $item['id']) {
                    $result = $item['Rate'];
                    break;
                }
            }

        } catch (Throwable $e) {

        }

        return $result;
    }
}