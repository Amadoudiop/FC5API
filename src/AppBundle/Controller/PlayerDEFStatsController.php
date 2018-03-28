<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerDEFStats;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Playerdefstat controller.
 *
 * @Route("playerdefstats")
 */
class PlayerDEFStatsController extends Controller
{
    /**
     * Lists all playerDEFStat entities.
     *
     * @Route("/", name="playerdefstats_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $playerDEFStats = $em->getRepository('AppBundle:PlayerDEFStats')->findAll();

        return $this->render('playerdefstats/index.html.twig', array(
            'playerDEFStats' => $playerDEFStats,
        ));
    }

    /**
     * Creates a new playerDEFStat entity.
     *
     * @Route("/new", name="playerdefstats_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $playerDEFStat = new Playerdefstat();
        $form = $this->createForm('AppBundle\Form\PlayerDEFStatsType', $playerDEFStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($playerDEFStat);
            $em->flush();

            return $this->redirectToRoute('playerdefstats_show', array('id' => $playerDEFStat->getId()));
        }

        return $this->render('playerdefstats/new.html.twig', array(
            'playerDEFStat' => $playerDEFStat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a playerDEFStat entity.
     *
     * @Route("/{id}", name="playerdefstats_show")
     * @Method("GET")
     */
    public function showAction(PlayerDEFStats $playerDEFStat)
    {
        $deleteForm = $this->createDeleteForm($playerDEFStat);

        return $this->render('playerdefstats/show.html.twig', array(
            'playerDEFStat' => $playerDEFStat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing playerDEFStat entity.
     *
     * @Route("/{id}/edit", name="playerdefstats_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlayerDEFStats $playerDEFStat)
    {
        $deleteForm = $this->createDeleteForm($playerDEFStat);
        $editForm = $this->createForm('AppBundle\Form\PlayerDEFStatsType', $playerDEFStat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('playerdefstats_edit', array('id' => $playerDEFStat->getId()));
        }

        return $this->render('playerdefstats/edit.html.twig', array(
            'playerDEFStat' => $playerDEFStat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a playerDEFStat entity.
     *
     * @Route("/{id}", name="playerdefstats_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PlayerDEFStats $playerDEFStat)
    {
        $form = $this->createDeleteForm($playerDEFStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($playerDEFStat);
            $em->flush();
        }

        return $this->redirectToRoute('playerdefstats_index');
    }

    /**
     * Creates a form to delete a playerDEFStat entity.
     *
     * @param PlayerDEFStats $playerDEFStat The playerDEFStat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PlayerDEFStats $playerDEFStat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('playerdefstats_delete', array('id' => $playerDEFStat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
