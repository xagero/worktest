<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Service\ApiService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 *
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    /** @var  ApiService */
    protected $apiService;

    /**
     * @return ApiService
     */
    public function getApiService(): ApiService
    {
        return $this->apiService;
    }

    /**
     * @param ApiService $apiService
     */
    public function setApiService(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Process index Action
     */
    public function indexAction()
    {
        $this->apiService->init();

        $view = new ViewModel([
            'api' => $this->apiService
        ]);

        return $view;
    }
}
