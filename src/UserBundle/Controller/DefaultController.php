<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AdminBundle\Helper\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * User controller.
 *
 * @Route("api/users")
 *
 * @Security("is_granted('ROLE_USER')")
 */

class DefaultController extends Controller
{
//    /**
//     * @Route("/")
//     */
//    public function indexAction()
//    {
//        return $this->render('UserBundle:Default:index.html.twig');
//    }


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
     *         201="Returned when listed",
     *         404="Returned when a user is not found",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     */
    public function searchAction(Request $request, $username)
    {

        $usersRepo = $this->getDoctrine()->getRepository('UserBundle:User');
        $users = $usersRepo->createQueryBuilder('a')
            ->where('a.usernameCanonical LIKE :search')
            ->setParameter('search', '%'.$username.'%')
            ->getQuery()
            ->getResult();

        $data = [];
        foreach ($users as $user){
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
