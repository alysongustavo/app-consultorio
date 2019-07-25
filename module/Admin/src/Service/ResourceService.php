<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 24/07/2019
 * Time: 21:54
 */

namespace Admin\Service;

use Admin\Repository\ResourceTableGateway;

class ResourceService
{

    /**
     * @var ResourceTableGateway
     */
    private $resourceTableGateway;

    public function __construct(ResourceTableGateway $resourceTableGateway)
    {
        $this->resourceTableGateway = $resourceTableGateway;
    }
    public function findResource($id){

        try{
            return $this->resourceTableGateway->getResource($id);
        }catch (\RuntimeException $exception){
            throw new ServiceException($exception->getMessage());
        }

    }

    public function findAllResources()
    {
        $resources = $this->resourceTableGateway->fetchAll();

        return $resources;
    }
}