<?php
 
// src/UserBundle/Controller/RegistrationController.php

namespace UserBundle\Controller;
 
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\Form\FormInterface;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
 
class RegistrationController extends BaseController
{
    public function __construct()
    {
    }

    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/register", name="user_register")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Creates a new user",
     *     section="User",
     *     parameters={
     *          {"name"="username", "dataType"="string", "required"=true, "description"="Username"},
     *          {"name"="email", "dataType"="string", "required"=true, "description"="User email"},
     *          {"name"="plainPassword", "dataType"="array", "required"=true, "format"="[ ['first', 'second'] ]", "description"="User password"},
     *     },
     *    statusCodes={
     *         201="Returned when created",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     */
    public function registerAction(Request $request)
    {
        /** @var \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
 
        $user = $userManager->createUser();
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
 
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
 
        $form = $formFactory->createForm(array('csrf_protection' => false));
        $form->setData($user);
        $this->processForm($request, $form);
 
        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(
                          FOSUserEvents::REGISTRATION_SUCCESS, $event
                       );
 
            $userManager->updateUser($user);
 
            $response = new Response($this->serialize('User created.'), Response::HTTP_CREATED);
        } else {
            return new View($form, Response::HTTP_BAD_REQUEST);
        }
 
        return $this->setBaseHeaders($response);
    }
 
    /**
     * @param  Request $request
     * @param  FormInterface $form
     */
    private function processForm(Request $request, FormInterface $form)
    {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            throw new BadRequestHttpException();
        }
 
        $form->submit($data);
    }
 
    /**
     * Data serializing via JMS serializer.
     *
     * @param mixed $data
     *
     * @return string JSON string
     */
    private function serialize($data)
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);
 
        return $this->get('jms_serializer')
            ->serialize($data, 'json', $context);
    }
 
    /**
     * Set base HTTP headers.
     *
     * @param Response $response
     *
     * @return Response
     */
    private function setBaseHeaders(Response $response)
    {
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
 
        return $response;
    }
}