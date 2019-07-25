<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 22:01
 */

namespace Admin\Repository\Factory;

use Admin\Model\Role;
use Admin\Repository\RoleTableGateway;
use Zend\Db\TableGateway\TableGateway;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class RoleTableGatewayFactory implements FactoryInterface
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
        $dbAdapter = $container->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Role());
        $tableGateway = new TableGateway('role', $dbAdapter, null, $resultSetPrototype);
        return new RoleTableGateway($tableGateway);
    }
}