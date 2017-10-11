<?php
namespace JP\MaritimeBundle\Services;

// don't forget the namespaces too !
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;

// This will be the name of the class and the file
class MyService
{
    protected $em;
    private $container;
    
    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager, Container $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }
    
    public function OrderNumber()
    {   $now = date('m');
        $order = $this->em->getRepository('JPMaritimeBundle:NumOrder')->findOneOrder(1);
        
        if (!$order || $order[0]->getMonth() !=  $now)
            return 1;
        else
            return $order[0]->getOrder() +1 ; 
    }
}