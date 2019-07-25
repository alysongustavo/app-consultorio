<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:14
 */

namespace Admin\Repository;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

use Admin\Model\Role;
use Admin\Model\User;

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

        $users = $resultSet->toArray();

        $usersObject = [];
        for($i = 0; $i <= count($users) - 1; $i++){

            $chaveValor = $users[$i]['id'];

            $user = null;

            if(!array_key_exists($chaveValor, $usersObject)){

                $user = new User();

                $user->setId($users[$i]['id']);
                $user->setEmail($users[$i]['email']);
                $user->setFullName($users[$i]['fullName']);
                $user->setPassword($users[$i]['password']);
                $user->setStatus($users[$i]['status']);
                $user->setDateCreated($users[$i]['dateCreated']);
                $user->setPwdResetToken($users[$i]['pwdResetToken']);
                $user->setPwdResetTokenCreationDate($users[$i]['pwdResetTokenCreationDate']);

                $user->setRoleId($users[$i]['role_id']);
                $user->setName($users[$i]['name']);
                $user->setDescription($users[$i]['description']);
                $user->setRoleDateCreated($users[$i]['roleDateCreated']);

                $roleArray = [
                    'id' => $user->getRoleId(),
                    'name' => $user->getName(),
                    'description' => $user->getDescription(),
                    'roleDateCreated' => $user->getRoleDateCreated()
                ];

                $role = new Role();
                $role->exchangeArray($roleArray);
                $user->addRole($role);

                $usersObject[$chaveValor] = $user;

            }else{

                $userFind = $usersObject[$chaveValor];

                $roleArray = [
                    'id' => $users[$i]['role_id'],
                    'name' => $users[$i]['name'],
                    'description' => $users[$i]['description'],
                    'roleDateCreated' => $users[$i]['roleDateCreated']
                ];

                $role = new Role();
                $role->exchangeArray($roleArray);

                $userFind->addRole($role);
            }

        }

        return $usersObject;

    }

    public function getUser($id){

        $id = (int) $id;

        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->columns(['id', 'email', 'fullName' =>'full_name', 'password', 'status', 'dateCreated' => 'date_created', 'pwdResetToken' => 'pwd_reset_token', 'pwdResetTokenCreationDate' => 'pwd_reset_token_creation_date']);
        $sqlSelect->join('user_role', 'user.id = user_role.user_id');
        $sqlSelect->join('role', 'user_role.role_id = role.id', ['role_id' => 'id', 'name', 'description', 'roleDateCreated' => 'date_created']);
        $sqlSelect->where(['user.id' => $id, 'user.status' => 1]);

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        $users = $resultSet->toArray();

        if (! $users) {
            throw new \RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }


        $usersObject = [];
        for($i = 0; $i <= count($users) - 1; $i++){

            $chaveValor = $users[$i]['id'];

            $user = null;

            if(!array_key_exists($chaveValor, $usersObject)){

                $user = new User();

                $user->setId($users[$i]['id']);
                $user->setEmail($users[$i]['email']);
                $user->setFullName($users[$i]['fullName']);
                $user->setPassword($users[$i]['password']);
                $user->setStatus($users[$i]['status']);
                $user->setDateCreated($users[$i]['dateCreated']);
                $user->setPwdResetToken($users[$i]['pwdResetToken']);
                $user->setPwdResetTokenCreationDate($users[$i]['pwdResetTokenCreationDate']);

                $user->setRoleId($users[$i]['role_id']);
                $user->setName($users[$i]['name']);
                $user->setDescription($users[$i]['description']);
                $user->setRoleDateCreated($users[$i]['roleDateCreated']);

                $roleArray = [
                    'id' => $user->getRoleId(),
                    'name' => $user->getName(),
                    'description' => $user->getDescription(),
                    'roleDateCreated' => $user->getRoleDateCreated()
                ];

                $user->setRolesString($user->getName());

                $role = new Role();
                $role->exchangeArray($roleArray);
                $user->addRole($role);

                $usersObject[$chaveValor] = $user;

            }else{

                $userFind = $usersObject[$chaveValor];

                $userFind->setRolesString($users[$i]['name']);

                $roleArray = [
                    'id' => $users[$i]['role_id'],
                    'name' => $users[$i]['name'],
                    'description' => $users[$i]['description'],
                    'roleDateCreated' => $users[$i]['roleDateCreated']
                ];

                $role = new Role();
                $role->exchangeArray($roleArray);

                $userFind->addRole($role);
            }

        }

        return $usersObject[$id];

    }
}