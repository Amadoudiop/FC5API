<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlazonShape;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;
use Exception;

/**
 * BlazonShape controller.
 *
 * @Route("api/bazonshape")
 */
class BlazonShapeController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="blazonShapeList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="BlazonShapes with orders, pagination and research",
     *  section="BlazonShape",
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
                    'AppBundle\Entity\BlazonShape',
                    [
                        'id',
                        'premium',
                    ]
                )
                ->getResults()
        );
    }

    /**
     * Get a blazonShape by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     * @ApiDoc(
     *     description="get blazonShape",
     *     section="BlazonShape"
     * )serializeEntity
     *
     * @Route("/{id}", name="getBlazonShape")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:BlazonShape');
        $blazonShape = $repository->findOneById($request->get('id'));
        if (empty($blazonShape)) {
            return new ApiResponse(null, 404, ['BlazonShape not found']);
        } else {
            return new ApiResponse(
                $blazonShape->serializeEntity()
            );
        }
    }
}
