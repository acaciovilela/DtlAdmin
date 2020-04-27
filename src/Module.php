<?php

/**
 * @link      http://github.com/zendframework/DtlAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Laminas Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DtlAdmin;

use Laminas\Mvc\MvcEvent;
use Laminas\Router\RouteMatch as V2RouteMatch;
use Laminas\Mvc\Console\Router\RouteMatch as V3RouteMatch;

class Module {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e) {
        $em = $e->getApplication()->getEventManager();
        $em->attach('dispatch', array($this, 'changeLayout'), 1);
        $em->attach('dispatch', array($this, 'notifications'), 1);
    }

    public function changeLayout(MvcEvent $e) {
        $sm = $e->getApplication()->getServiceManager();
        $config = $sm->get('config');

        if (false === $config['dtladmin']['use_admin_layout']) {
            return;
        }

        $match = $e->getRouteMatch();

        if (!($match instanceof V2RouteMatch || $match instanceof V3RouteMatch) || 0 !== strpos($match->getMatchedRouteName(), 'dtl-admin')) {
            return;
        }

        $layout = $config['dtladmin']['admin_layout_template'];

        if (true === $e->getRequest()->isXmlHttpRequest()) {
            $layout = $config['dtladmin']['admin_layout_template_ajax'];
        }

        $viewModel = $e->getViewModel();
        $viewModel->setTemplate($layout);
    }
    
    public function notifications(MvcEvent $e) {
        $match = $e->getRouteMatch();

        if (!($match instanceof V2RouteMatch || $match instanceof V3RouteMatch) || 0 !== strpos($match->getMatchedRouteName(), 'dtl-admin')) {
            return;
        }
        
        $flashMessenger = $e->getTarget()->flashMessenger();
        
        
    }

}
