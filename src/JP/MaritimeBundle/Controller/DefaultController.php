<?php

namespace JP\MaritimeBundle\Controller;

use JP\MainBundle\Entity\Document;
use JP\MaritimeBundle\Entity\Folder;
use JP\MaritimeBundle\Entity\Step;
use JP\MaritimeBundle\Entity\NumOrder;


use JP\FinanceBundle\Entity\Facture;
use JP\MaritimeBundle\Entity\Affectation;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Workflow\Exception\ExceptionInterface;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;

use Symfony\Component\HttpFoundation\File\File;


class DefaultController extends Controller
{
    // Afficher du dashboard du module maritime

    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

     if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
          $folders = $em->getRepository('JPMaritimeBundle:Folder')->findAll();
      }else{
         $folders = $em->getRepository('JPMaritimeBundle:Folder')->getFolderByOwnerOrAffected($user) ;
      }
        return $this->render('JPMaritimeBundle:Default:home.html.twig', array(
            'folders' => $folders,
            
        ));
    }

    /**
     * Creer un nouveau Dossier.
     *
     */
    public function newAction(Request $request)
    {   
        $user = $this->getUser();
        $folder = new Folder();
        $form = $this->createForm('JP\MaritimeBundle\Form\FolderType', $folder);
        $form->handleRequest($request);

        
        $m =date('m');   


        if ($form->isSubmitted() && $form->isValid()) {

           
          $em = $this->getDoctrine()->getManager();

            $folder->setCreateBy($user);  
            $folder->setFolderNumber($this->FolderNumber($folder->getFtype()));
            $folder->setOwner($user);
            $em->persist($folder);

        // debut de la Creation d'un dossier physique sur le Disque
            $FolderDir = $this->GetRootDir().'/'.$this->FolderNumber($folder->getFtype()) ;
            if (!file_exists($FolderDir)) {
                          mkdir($FolderDir, 0775, true);
                }
        // ******************Fin de la Création**********************

            $order = new NumOrder();
            $order->setMonth($m);
            $order->setOrder($this->Order());
            $em->persist($order);

            $em->flush();

            return $this->redirectToRoute('jp_maritime_showpage', array('id' => $folder->getId()));
        }

          return $this->render('JPMaritimeBundle:Dossiers:new.html.twig', array(
            'folder' => $folder,
            'form' => $form->createView(),
            'm' => $this->FolderNumber('??') ,
            
        ));
    }

    /**
     * 
     *  Editer un dossier
     */

     public function editAction(Request $request, Folder $folder)
    {
       
        $editForm = $this->createForm('JP\MaritimeBundle\Form\FolderEditType', $folder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jp_maritime_showpage', array('id' => $folder->getId()));
        }

        return $this->render('JPMaritimeBundle:Dossiers:edit.html.twig', array(
            'folder' => $folder,
            'edit_form' => $editForm->createView(),
            
        ));
    }

     /**
      * Afficher les details d'un dossier
      *  
      */

     public function detailsDossierAction(Folder $folder)
    {   

        
        $em = $this->getDoctrine()->getManager();
      
        $step = $em->getRepository('JPMaritimeBundle:Step')->findByFolder($folder);
        $affectation = $em->getRepository('JPMaritimeBundle:Affectation')->findByFolder($folder);

       
        return $this->render('JPMaritimeBundle:Dossiers:details.html.twig', array(
            'folder'    =>  $folder,           
            'steps'     =>  $step,
            'affectations'     =>  $affectation,
         
           
        ));
    }
 public function affecterDossierAction(Request $request, Folder $folder)
    {   

        $affectation = new Affectation();
        $form = $this->createForm('JP\MaritimeBundle\Form\AffectationType', $affectation);
         $form->handleRequest($request);

        
        $em = $this->getDoctrine()->getManager();
      
        $step = $em->getRepository('JPMaritimeBundle:Step')->findByFolder($folder);

         if ($form->isSubmitted() && $form->isValid()) {

            $affectation->setFolder($folder);
            $em->persist($affectation);
            $em->flush();

          return $this->redirectToRoute('jp_maritime_showpage', array('id' => $folder->getId()));
        }

       
        return $this->render('JPMaritimeBundle:Dossiers:affecter.html.twig', array(
            'folder'    =>  $folder,           
            'steps'     =>  $step,
            'form'      =>  $form->createView(),        
        ));
    }

    public function expertiseAction(Folder $folder)
    {   

        $facture = new Facture();
        $form = $this->createForm('JP\FinanceBundle\Form\FactureType', $facture);
        
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('JPMainBundle:Document')->findByFolder($folder);
        $step = $em->getRepository('JPMaritimeBundle:Step')->findByFolder($folder);

        $fac= $em->getRepository('JPFinanceBundle:Facture')->findByFolder($folder);
       
        return $this->render('JPMaritimeBundle:Dossiers:expertise.html.twig', array(
            'folder'    =>  $folder,
            'files'     =>  $files,
            'steps'     =>  $step,
            'facture' => $fac,
            'form' => $form->createView(),
           
        ));
    }

public function addFactureAction(Request $request, Folder $folder)
    {    $facture = new Facture();
         $form = $this->createForm('JP\FinanceBundle\Form\FactureType', $facture);
         $form->handleRequest($request);
        
 if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            $em = $this->getDoctrine()->getManager();

            $facture->setFolder($folder);
            $facture->setCreateBy($user);
            $em->persist($facture);
            $em->flush();
 
        $response['success'] = true;
 
      }else{
 
        $response['success'] = false;
        $response['cause'] = 'whatever';
 
      }
 
      return new JsonResponse( $response );
   
  }


/**
  * Enregistrer les fichiers du workflow 
  *  
  */

     public function expertiseSendFileAction(Request $request , Folder $folder)
    {
        $em = $this->getDoctrine()->getManager();
        
        $document = new Document();
        $media = $request->files->get('file'); 
        $FolderDir = $this->GetRootDir().$folder->getFolderNumber() ;       
       
            $document->setFile($media);
            $document->setPath($media->getPathName());
            $document->setName($media->getClientOriginalName());
            $document->setStep($request->attributes->get('step'));
            $document->setFolder($folder);
           // $document->upload();

           $document->getFile()->move($FolderDir, $document->getName());
          

            $em->persist($document);
            $em->flush();

        //infos sur le document envoyé
        //var_dump($request->files->get('file'));die;
        return new JsonResponse(array('success' => true));


    }

    
     /**
      * 
      * Enregister les transition du workflow de gestion des dossier 
      */

     public function applyTransitionAction(Request $request, Folder $folder)
    {    
         $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        try {
                $this->get('state_machine.folder')
                     ->apply($folder, $request->request->get('transition'));
              //  $em->flush();

                $step = new Step();
                $step->setUser($user);
                $step->setFolder($folder);
                $step->setStep($request->request->get('transition'));
                $em->persist($step);

                $em->flush();


        } catch (ExceptionInterface $e) {
                $this->get('session')->getFlashBag()->add('danger', $e->getMessage());
            }

            return $this->redirect(
                $this->generateUrl('jp_maritime_expertisepage', ['id' => $folder->getId()])
            );
    }

     public function backPreviousStepAction(Request $request, Folder $folder)
    {    
               
                $em = $this->getDoctrine()->getManager();

                $folder->setMarking($request->request->get('back'));
                $em->flush();

           /*    $user = $this->getUser();
             
                $step = new Step();
                $step->setUser($user);
                $step->setFolder($folder);
                $step->setStep($request->request->get('back'));
                $em->persist($step);
   
                $em->flush();     */   

            return $this->redirect(
                $this->generateUrl('jp_maritime_expertisepage', ['id' => $folder->getId()])
            );
    }


    

     public function redactionAction()
    {
        return $this->render('JPMaritimeBundle:Dossiers:new.html.twig');
    }


    public function ficheAction(Folder $folder)
    {
           
 
            $html = $this->renderView('JPMaritimeBundle:Dossiers:fiche.html.twig', array(
               'folder' => $folder,
            ));

            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="Myfile.pdf"'
                )
            );

        }

    //Afficher un document
    public function displayFileAction(Folder $folder, $doc ) {

    $publicResourcesFolderPath = $this->GetRootDir().$folder->getFolderNumber().'/';
   

        // This should return the file located in /mySymfonyProject/web/public-resources/TextFile.txt
        // to being viewed in the Browser
        return new BinaryFileResponse($publicResourcesFolderPath.$doc);
    
    }

//Telecharger un document
  public function downloadFileAction(Folder $folder, $doc ) {
   
    $publicResourcesFolderPath = $this->GetRootDir().$folder->getFolderNumber().'/';
   
    // load the file from the filesystem
    $file = new File($publicResourcesFolderPath.$doc);

    return $this->file($file);
}
 

  /**
  * Generer un numero de dossier
  *  
  */

    protected function FolderNumber($type){
            $y = date('y/m');   
        $count = strlen((string)$this->Order());
                    switch ($count) {
                        case 1:
                            $zero = '0';                            
                            break;
                        case 2:
                            $zero = '';
                            break;                        
                        }

        $orderNumber = '20/'.$y.$zero.$this->Order().'/'.$type;

        return $orderNumber ;

    }

     /**
      * Generer un numero d'ordre de dossier
      *  
      */

    protected function Order(){
         $nombre = $this->container->get('setOrderNumber')->OrderNumber();
          return $nombre ;
    }

    /**
      * Recuperer le chemin racine d'enregistrement de dossier
      *  
      */
    protected function GetRootDir(){
        return   __DIR__.'/../../../../web/uploads/';
         
    }
}
