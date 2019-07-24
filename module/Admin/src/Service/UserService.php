<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:46
 */

namespace Admin\Service;


use Admin\Model\Role;
use Admin\Model\User;
use Admin\Repository\UserTableGateway;

class UserService
{

    /**
     * @var UserTableGateway
     */
    private $tableGateway;

    public function __construct(UserTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findUser($id){

        return $this->tableGateway->getUser($id);
    }

    public function findAllUser(){

        $users = $this->tableGateway->fetchAll();

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

}