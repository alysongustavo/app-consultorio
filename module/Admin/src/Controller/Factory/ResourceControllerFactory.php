<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:58
 */

namespace Admin\Controller\Factory;


use Admin\Controller\ResourceController;
use Admin\Controller\RoleController;
use Admin\Service\ResourceService;
use Admin\Service\RoleService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ResourceControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $resourceService = $container->get(ResourceService::class);
        return new ResourceController($resourceService);
    }
}