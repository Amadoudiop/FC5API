<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;
use Exception;

/**
 * Player controller.
 *
 * @Route("api/player")
 */
class PlayerController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="playerList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Players with orders, pagination and research",
     *  section="Player",
     *
     *  parameters={
     *      {"name"="orders", "dataType"="array", "required"=false, "format"="[ ['name', 'desc'] ]"},
     *      {"name"="page", "dataType"="integer", "required"=false, "description"="Page number (1 by default)"},
     *      {"name"="perPage", "dataType"="integer", "required"=true, "description"="Items per page send if you want all of them -1"},
     *      {"name"="search", "dataType"="string", "required"=false, "description"="Search on multiple columns"}
     *  }
     * )
     */
    public function listAction()
    {
        return new ApiResponse(
            $this->get('fc5.entities_list_handler')
                ->handleList(
                    'AppBundle\Entity\Player',
                    [
                        'id',
                        'commonName',
                        'lastName',
                        'firstName',
                        'height',
                        'weight',
                        'birthDate',
                        'age',
                        'foot',
                        'weakFoot',
                        'isGK',
                        'image',
                        'realClub',
                        'composure',
                        'potential',
                        'rating',
                    ]
                )
                ->getResults()
        );
    }



    /**
     * Get a player by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     * @ApiDoc(
     *     description="get player",
     *     section="Player"
     * )serializeEntity
     *
     * @Route("/{id}", name="getPlayer")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Player');
        $player = $repository->findOneById($request->get('id'));
        if (empty($player)) {
            return new ApiResponse(null, 404, ['Player not found']);
        } else {
            return new ApiResponse(
                $player->serializeEntity()
            );
        }
    }










    /**
     * Creates a new player entity.
     *
     * @Route("/new", name="player_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $player = new Player();
        $form = $this->createForm('AppBundle\Form\PlayerType', $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('player_show', array('id' => $player->getId()));
        }

        return $this->render('player/new.html.twig', array(
            'player' => $player,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a player entity.
     *
     * @Route("/{id}", name="player_show")
     * @Method("GET")
     */
    public function showAction(Player $player)
    {
        $deleteForm = $this->createDeleteForm($player);

        return $this->render('player/show.html.twig', array(
            'player' => $player,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing player entity.
     *
     * @Route("/{id}/edit", name="player_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Player $player)
    {
        $deleteForm = $this->createDeleteForm($player);
        $editForm = $this->createForm('AppBundle\Form\PlayerType', $player);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('player_edit', array('id' => $player->getId()));
        }

        return $this->render('player/edit.html.twig', array(
            'player' => $player,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a player entity.
     *
     * @Route("/{id}", name="player_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Player $player)
    {
        $form = $this->createDeleteForm($player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($player);
            $em->flush();
        }

        return $this->redirectToRoute('player_index');
    }

    /**
     * Creates a form to delete a player entity.
     *
     * @param Player $player The player entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Player $player)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('player_delete', array('id' => $player->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
