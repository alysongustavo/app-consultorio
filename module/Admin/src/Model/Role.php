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

    private $id;

    private $name;

    private $description;

    private $dateCreated;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Role
     */
    public function setId($id)
    {
        $this->id = $id;
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
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name= !empty($data['name']) ? $data['name'] : null;
        $this->description= !empty($data['description']) ? $data['description'] : null;
        $this->dateCreated= !empty($data['dateCreated']) ? $data['dateCreated'] : null;

    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


}