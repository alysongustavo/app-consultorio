<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:08
 */

namespace Admin\Model;


class Role
{

    private $role_id;

    private $name;

    private $description;

    private $dateCreated;

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     * @return Role
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Role
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     * @return Role
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    public function exchangeArray(array $data)
    {
        $this->role_id = !empty($data['id']) ? $data['id'] : null;
        $this->name= !empty($data['name']) ? $data['name'] : null;
        $this->description= !empty($data['description']) ? $data['description'] : null;
        $this->dateCreated= !empty($data['dateCreated']) ? $data['dateCreated'] : null;

    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


}