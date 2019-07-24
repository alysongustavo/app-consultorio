<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:12
 */

namespace Admin\Model;


class Permission
{

    private $id;

    private $role;

    private $resource;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Permission
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return Permission
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param mixed $resource
     * @return Permission
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    public function exchangeArray(array $data)
    {
        $this->id= !empty($data['id']) ? $data['id'] : null;
        $this->role= !empty($data['role']) ? $data['role'] : null;
        $this->resource= !empty($data['resource']) ? $data['resource'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }





}