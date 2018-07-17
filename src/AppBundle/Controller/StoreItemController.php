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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Payment;

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

    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/payment", name="payment_store_item")
     * @Method("POST")
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Payment",
     *  section="StoreItem",
     *
     *  parameters={
     *      {"name"="id", "dataType"="integer", "required"=true, "description"=""}
     *  }
     * )
     */
    public function paymentAction(Request $request)
    {
        $user = $this->getUser();
        $id = $request->request->get('id');

        if (!$user) {
            return new ApiResponse(null, 404, ['User not found']);
        }

        $store_item = $this->getDoctrine()
            ->getRepository('AppBundle:StoreItem')
            ->findOneBy(['id' => $id]);

        if (!$store_item) {
            return new ApiResponse(null, 404, ['store item not found']);
        }

        $time = new \DateTime('now');

        $payment = new Payment();
        $payment->setUser($user);
        $payment->setStoreItem($store_item);
        $payment->setDate($time);

        $em = $this->getDoctrine()->getManager();
        $em->persist($payment);
        $em->flush();

        return new ApiResponse('Your request has been sent');
    }

    /**
     * Get a storeItem by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     * @ApiDoc(
     *     description="get payment storeItem",
     *     section="StoreItem"
     * )serializeEntity
     *
     * @Route("/payment/list", name="payment_list")
     * @Method("GET")
     *
     */
    public function paymentsAction(Request $request)
    {
        $user = $this->getUser();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Payment');
        $storeItems = $repository->findBy(['user' => $user->getId()]);
        if (empty($storeItems)) {
            return new ApiResponse(null, 404, ['Payments not found']);
        } else {
            $data = [];

            foreach ($storeItems as $storeItem) {
                $title = (empty($storeItem->getStoreItem()->getTitle())) ? '' : $storeItem->getStoreItem()->getTitle();
                $desc = (empty($storeItem->getStoreItem()->getDescription())) ? '' : $storeItem->getStoreItem()->getDescription();

                $data[] = [
                    'title' => $title,
                    'description' => $desc
                ];
            }

            return new ApiResponse(
                $data
            );
        }
    }
}
