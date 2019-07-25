<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 24/07/2019
 * Time: 21:42
 */

namespace Admin\Controller;


use Admin\Service\RoleService;
use Admin\Service\ServiceException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RoleController extends AbstractActionController
{

    /**
     * @var RoleService
     */
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function indexAction()
    {

        $roles = $this->roleService->findAllRoles();

        return new ViewModel([
            'roles' => $roles
        ]);
    }

    public function viewAction(){

        $messageError = "";

        $id = (int) $this->params()->fromRoute('id');

        if($id == 0){
            return $this->redirect()->toRoute('admin/role');
        }

        try{
            $role = $this->roleService->findRole($id);
        }catch (ServiceException $exception){
            $messageError = $exception->getMessage();
        }

        return new ViewModel([
            'role' => $role,
            'messageError' => $messageError
        ]);
    }

}