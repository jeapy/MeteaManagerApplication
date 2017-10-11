<?php

namespace JP\MaritimeBundle\Controller;

use JP\MaritimeBundle\Entity\Folder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Folder controller.
 *
 */
class FolderController extends Controller
{
    /**
     * Lists all folder entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $folders = $em->getRepository('JPMaritimeBundle:Folder')->findAll();

        return $this->render('folder/index.html.twig', array(
            'folders' => $folders,
        ));
    }

    /**
     * Creates a new folder entity.
     *
     */
    public function newAction(Request $request)
    {
        $folder = new Folder();
        $form = $this->createForm('JP\MaritimeBundle\Form\FolderType', $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            return $this->redirectToRoute('folder_show', array('id' => $folder->getId()));
        }

        return $this->render('folder/new.html.twig', array(
            'folder' => $folder,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a folder entity.
     *
     */
    public function showAction(Folder $folder)
    {
        $deleteForm = $this->createDeleteForm($folder);

        return $this->render('folder/show.html.twig', array(
            'folder' => $folder,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing folder entity.
     *
     */
    public function editAction(Request $request, Folder $folder)
    {
        $deleteForm = $this->createDeleteForm($folder);
        $editForm = $this->createForm('JP\MaritimeBundle\Form\FolderType', $folder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('folder_edit', array('id' => $folder->getId()));
        }

        return $this->render('folder/edit.html.twig', array(
            'folder' => $folder,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a folder entity.
     *
     */
    public function deleteAction(Request $request, Folder $folder)
    {
        $form = $this->createDeleteForm($folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($folder);
            $em->flush();
        }

        return $this->redirectToRoute('folder_index');
    }

    /**
     * Creates a form to delete a folder entity.
     *
     * @param Folder $folder The folder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Folder $folder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('folder_delete', array('id' => $folder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
