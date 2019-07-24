<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:14
 */

namespace Admin\Repository;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

class UserTableGateway
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
        $sqlSelect->columns(['id', 'email', 'fullName' =>'full_name', 'password', 'status', 'dateCreated' => 'date_created', 'pwdResetToken' => 'pwd_reset_token', 'pwdResetTokenCreationDate' => 'pwd_reset_token_creation_date']);
        $sqlSelect->join('user_role', 'user.id = user_role.user_id');
        $sqlSelect->join('role', 'user_role.role_id = role.id', ['role_id' => 'id', 'name', 'description', 'roleDateCreated' => 'date_created']);
        $sqlSelect->where("user.status = 1");

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        return $resultSet->toArray();

    }

    public function getUser($id){

        $id = (int) $id;

        $select = $this->tableGateway->getSql()->select();
        $select->columns(['user_id' =>  'id', 'email', 'full_name', 'password', 'status', 'date_created', 'pwd_reset_token', 'pwd_reset_token_creation_date']);
        $select->join('user_role', 'user.id = user_role.user_id');
        $select->join('role', 'user_role.role_id = role.id', ['role_id' => 'id', 'name', 'description', 'date_created']);
        $select->where(['user.id' => $id]);

        $resultSet = $this->tableGateway->selectWith($select);

        $row = $resultSet->current();

        if (! $row) {
            throw new \RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;

    }
}