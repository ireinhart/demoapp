<?php

namespace AppBundle\Controller;

use AppBundle\Form\BookType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Book;

/**
 * @Route("/book")
 */
class BookController extends Controller
{
    /**
     * @Route("/", name="book_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle:Book')->findAll();
        return $this->render('book/index.html.twig', array('books' => $books));
    }

    /**
     * @Route("/new", name="book_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(new BookType(), $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('book_index');
        }
        return $this->render('book/new.html.twig', array(
            'book' => $book,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="book_show")
     * @Method("GET")
     */
    public function showAction(Book $book)
    {
        $deleteForm = $this->createDeleteForm($book);
        return $this->render('book/show.html.twig', array(
            'book'        => $book,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", requirements={"id" = "\d+"}, name="book_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Book $book, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm(new BookType(), $book);
        $deleteForm = $this->createDeleteForm($book);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return $this->redirectToRoute('book_edit', array('id' => $book->getId()));
        }
        return $this->render('book/edit.html.twig', array(
            'book'        => $book,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="book_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Book $book)
    {
        $form = $this->createDeleteForm($book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($book);
            $em->flush();
        }
        return $this->redirectToRoute('book_index');
    }

    /**
     * @param Book $book
     * @return \Symfony\Component\Form\Form
     */
    private function createDeleteForm(Book $book)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('book_delete', array('id' => $book->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}