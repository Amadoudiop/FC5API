<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerGKStats;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Playergkstat controller.
 *
 * @Route("playergkstats")
 */
class PlayerGKStatsController extends Controller
{
    /**
     * Lists all playerGKStat entities.
     *
     * @Route("/", name="playergkstats_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $playerGKStats = $em->getRepository('AppBundle:PlayerGKStats')->findAll();

        return $this->render('playergkstats/index.html.twig', array(
            'playerGKStats' => $playerGKStats,
        ));
    }

    /**
     * Creates a new playerGKStat entity.
     *
     * @Route("/new", name="playergkstats_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $playerGKStat = new Playergkstat();
        $form = $this->createForm('AppBundle\Form\PlayerGKStatsType', $playerGKStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($playerGKStat);
            $em->flush();

            return $this->redirectToRoute('playergkstats_show', array('id' => $playerGKStat->getId()));
        }

        return $this->render('playergkstats/new.html.twig', array(
            'playerGKStat' => $playerGKStat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a playerGKStat entity.
     *
     * @Route("/{id}", name="playergkstats_show")
     * @Method("GET")
     */
    public function showAction(PlayerGKStats $playerGKStat)
    {
        $deleteForm = $this->createDeleteForm($playerGKStat);

        return $this->render('playergkstats/show.html.twig', array(
            'playerGKStat' => $playerGKStat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing playerGKStat entity.
     *
     * @Route("/{id}/edit", name="playergkstats_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlayerGKStats $playerGKStat)
    {
        $deleteForm = $this->createDeleteForm($playerGKStat);
        $editForm = $this->createForm('AppBundle\Form\PlayerGKStatsType', $playerGKStat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('playergkstats_edit', array('id' => $playerGKStat->getId()));
        }

        return $this->render('playergkstats/edit.html.twig', array(
            'playerGKStat' => $playerGKStat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a playerGKStat entity.
     *
     * @Route("/{id}", name="playergkstats_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PlayerGKStats $playerGKStat)
    {
        $form = $this->createDeleteForm($playerGKStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($playerGKStat);
            $em->flush();
        }

        return $this->redirectToRoute('playergkstats_index');
    }

    /**
     * Creates a form to delete a playerGKStat entity.
     *
     * @param PlayerGKStats $playerGKStat The playerGKStat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PlayerGKStats $playerGKStat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('playergkstats_delete', array('id' => $playerGKStat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
