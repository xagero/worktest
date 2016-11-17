<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date   16.11.2016 19:14
 */

namespace Application\Service\Api;

/**
 * Interface ApiInterface
 *
 * @package Application\Service\Api
 */
interface ApiInterface
{
    /**
     * @param $data
     *
     * @return mixed
     */
    public function fetchResult($data);
}