<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date   16.11.2016 19:46
 */

namespace Application\Factory\Service;

use Application\Service\ApiService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\Cache\StorageFactory;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ApiServiceFactory
 *
 * @package Application\Factory\Service
 */
class ApiServiceFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return ApiService
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = new ApiService();
        $service->setConfigArray($container->get('config')['module/application/data']);

        /** @var Filesystem $cache */
        $cache = StorageFactory::factory($container->get('config')['module/application/cache']);
        $service->setCache($cache);

        return $service;
    }
}
