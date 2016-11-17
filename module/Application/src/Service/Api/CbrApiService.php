<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date   16.11.2016 19:09
 */

namespace Application\Service\Api;

use SimpleXMLElement;
use Throwable;

/**
 * Class CbrApiService
 *
 * @package Application\Service\Api
 */
class CbrApiService implements ApiInterface
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
            $xml = new SimpleXMLElement($data);

            foreach ($xml as $value) {

                if ('USD' == $value->{'CharCode'}) {
                    $result = ($value->{'Value'});
                    break;
                }
            }

        } catch (Throwable $e) {

        }

        return $result;
    }
}
