<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Friend;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AdminBundle\Helper\Response\ApiResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Friend controller.
 *
 * @Route("api/friend")
 *
 * @Security("is_granted('ROLE_USER')")
 */
class FriendController extends Controller
{

    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/add", name="friend_add")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Add a new friend",
     *     section="Friend",
     *     parameters={
     *          {"name"="friend_id", "dataType"="integer", "required"=true, "description"="User id"},
     *     },
     *    statusCodes={
     *         201="Returned when added",
     *         404="Returned when a user is not found",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     */
    public function addAction(Request $request)
    {
        $user = $this->getUser();
        $friend_id = $request->request->get('friend_id');

        $friend = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(['id' => $friend_id]);

        if (!$friend) {
            return new ApiResponse(null, 404, ['User not found']);
        }

        $friend_test = $this->getDoctrine()
            ->getRepository('AppBundle:Friend')
            ->findOneBy(['from' => $user, 'to' => $friend]);

        if ($friend == $user) {
            return new ApiResponse(null, 400, ['You are you !!!']);
        }

        if ($friend_test) {
            return new ApiResponse(null, 400, ['You are already friends']);
        }

        $friends = new Friend();
        $friends->setFrom($user);
        $friends->setTo($friend);
        $friends->setApproved(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($friends);
        $em->flush();

        return new ApiResponse('Your request has been sent');
    }

    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/list", name="friend_list")
     * @Method("GET")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Friends list",
     *     section="Friend",
     *     parameters={
     *     },
     *    statusCodes={
     *         201="Returned when listed",
     *         404="Returned when a user is not found",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     */
    public function listAction(Request $request)
    {
        $user = $this->getUser();

        if (!$user) {
            return new ApiResponse(null, 404, ['User not found']);
        }

        $friends = $this->getDoctrine()
            ->getRepository('AppBundle:Friend')
            ->findBy(['from' => $user, 'approved' => true]);

        $data = [];

        foreach ($friends as $friend) {
            $username = (empty($friend->getTo()->getUsername())) ? '' : $friend->getTo()->getUsername();
            $id = (empty($friend->getTo()->getId())) ? '' : $friend->getTo()->getId();

            $data[] = [
                'username' => $username,
                'id' => $id
            ];
        }

        $friends = $this->getDoctrine()
            ->getRepository('AppBundle:Friend')
            ->findBy(['to' => $user, 'approved' => true]);


        foreach ($friends as $friend) {
            $username = (empty($friend->getFrom()->getUsername())) ? '' : $friend->getFrom()->getUsername();
            $id = (empty($friend->getFrom()->getId())) ? '' : $friend->getFrom()->getId();

            $data[] = [
                'username' => $username,
                'id' => $id
            ];
        }

        return new ApiResponse($data);
    }

    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/listWaiting", name="friend_list_waiting")
     * @Method("GET")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Friends list waiting",
     *     section="Friend",
     *     parameters={
     *     },
     *    statusCodes={
     *         201="Returned when listed",
     *         404="Returned when a user is not found",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     */
    public function listWaitingAction(Request $request)
    {
        $user = $this->getUser();

        if (!$user) {
            return new ApiResponse(null, 404, ['User not found']);
        }

        $friends = $this->getDoctrine()
            ->getRepository('AppBundle:Friend')
            ->findBy(['to' => $user, 'approved' => false]);

        $data = [];

        foreach ($friends as $friend) {
            $username = (empty($friend->getFrom()->getUsername())) ? '' : $friend->getFrom()->getUsername();
            $request_id = (empty($friend->getId())) ? '' : $friend->getId();

            $data[] = [
                'username' => $username,
                'request_id' => $request_id,

            ];
        }

        return new ApiResponse($data);
    }

    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/accept", name="friend_accept")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Accept a new friend",
     *     section="Friend",
     *     parameters={
     *          {"name"="request_id", "dataType"="integer", "required"=true, "description"="Request id"},
     *     },
     *    statusCodes={
     *         201="Returned when accepted",
     *         404="Returned when a user is not found",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     */
    public function acceptAction(Request $request)
    {
        $user = $this->getUser();

        $request_id = $request->request->get('request_id');

        $friend = $this->getDoctrine()
            ->getRepository('AppBundle:Friend')
            ->findOneBy(['id' => $request_id, 'to'=> $user]);

        if (!$friend) {
            return new ApiResponse(null, 404, ['Request not found']);
        }

        $friend->setApproved(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($friend);
        $em->flush();

        return new ApiResponse('Your request has been sent');
    }

    /**
     * Finds and displays a friend entity.
     *
     * @Route("/{id}", name="friend_show")
     * @Method("GET")
     */
    public function showAction(Friend $friend)
    {
        $deleteForm = $this->createDeleteForm($friend);

        return $this->render('friend/show.html.twig', array(
            'friend' => $friend,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing friend entity.
     *
     * @Route("/{id}/edit", name="friend_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Friend $friend)
    {
        $deleteForm = $this->createDeleteForm($friend);
        $editForm = $this->createForm('AppBundle\Form\FriendType', $friend);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('friend_edit', array('id' => $friend->getId()));
        }

        return $this->render('friend/edit.html.twig', array(
            'friend' => $friend,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a friend entity.
     *
     * @Route("/{id}", name="friend_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Friend $friend)
    {
        $form = $this->createDeleteForm($friend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($friend);
            $em->flush();
        }

        return $this->redirectToRoute('friend_index');
    }

    /**
     * Creates a form to delete a friend entity.
     *
     * @param Friend $friend The friend entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Friend $friend)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('friend_delete', array('id' => $friend->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
