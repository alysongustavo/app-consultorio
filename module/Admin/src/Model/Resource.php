<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:10
 */

namespace Admin\Model;


class Resource
{
    private $id;

    private $controller;

    private $action;

    private $description;

    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Resource
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     * @return Resource
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     * @return Resource
     */
    public function setAction($action)
    {
        $this->action = $action;
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
     * @return Resource
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Resource
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function exchangeArray(array $data)
    {
        $this->id= !empty($data['id']) ? $data['id'] : null;
        $this->controller= !empty($data['controller']) ? $data['controller'] : null;
        $this->action= !empty($data['action']) ? $data['action'] : null;
        $this->description= !empty($data['description']) ? $data['description'] : null;
        $this->status= !empty($data['status']) ? $data['status'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


}