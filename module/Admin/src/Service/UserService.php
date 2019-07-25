<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:46
 */

namespace Admin\Service;

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

        try{
            return $this->tableGateway->getUser($id);
        }catch (\RuntimeException $exception){
            throw new ServiceException($exception->getMessage());
        }

    }

    public function findAllUser(){

        $users = $this->tableGateway->fetchAll();

        return $users;


    }

}