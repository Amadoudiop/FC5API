<?php

namespace AppBundle\Controller;

use AppBundle\Entity\JerseyShape;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;
use Exception;

/**
 * JerseyShape controller.
 *
 * @Route("api/jerseyshape")
 */
class JerseyShapeController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="jerseyShapeList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="JerseyShapes with orders, pagination and research",
     *  section="JerseyShape",
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
                    'AppBundle\Entity\JerseyShape',
                    [
                        'id',
                        'premium',
                    ]
                )
                ->getResults()
        );
    }



    /**
     * Get a jerseyShape by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     * @ApiDoc(
     *     description="get jerseyShape",
     *     section="JerseyShape"
     * )serializeEntity
     *
     * @Route("/{id}", name="getJerseyShape")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:JerseyShape');
        $jerseyShape = $repository->findOneById($request->get('id'));
        if (empty($jerseyShape)) {
            return new ApiResponse(null, 404, ['JerseyShape not found']);
        } else {
            return new ApiResponse(
                $jerseyShape->serializeEntity()
            );
        }
    }

    /**
     * Creates a new jerseyShape entity.
     *
     * @Route("/new", name="jerseyShape_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jerseyShape = new JerseyShape();
        $form = $this->createForm('AppBundle\Form\JerseyShapeType', $jerseyShape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jerseyShape);
            $em->flush();

            return $this->redirectToRoute('jerseyShape_show', array('id' => $jerseyShape->getId()));
        }

        return $this->render('jerseyShape/new.html.twig', array(
            'jerseyShape' => $jerseyShape,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jerseyShape entity.
     *
     * @Route("/{id}/edit", name="jerseyShape_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, JerseyShape $jerseyShape)
    {
        $deleteForm = $this->createDeleteForm($jerseyShape);
        $editForm = $this->createForm('AppBundle\Form\JerseyShapeType', $jerseyShape);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jerseyShape_edit', array('id' => $jerseyShape->getId()));
        }

        return $this->render('jerseyShape/edit.html.twig', array(
            'jerseyShape' => $jerseyShape,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jerseyShape entity.
     *
     * @Route("/{id}", name="jerseyShape_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, JerseyShape $jerseyShape)
    {
        $form = $this->createDeleteForm($jerseyShape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jerseyShape);
            $em->flush();
        }

        return $this->redirectToRoute('jerseyShape_index');
    }

    /**
     * Creates a form to delete a jerseyShape entity.
     *
     * @param JerseyShape $jerseyShape The jerseyShape entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(JerseyShape $jerseyShape)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jerseyShape_delete', array('id' => $jerseyShape->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
