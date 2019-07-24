<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:05
 */

namespace Admin\Model;

class User
{

    private $id;

    private $email;

    private $fullName;

    private $password;

    private $status;

    private $dateCreated;

    private $pwdResetToken;

    private $pwdResetTokenCreationDate;

    private $roles = [];

    // Info role
    private $role_id;

    private $name;

    private $description;

    private $roleDateCreated;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return User
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPwdResetToken()
    {
        return $this->pwdResetToken;
    }

    /**
     * @param mixed $pwdResetToken
     * @return User
     */
    public function setPwdResetToken($pwdResetToken)
    {
        $this->pwdResetToken = $pwdResetToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPwdResetTokenCreationDate()
    {
        return $this->pwdResetTokenCreationDate;
    }

    /**
     * @param mixed $pwdResetTokenCreationDate
     * @return User
     */
    public function setPwdResetTokenCreationDate($pwdResetTokenCreationDate)
    {
        $this->pwdResetTokenCreationDate = $pwdResetTokenCreationDate;
        return $this;
    }

    /**
     * @return array
     */
    public function addRole(Role $role)
    {
        return $this->roles[] = $role;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    // Info Role
    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     * @return User
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
     * @return User
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
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoleDateCreated()
    {
        return $this->roleDateCreated;
    }

    /**
     * @param mixed $roleDateCreated
     * @return User
     */
    public function setRoleDateCreated($roleDateCreated)
    {
        $this->roleDateCreated = $roleDateCreated;
        return $this;
    }



    public function exchangeArray(array $data)
    {
        $this->id= !empty($data['id']) ? $data['id'] : null;
        $this->email= !empty($data['email']) ? $data['email'] : null;
        $this->fullName= !empty($data['fullName']) ? $data['fullName'] : null;
        $this->password= !empty($data['password']) ? $data['password'] : null;
        $this->status= !empty($data['status']) ? $data['status'] : null;
        $this->dateCreated= !empty($data['dateCreated']) ? $data['dateCreated'] : null;
        $this->status= !empty($data['status']) ? $data['status'] : null;
        $this->dateCreated= !empty($data['dateCreated']) ? $data['dateCreated'] : null;
        $this->pwdResetToken= !empty($data['pwdResetToken']) ? $data['pwdResetToken'] : null;
        $this->pwdResetTokenCreationDate= !empty($data['pwdResetTokenCreationDate']) ? $data['pwdResetTokenCreationDate'] : null;
        $this->roles= !empty($data['roles']) ? $data['roles'] : null;

        // INFO ROLE
        $this->role_id= !empty($data['role_id']) ? $data['role_id'] : null;
        $this->name= !empty($data['name']) ? $data['name'] : null;
        $this->description= !empty($data['description']) ? $data['description'] : null;
        $this->roleDateCreated= !empty($data['roleDateCreated']) ? $data['roleDateCreated'] : null;

    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


}