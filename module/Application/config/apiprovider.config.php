<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date   16.11.2016 19:48
 */

namespace Application;

use Application\Service\Api\CbrApiService;
use Application\Service\Api\YahooApiService;

return [
    [
        // source url
        'link'  => 'http://www.cbr.ru/scripts/XML_daily.asp',

        // source order
        'order' => 1,

        // api data provider
        'api' => CbrApiService::class,

    ],

    [
        'link' => 'https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+%22USDRUB,EURRUB%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback',
        'order' => 2,
        'api' => YahooApiService::class,
    ]
];
