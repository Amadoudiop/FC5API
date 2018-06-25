<?php

namespace AppBundle\Controller;

use AppBundle\Entity\StoreItem;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;
use Exception;

/**
 * StoreItem controller.
 *
 * @Route("api/storeitem")
 */
class StoreItemController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="storeItemList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="StoreItems with orders, pagination and research",
     *  section="StoreItem",
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
                    'AppBundle\Entity\StoreItem',
                    [
                        'id',
                        'title',
                        'value',
                        'fc5Buyable'
                    ]
                )
                ->getResults()
        );
    }


    /**
     * Get a storeItem by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     * @ApiDoc(
     *     description="get storeItem",
     *     section="StoreItem"
     * )serializeEntity
     *
     * @Route("/{id}", name="getStoreItem")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:StoreItem');
        $storeItem = $repository->findOneById($request->get('id'));
        if (empty($storeItem)) {
            return new ApiResponse(null, 404, ['StoreItem not found']);
        } else {
            return new ApiResponse(
                $storeItem->serializeEntity()
            );
        }
    }
}
