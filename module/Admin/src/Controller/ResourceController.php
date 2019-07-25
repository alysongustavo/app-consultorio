<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 24/07/2019
 * Time: 21:42
 */

namespace Admin\Controller;


use Admin\Service\ResourceService;
use Admin\Service\ServiceException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ResourceController extends AbstractActionController
{

    /**
     * @var ResourceService
     */
    private $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function indexAction()
    {

        $resources = $this->resourceService->findAllResources();

        return new ViewModel([
            'resources' => $resources
        ]);
    }

    public function viewAction(){

        $messageError = "";

        $id = (int) $this->params()->fromRoute('id');

        if($id == 0){
            return $this->redirect()->toRoute('admin/resource');
        }

        try{
            $resource = $this->resourceService->findResource($id);
        }catch (ServiceException $exception){
            $messageError = $exception->getMessage();
        }

        return new ViewModel([
            'resource' => $resource,
            'messageError' => $messageError
        ]);
    }

}