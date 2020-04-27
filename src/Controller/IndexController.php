<?php

namespace DtlAdmin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function indexAction() {
        return new ViewModel();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager {
        return $this->entityManager;
    }

    /**
     * 
     * @param EntityManager $entityManager
     * @return $this
     */
    public function setEntityManager(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

}
