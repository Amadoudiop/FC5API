<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerSPEStats;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Playerspestat controller.
 *
 * @Route("playerspestats")
 */
class PlayerSPEStatsController extends Controller
{
    /**
     * Lists all playerSPEStat entities.
     *
     * @Route("/", name="playerspestats_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $playerSPEStats = $em->getRepository('AppBundle:PlayerSPEStats')->findAll();

        return $this->render('playerspestats/index.html.twig', array(
            'playerSPEStats' => $playerSPEStats,
        ));
    }

    /**
     * Creates a new playerSPEStat entity.
     *
     * @Route("/new", name="playerspestats_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $playerSPEStat = new Playerspestat();
        $form = $this->createForm('AppBundle\Form\PlayerSPEStatsType', $playerSPEStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($playerSPEStat);
            $em->flush();

            return $this->redirectToRoute('playerspestats_show', array('id' => $playerSPEStat->getId()));
        }

        return $this->render('playerspestats/new.html.twig', array(
            'playerSPEStat' => $playerSPEStat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a playerSPEStat entity.
     *
     * @Route("/{id}", name="playerspestats_show")
     * @Method("GET")
     */
    public function showAction(PlayerSPEStats $playerSPEStat)
    {
        $deleteForm = $this->createDeleteForm($playerSPEStat);

        return $this->render('playerspestats/show.html.twig', array(
            'playerSPEStat' => $playerSPEStat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing playerSPEStat entity.
     *
     * @Route("/{id}/edit", name="playerspestats_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlayerSPEStats $playerSPEStat)
    {
        $deleteForm = $this->createDeleteForm($playerSPEStat);
        $editForm = $this->createForm('AppBundle\Form\PlayerSPEStatsType', $playerSPEStat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('playerspestats_edit', array('id' => $playerSPEStat->getId()));
        }

        return $this->render('playerspestats/edit.html.twig', array(
            'playerSPEStat' => $playerSPEStat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a playerSPEStat entity.
     *
     * @Route("/{id}", name="playerspestats_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PlayerSPEStats $playerSPEStat)
    {
        $form = $this->createDeleteForm($playerSPEStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($playerSPEStat);
            $em->flush();
        }

        return $this->redirectToRoute('playerspestats_index');
    }

    /**
     * Creates a form to delete a playerSPEStat entity.
     *
     * @param PlayerSPEStats $playerSPEStat The playerSPEStat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PlayerSPEStats $playerSPEStat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('playerspestats_delete', array('id' => $playerSPEStat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
