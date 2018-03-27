<?php
 
namespace UserBundle\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;
 
class LoginController extends Controller
{
    use \UserBundle\Helper\ControllerHelper;
 
    /**
     * @Route("/login", name="user_login")
     * @Method("POST")
     */
    public function loginAction(Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
 
        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(['email' => $email]);
 
        if (!$user) {
            throw $this->createNotFoundException();
        }
 
        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $password);
 
        if (!$isValid) {
            throw new BadCredentialsException();
        }
 
        $response = new Response(Response::HTTP_OK);
 
        return $this->setBaseHeaders($response);
    }
}