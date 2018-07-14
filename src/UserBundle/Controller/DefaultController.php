<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AdminBundle\Helper\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;

/**
 * User controller.
 *
 * @Security("is_granted('ROLE_USER')")
 */

class DefaultController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/search/{username}", name="users_search")
     * @Method("GET")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Users search by name",
     *     section="User",
     *     parameters={
     *     },
     *    statusCodes={
     *         200="Returned when listed"
     *     }
     * )
     */
    public function searchAction(Request $request, $username)
    {
        $userConnected = $this->getUser();
        $usersRepo = $this->getDoctrine()->getRepository('UserBundle:User');
        $users = $usersRepo->createQueryBuilder('a')
            ->where('a.usernameCanonical LIKE :search')
            ->setParameter('search', '%' . $username . '%')
            ->getQuery()
            ->getResult();

        $data = [];
        foreach ($users as $user) {

            if ($user->getId() == $userConnected->getId()) continue;

            $username = (empty($user->getUsername())) ? '' : $user->getUsername();
            $id = (empty($user->getId())) ? '' : $user->getId();

            $data[] = [
                'username' => $username,
                'id' => $id
            ];

        }
        return new ApiResponse($data);
    }

}
