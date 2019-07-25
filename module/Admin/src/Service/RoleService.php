<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 24/07/2019
 * Time: 21:54
 */

namespace Admin\Service;

use Admin\Repository\RoleTableGateway;

class RoleService
{

    /**
     * @var RoleTableGateway
     */
    private $roleTableGateway;

    public function __construct(RoleTableGateway $roleTableGateway)
    {
        $this->roleTableGateway = $roleTableGateway;
    }
    public function findRole($id){

        try{
            return $this->roleTableGateway->getRole($id);
        }catch (\RuntimeException $exception){
            throw new ServiceException($exception->getMessage());
        }

    }

    public function findAllRoles()
    {
        $roles = $this->roleTableGateway->fetchAll();

        return $roles;
    }
}