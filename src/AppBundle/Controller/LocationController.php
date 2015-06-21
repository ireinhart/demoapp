<?php

namespace AppBundle\Controller;

use AppBundle\Form\LocationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Location;

/**
 * @Route("/location")
 */
class LocationController extends Controller
{
    /**
     * @Route("/", name="location_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('AppBundle:Location')->findAll();
        return $this->render('location/index.html.twig', array('locations' => $locations));
    }

    /**
     * @Route("/new", name="location_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(new LocationType(), $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();
            return $this->redirectToRoute('location_index');
        }
        return $this->render('location/new.html.twig', array(
            'location' => $location,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="location_show")
     * @Method("GET")
     */
    public function showAction(Location $location)
    {
        $deleteForm = $this->createDeleteForm($location);
        return $this->render('location/show.html.twig', array(
            'location'        => $location,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", requirements={"id" = "\d+"}, name="location_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Location $location, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm(new LocationType(), $location);
        $deleteForm = $this->createDeleteForm($location);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return $this->redirectToRoute('location_edit', array('id' => $location->getId()));
        }
        return $this->render('location/edit.html.twig', array(
            'location'        => $location,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="location_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Location $location)
    {
        $form = $this->createDeleteForm($location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($location);
            $em->flush();
        }
        return $this->redirectToRoute('location_index');
    }

    /**
     * @param Location $location
     * @return \Symfony\Component\Form\Form
     */
    private function createDeleteForm(Location $location)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('location_delete', array('id' => $location->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}