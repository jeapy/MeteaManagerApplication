<?php

namespace JP\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
 
use SocketIO\Emitter;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JPMainBundle:Default:index.html.twig');
    }

    public function dashboardAction()
    {
        return $this->render('JPMainBundle:Default:dashboard.html.twig');
    }


    public function notifAction(Request $request)
    {
        $notification = 'A message has been received by the server!<br />';
 
        // Handling form    
        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);
 
        // If form valid
        if ($form->isValid()) {
 
            // Calling PHP Redis from global namespace
            $redis = new \Redis();
 
            // Connecting on localhost and port 6379
            $redis->connect('127.0.0.1', '6379');
 
            // Creating Emitter
            $emitter = new Emitter($redis);
 
            // Emit a notification on channel 'notification'
            $emitter->emit('notification', $notification);
 
            // Returning status via JsonResponse
            $response = new JsonResponse(array('notification' => $notification));
           
 
            return $response;
 
        }
 
        return $this->render('JPMainBundle:Default:notif.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
