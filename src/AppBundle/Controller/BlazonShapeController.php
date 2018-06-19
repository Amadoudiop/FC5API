<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlazonShape;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AdminBundle\Controller\JsonController;
use Exception;

/**
 * BlazonShape controller.
 *
 * @Route("api/bazonshape")
 */
class BlazonShapeController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="blazonShapeList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="BlazonShapes with orders, pagination and research",
     *  section="BlazonShape",
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
                    'AppBundle\Entity\BlazonShape',
                    [
                        'id',
                        'premium',
                    ]
                )
                ->getResults()
        );
    }



    /**
     * Get a blazonShape by id
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     * @ApiDoc(
     *     description="get blazonShape",
     *     section="BlazonShape"
     * )serializeEntity
     *
     * @Route("/{id}", name="getBlazonShape")
     * @Method("GET")
     *
     */
    public function getAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:BlazonShape');
        $blazonShape = $repository->findOneById($request->get('id'));
        if (empty($blazonShape)) {
            return new ApiResponse(null, 404, ['BlazonShape not found']);
        } else {
            return new ApiResponse(
                $blazonShape->serializeEntity()
            );
        }
    }

    /**
     * Creates a new blazonShape entity.
     *
     * @Route("/new", name="blazonShape_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $blazonShape = new BlazonShape();
        $form = $this->createForm('AppBundle\Form\BlazonShapeType', $blazonShape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blazonShape);
            $em->flush();

            return $this->redirectToRoute('blazonShape_show', array('id' => $blazonShape->getId()));
        }

        return $this->render('blazonShape/new.html.twig', array(
            'blazonShape' => $blazonShape,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing blazonShape entity.
     *
     * @Route("/{id}/edit", name="blazonShape_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BlazonShape $blazonShape)
    {
        $deleteForm = $this->createDeleteForm($blazonShape);
        $editForm = $this->createForm('AppBundle\Form\BlazonShapeType', $blazonShape);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blazonShape_edit', array('id' => $blazonShape->getId()));
        }

        return $this->render('blazonShape/edit.html.twig', array(
            'blazonShape' => $blazonShape,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a blazonShape entity.
     *
     * @Route("/{id}", name="blazonShape_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BlazonShape $blazonShape)
    {
        $form = $this->createDeleteForm($blazonShape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blazonShape);
            $em->flush();
        }

        return $this->redirectToRoute('blazonShape_index');
    }

    /**
     * Creates a form to delete a blazonShape entity.
     *
     * @param BlazonShape $blazonShape The blazonShape entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BlazonShape $blazonShape)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blazonShape_delete', array('id' => $blazonShape->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
