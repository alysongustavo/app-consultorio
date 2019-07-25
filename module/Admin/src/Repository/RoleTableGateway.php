<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 24/07/2019
 * Time: 21:44
 */

namespace Admin\Repository;

use Admin\Model\Role;
use Zend\Db\TableGateway\TableGatewayInterface;

class RoleTableGateway
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
        $sqlSelect->columns(['id', 'name', 'description', 'date_created']);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $roles = $resultSet->toArray();

        $rolesObject = [];
        for($i = 0; $i <= count($roles) - 1; $i++){

            $role = $roles[$i];

            $roleArray = [
                'id' => $role['id'],
                'name' => $role['name'],
                'description' => $role['description'],
                'dateCreated' => $role['dateCreated'],
            ];

            $newRole = new Role();
            $newRole->exchangeArray($roleArray);

            $rolesObject[] = $newRole;
        }

        return $rolesObject;

    }

    public function getRole($id){

        $id = (int) $id;

        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->columns(['id', 'name', 'description', 'date_created']);
        $sqlSelect->where(['role.id' => $id]);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $roles = $resultSet->toArray();

        if (! $roles) {
            throw new \RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        $rolesObject = [];
        for($i = 0; $i <= count($roles) - 1; $i++){

                $role = $roles[$i];

                $roleArray = [
                    'id' => $role['id'],
                    'name' => $role['name'],
                    'description' => $role['description'],
                    'dateCreated' => $role['dateCreated']
                ];

                $role = new Role();
                $role->exchangeArray($roleArray);

                $rolesObject[] = $role;
        }

        return $rolesObject[0];

    }
}