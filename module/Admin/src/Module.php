<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 23/07/2019
 * Time: 20:21
 */

namespace Admin;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface, InitProviderInterface
{

    /**
     * Initialize workflow
     *
     * @param  ModuleManagerInterface $manager
     * @return void
     */
      public function init(ModuleManagerInterface $manager)
      {
          $eventManager = $manager->getEventManager();
          $sharedEventManager = $eventManager->getSharedManager();

          $sharedEventManager->attach(__NAMESPACE__,
              MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'] , 100);
      }

      public function onDispatch(MvcEvent $mvcEvent)
      {
          $controller = $mvcEvent->getTarget();

          $controllerClass = get_class($controller);
          $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

          // Switch layout only for controllers belonging to our module.
          if ($moduleNamespace == __NAMESPACE__) {
              $viewModel = $mvcEvent->getViewModel();
              $viewModel->setTemplate('layout/admin');
          }
      }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}