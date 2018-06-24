<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Friend;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AdminBundle\Helper\Response\ApiResponse;

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
     * Add a new friend
     *
     * @Route("/add", name="friend_add")
     * @Method("POST")
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
        $friends->setApproved(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($friends);
        $em->flush();

        return new ApiResponse('Your request has been sent');
    }

    /**
     * Remove a friend
     *
     * @Route("/list", name="friend_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $user = $this->getUser();
        //var_dump($user);die;

        if (!$user) {
            return new ApiResponse(null, 404, ['User not found']);
        }

        $friends = $this->getDoctrine()
            ->getRepository('AppBundle:Friend')
            ->findBy(['from' => $user, 'approved' => true]);

        //var_dump($friends);die;

        return new ApiResponse($friends);
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
