<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 24/07/2019
 * Time: 21:44
 */

namespace Admin\Repository;

use Admin\Model\Resource;
use Zend\Db\TableGateway\TableGatewayInterface;

class ResourceTableGateway
{

    /**
     * @var TableGateway
     */
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll(){

        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->columns(['id', 'module', 'controller', 'action', 'description']);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $resources = $resultSet->toArray();

        $resourcesObject = [];
        for($i = 0; $i <= count($resources) - 1; $i++){

            $resource = $resources[$i];

            $resourceArray = [
                'id' => $resource['id'],
                'module' => $resource['module'],
                'controller' => $resource['controller'],
                'action' => $resource['action'],
                'description' => $resource['description']
            ];

            $newResource = new Resource();
            $newResource->exchangeArray($resourceArray);

            $resourcesObject[] = $newResource;
        }

        return $resourcesObject;

    }

    public function getResource($id){

        $id = (int) $id;

        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->columns(['id', 'module', 'controller', 'action', 'description']);
        $sqlSelect->where(['resource.id' => $id]);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $resources = $resultSet->toArray();

        if (! $resources) {
            throw new \RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        $resourcesObject = [];
        for($i = 0; $i <= count($resources) - 1; $i++){

                $resource = $resources[$i];

                $resourceArray = [
                    'id' => $resource['id'],
                    'module' => $resource['module'],
                    'controller' => $resource['controller'],
                    'action' => $resource['action'],
                    'description' => $resource['description']
                ];

                $newResource = new Resource();
                $newResource->exchangeArray($resourceArray);

            $resourcesObject[] = $newResource;
        }

        return $resourcesObject[0];

    }
}