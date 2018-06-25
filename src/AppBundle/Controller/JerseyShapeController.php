<?php

namespace AppBundle\Controller;

use AppBundle\Entity\JerseyShape;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;
use Exception;

/**
 * JerseyShape controller.
 *
 * @Route("api/jerseyshape")
 */
class JerseyShapeController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="jerseyShapeList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="JerseyShapes with orders, pagination and research",
     *  section="JerseyShape",
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
                    'AppBundle\Entity\JerseyShape',
                    [
                        'id',
                        'premium',
                    ]
                )
                ->getResults()
        );
    }



    /**
     * Get a jerseyShape by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     * @ApiDoc(
     *     description="get jerseyShape",
     *     section="JerseyShape"
     * )serializeEntity
     *
     * @Route("/{id}", name="getJerseyShape")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:JerseyShape');
        $jerseyShape = $repository->findOneById($request->get('id'));
        if (empty($jerseyShape)) {
            return new ApiResponse(null, 404, ['JerseyShape not found']);
        } else {
            return new ApiResponse(
                $jerseyShape->serializeEntity()
            );
        }
    }
}
