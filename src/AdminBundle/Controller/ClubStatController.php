<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClubStat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Helper\Response\ApiResponse;

/**
 * Clubstat controller.
 *
 * @Route("clubstat")
 */
class ClubStatController extends Controller
{
    /**
     * Lists all clubStat entities.
     *
     * @Route("/", name="clubstat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clubStats = $em->getRepository('AppBundle:ClubStat')->findAll();

        return $this->render('clubstat/index.html.twig', array(
            'clubStats' => $clubStats,
        ));
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/new", name="ClubStatCreate")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Creates a new clubStat entity",
     *     section="ClubStat",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     },
     *     parameters={
     *          {"name"="label", "dataType"="string", "required"=true, "description"="ClubStat label"},
     *          {"name"="value", "dataType"="string", "required"=true, "description"="ClubStat value"},
     *          {"name"="shortLabel", "dataType"="string", "required"=true, "description"="ClubStat short label"},
     *     }
     * )
     *
     */
    public function createAction(Request $request)
    {
        $json = $this->getJson($request)->toArray();
        $em   = $this->getDoctrine()->getManager();
        $clubStat = new ClubStat();
        $form    = $this->createForm(ClubStatFormType::class, $clubStat);
        $form->submit($json);
        if (!$form->isValid()) {
            return new ApiResponse(null, 422, $this->getErrorMessages($form));
        } else {
            $em->persist($clubStat);
            $em->flush();
            return new ApiResponse(
                $clubStat->serializeEntity()
            );
        }
    }

    /**
     * Get a clubStat by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="get clubStat",
     *     section="ClubStat"
     * )
     *
     * @Route("/{id}", name="getClubStat")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:ClubStat');
        $clubStat = $repository->findOneById($request->get('id'));
        if (empty($clubStat)) {
            return new ApiResponse(null, 404, ['ClubStat not found']);
        } else {
            return new ApiResponse(
                $clubStat->serializeEntity()
            );
        }
    }

    /**
     * Edit a ClubStat
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Edit a clubStat",
     *     section="ClubStat",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     },
     *     parameters={
     *          {"name"="label", "dataType"="string", "required"=true, "description"="ClubStat label"},
     *     }
     * )
     *
     * @Route("/{id}/edit", name="clubStatEdit")
     * @Method("POST")
     *
     */
    public function editAction(Request $request)
    {
        $json       = $this->getJson($request)->toArray();
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:ClubStat');
        $clubStat = $repository->findOneById($request->get('id'));
        if (empty($clubStat)) {
            return new ApiResponse(null, 404);
        }
        $editForm = $this->createForm(ClubStatFormType::class, $clubStat);
        $editForm->submit($json);
        if ($editForm->isValid()) {
            $em->persist($clubStat);
            $em->flush();
            return new ApiResponse(
                $clubStat->serializeEntity()
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
     *     description="Delete existing ClubStat",
     *     section="ClubStat",
     *     headers={
     *          {
     *              "name"="X-API-TOKEN",
     *              "description"="API Token",
     *              "required"=true
     *          }
     *     }
     * )
     *
     * @Route("/{id}/remove", name="clubStatRemove")
     * @Method("POST")
     *
     */
    public function removeAction(Request $request)
    {
        try {
            $em         = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AppBundle:ClubStat');
            $clubStat = $repository->find($request->get('id'));
            if (!$clubStat) {
                throw $this->createNotFoundException('Unable to find Club id.');
            }
            $em->remove($clubStat);
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
