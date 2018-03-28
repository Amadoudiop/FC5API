<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerATKStats;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Playeratkstat controller.
 *
 * @Route("playeratkstats")
 */
class PlayerATKStatsController extends Controller
{
    /**
     * Lists all playerATKStat entities.
     *
     * @Route("/", name="playeratkstats_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $playerATKStats = $em->getRepository('AppBundle:PlayerATKStats')->findAll();

        return $this->render('playeratkstats/index.html.twig', array(
            'playerATKStats' => $playerATKStats,
        ));
    }

    /**
     * Creates a new playerATKStat entity.
     *
     * @Route("/new", name="playeratkstats_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $playerATKStat = new Playeratkstat();
        $form = $this->createForm('AppBundle\Form\PlayerATKStatsType', $playerATKStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($playerATKStat);
            $em->flush();

            return $this->redirectToRoute('playeratkstats_show', array('id' => $playerATKStat->getId()));
        }

        return $this->render('playeratkstats/new.html.twig', array(
            'playerATKStat' => $playerATKStat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a playerATKStat entity.
     *
     * @Route("/{id}", name="playeratkstats_show")
     * @Method("GET")
     */
    public function showAction(PlayerATKStats $playerATKStat)
    {
        $deleteForm = $this->createDeleteForm($playerATKStat);

        return $this->render('playeratkstats/show.html.twig', array(
            'playerATKStat' => $playerATKStat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing playerATKStat entity.
     *
     * @Route("/{id}/edit", name="playeratkstats_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlayerATKStats $playerATKStat)
    {
        $deleteForm = $this->createDeleteForm($playerATKStat);
        $editForm = $this->createForm('AppBundle\Form\PlayerATKStatsType', $playerATKStat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('playeratkstats_edit', array('id' => $playerATKStat->getId()));
        }

        return $this->render('playeratkstats/edit.html.twig', array(
            'playerATKStat' => $playerATKStat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a playerATKStat entity.
     *
     * @Route("/{id}", name="playeratkstats_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PlayerATKStats $playerATKStat)
    {
        $form = $this->createDeleteForm($playerATKStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($playerATKStat);
            $em->flush();
        }

        return $this->redirectToRoute('playeratkstats_index');
    }

    /**
     * Creates a form to delete a playerATKStat entity.
     *
     * @param PlayerATKStats $playerATKStat The playerATKStat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PlayerATKStats $playerATKStat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('playeratkstats_delete', array('id' => $playerATKStat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
