<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 21:51
 */

namespace Admin\Controller;


use Admin\Service\ServiceException;
use Admin\Service\UserService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function indexAction()
    {

        $users = $this->userService->findAllUser();

        return new ViewModel([
            'users' => $users
        ]);
    }

    public function viewAction(){

        $messageError = "";

        $id = (int) $this->params()->fromRoute('id');

        if($id == 0){
            return $this->redirect()->toRoute('admin/user');
        }

        try{
            $user = $this->userService->findUser($id);
        }catch (ServiceException $exception){
            $messageError = $exception->getMessage();
        }

        return new ViewModel([
            'user' => $user,
            'messageError' => $messageError
        ]);
    }

}