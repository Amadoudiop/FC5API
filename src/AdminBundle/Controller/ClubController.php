<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Club;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Helper\Response\ApiResponse;


/**
 * Club controller.
 *
 * @Route("club")
 */
class ClubController extends Controller
{
    /**
     * Lists all club entities.
     *
     * @Route("/", name="club_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('AppBundle:Club')->findAll();

        return $this->render('club/index.html.twig', array(
            'clubs' => $clubs,
        ));
    }


    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/new", name="club_create")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Creates a new club entity",
     *     section="Club",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     },
     *     parameters={
     *          {"name"="name", "dataType"="string", "required"=true, "description"="Club name"},
     *          {"name"="blason", "dataType"="string", "required"=true, "description"="Club blason"},
     *          {"name"="clubStats", "dataType"="string", "required"=true, "description"="Club stats"},
     *     }
     * )
     *
     */
    public function createAction(Request $request)
    {
        $json = $this->getJson($request)->toArray();
        $em   = $this->getDoctrine()->getManager();
        $club = new Club();
        $form    = $this->createForm(ClubFormType::class, $club);
        $form->submit($json);
        if (!$form->isValid()) {
            return new ApiResponse(null, 422, $this->getErrorMessages($form));
        } else {
            $em->persist($club);
            $em->flush();
            return new ApiResponse(
                $club->serializeEntity()
            );
        }
    }

    /**
     * Get a club by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="get club",
     *     section="Club"
     * )
     *
     * @Route("/{id}", name="getClub")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Club');
        $club = $repository->findOneById($request->get('id'));
        if (empty($club)) {
            return new ApiResponse(null, 404, ['Club not found']);
        } else {
            return new ApiResponse(
                $club->serializeEntity()
            );
        }
    }


    /**
     * Edit a Club
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Edit a club",
     *     section="Club",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     },
     *     parameters={
     *          {"name"="Name", "dataType"="string", "required"=true, "description"="Club name"},
     *     }
     * )
     *
     * @Route("/{id}/edit", name="club_edit")
     * @Method("POST")
     *
     */
    public function editAction(Request $request)
    {
        $json       = $this->getJson($request)->toArray();
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Club');
        $club = $repository->findOneById($request->get('id'));
        if (empty($club)) {
            return new ApiResponse(null, 404);
        }
        $editForm = $this->createForm(ClubFormType::class, $club);
        $editForm->submit($json);
        if ($editForm->isValid()) {
            $em->persist($club);
            $em->flush();
            return new ApiResponse(
                $club->serializeEntity()
            );
        } else {
            return new ApiResponse(null, 422, $this->getErrorMessages($editForm));
        }
    }




    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Delete existing Club",
     *     section="Club",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     }
     * )
     *
     * @Route("/{id}/remove", name="clubRemove")
     * @Method("POST")
     *
     */
    public function removeAction(Request $request)
    {
        try {
            $em         = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AppBundle:Club');
            $club = $repository->find($request->get('id'));
            if (!$club) {
                throw $this->createNotFoundException('Unable to find Club id.');
            }
            $em->remove($club);
            $em->flush();
            return new ApiResponse(
                [
                    'success' => true,
                ]
            );
        } catch (Exception $e) {
            return new ApiResponse(null, 404, $e->getMessage());
        }
    }



}
