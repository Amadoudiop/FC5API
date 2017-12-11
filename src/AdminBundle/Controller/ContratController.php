<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Contrat;
use AdminBundle\Form\ContractType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Helper\Response\ApiResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Exception;


/**
 * Contrat controller.
 *
 * @Route("api/contract")
 */
class ContratController extends JsonController
{
    /**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("s", name="contractList")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc (
     *
     *  description="Contracts with orders, pagination and research",
     *  section="Contract",
     *
     *  parameters={
     *      {"name"="orders", "dataType"="array", "required"=false, "format"="[ ['id', 'desc'] ]"},
     *      {"name"="page", "dataType"="integer", "required"=false, "description"="Page number (1 by default)"},
     *      {"name"="perPage", "dataType"="integer", "required"=false, "description"="Items per page"},
     *      {"name"="search", "dataType"="string", "required"=false, "description"="Search on multiple columns"}
     *  }
     * )
     */
    public function listAction(Request $request)
    {
        return new ApiResponse(
            $this->get('fc5.entities_list_handler')
                ->handleList(
                    'AppBundle\Entity\Contrat',
                    [
                        'id',
                    ]
                )
                ->getResults()
        );
    }


    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/new", name="contractCreate")
     * @Method("POST")
     *
     * @return \AdminBundle\Helper\Response\ApiResponse
     *
     * @ApiDoc(
     *     description="Creates a new contract",
     *     section="Contract",
     *     headers={
     *          {
     *              "name"="X-Auth-Token",
     *              "description"="Auth Token",
     *              "required"=true
     *          }
     *     },
     *     parameters={
     *          {"name"="salaire", "dataType"="integer", "required"=true, "description"="Player salary"},
     *          {"name"="description", "dataType"="string", "required"=true, "description"="Contract description"},
     *          {"name"="value", "dataType"="integer", "required"=true, "description"="Contract value"},
     *          {"name"="dateStart", "dataType"="dateTime", "required"=true, "description"="Contract Date Start"},
     *          {"name"="duration", "dataType"="dateTime", "required"=true, "description"="Contract Duration"},
     *          {"name"="onGoing", "dataType"="boolean", "required"=true, "description"="Is the contract ongoing"},
     *     }
     * )
     *
     */
    public function createAction(Request $request)
    {
        $json = $this->getJson($request)->toArray();

        $contract = new Contrat();
        $form    = $this->createForm(ContratType::class, $contract);
        $form->submit($json);

        if (!$form->isValid()) {
            return new ApiResponse(null, 422, $this->getErrorMessages($form));
        } else {
            $em   = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->flush();
            return new ApiResponse(
                $contract->serializeEntity()
            );
        }
    }

    /**
     * Finds and displays a contrat entity.
     *
     * @Route("/{id}", name="contrat_show")
     * @Method("GET")
     */
    public function showAction(Contrat $contrat)
    {
        $deleteForm = $this->createDeleteForm($contrat);

        return $this->render('contrat/show.html.twig', array(
            'contrat' => $contrat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contrat entity.
     *
     * @Route("/{id}/edit", name="contrat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contrat $contrat)
    {
        $deleteForm = $this->createDeleteForm($contrat);
        $editForm = $this->createForm('AppBundle\Form\ContratType', $contrat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contrat_edit', array('id' => $contrat->getId()));
        }

        return $this->render('contrat/edit.html.twig', array(
            'contrat' => $contrat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contrat entity.
     *
     * @Route("/{id}", name="contrat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Contrat $contrat)
    {
        $form = $this->createDeleteForm($contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contrat);
            $em->flush();
        }

        return $this->redirectToRoute('contrat_index');
    }

    /**
     * Creates a form to delete a contrat entity.
     *
     * @param Contrat $contrat The contrat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contrat $contrat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contrat_delete', array('id' => $contrat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
