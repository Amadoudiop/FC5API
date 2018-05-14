<?php
 
namespace UserBundle\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Helper\Response\ApiResponse;
 
class LoginController extends Controller
{
    use \UserBundle\Helper\ControllerHelper;
 
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/login", name="user_login")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Connect a user",
     *     section="User",
     *     parameters={
     *          {"name"="email", "dataType"="string", "required"=true, "description"="User email"},
     *          {"name"="password", "dataType"="string", "required"=true, "description"="User password"},
     *     },
     *    statusCodes={
     *         200="Returned when connected with a token",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     */
    public function loginAction(Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
 
        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(['email' => $email]);
 
        if (!$user) {
            return new ApiResponse(null, 400, ['Your login or password is incorrect']);
        }
 
        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $password);
 
        if (!$isValid) {
            return new ApiResponse(null, 400, ['Your login or password is incorrect']);
        }

        $token = $this->getToken($user);

        return new ApiResponse($this->serialize(['token' => $token]));
    }

    /**
     * Returns token for user.
     *
     * @param User $user
     *
     * @return array
     */
    public function getToken(User $user)
    {
        return $this->container->get('lexik_jwt_authentication.encoder')
                ->encode([
                    'username' => $user->getUsername(),
                    'exp' => $this->getTokenExpiryDateTime(),
                ]);
    }
     
    /**
     * Returns token expiration datetime.
     *
     * @return string Unixtmestamp
     */
    private function getTokenExpiryDateTime()
    {
        $tokenTtl = $this->container->getParameter('lexik_jwt_authentication.token_ttl');
        $now = new \DateTime();
        $now->add(new \DateInterval('PT'.$tokenTtl.'S'));
     
        return $now->format('U');
    }
}