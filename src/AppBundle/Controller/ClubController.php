<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Club;
use AppBundle\Form\ClubFormType;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;
use Exception;

/**
 * Club controller.
 *
 * @Route("api/club")
 */
class ClubController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="clubList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *  description="Clubs with orders, pagination and research",
     *  section="Club",
     *  headers={
     *      {
     *          "name"="X-API-TOKEN",
     *          "description"="API Token",
     *          "required"=true
     *     }
     *  },
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
                    'AppBundle\Entity\Club',
                    [
                        'id',
                        'name',
                        'shortName',
                        'owner',
                        'blazon',
                        'jerseys',
                        'clubStats',
                        'stadium'
                    ]
                )
                ->getResults()
        );
    }

    /**
     * Get a club by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
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
     * Create an Club
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/create", name="createClub")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Create a club",
     *     section="Club",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     },
     *     parameters={
     *          {"name"="name", "dataType"="string", "required"=true, "description"="Name"},
     *          {"name"="shortName", "dataType"="string", "required"=true, "description"="Short name"},
     *          {"name"="owner", "dataType"="string", "required"=true, "description"="Owner"},
     *          {"name"="blazon", "dataType"="string", "required"=true, "description"="Blazon"},
     *          {"name"="jerseys", "dataType"="objects", "required"=true, "description"="Multiple Jersey"},
     *          {"name"="clubStats", "dataType="objects", "required"=true, "description"="The club stats"},
     *          {"name"="stadium", "dataType"="object", "required"=true, "description"="Stadium"},
     *     }
     * )
     */
    public function createAction(Request $request)
    {
        $json = $this->getJson($request)->toArray();
        $em = $this->getDoctrine()->getManager();

        $club = new Club();
        $form = $this->createForm(ClubFormType::class, $club);
        $form->submit($json);

        if (!$form->isValid()) {
            return new ApiResponse(null, 422, $this->getErrorMessages($form));
        } else {
            $club = $form->getData();

            $em->persist($club);
            $em->flush();

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
     * @Route("/{id}/edit", name="editClub")
     * @Method("POST")
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
     *          {"name"="name", "dataType"="string", "required"=true, "description"="Name"},
     *          {"name"="shortName", "dataType"="string", "required"=true, "description"="Short name"},
     *          {"name"="owner", "dataType"="string", "required"=true, "description"="Owner"},
     *          {"name"="blazon", "dataType"="string", "required"=true, "description"="Blazon"},
     *          {"name"="jerseys", "dataType"="objects", "required"=true, "description"="Multiple Jersey"},
     *          {"name"="clubStats", "dataType="objects", "required"=true, "description"="The club stats"},
     *          {"name"="stadium", "dataType"="object", "required"=true, "description"="Stadium"},
     *     }
     * )
     */
    public function editAction(Request $request)
    {
        $json = $this->getJson($request)->toArray();
        $em = $this->getDoctrine()->getManager();
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
     * @Route("/{id}/remove", name="removeClub")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Remove existing Club",
     *     section="Club",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     }
     * )
     */
    public function removeAction(Request $request)
    {
        try {
            $em = $this->getDoctrine()->getManager();
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
