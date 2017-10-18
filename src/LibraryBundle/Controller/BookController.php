<?php

namespace LibraryBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use LibraryBundle\Entity\Book;
use LibraryBundle\Form\BookType;

/**
 * @Route("/book")
 */
class BookController extends BaseController
{
    const GRID_LIST_TPL = '@Library/common/grid.html.twig';
    private $routePfx = 'book';

    /**
     * @Route("/list", name="book_list")
     * @Template("@Library/page/book.html.twig")
     *
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $routePfx = $this->routePfx;
        $grid     = $this->buildGruid('LibraryBundle:Book', $routePfx);

        if ($grid->isReadyForRedirect()) {
            if ($grid->isReadyForExport()) {
                return $grid->getExportResponse();
            }
        }

        $grid->getColumn('title')->setSafe(false)->manipulateRenderCell(
            function ($value, $row, $router) use ($routePfx) {
                $route = $router->generate(
                    "{$routePfx}_show",
                    ['id' => $row->getField('id')]
                );

                return "<a href='$route' class='link-show-row'>$value</a>";
            }
        );

        $authorRoutePfx = 'author';
        $grid->getColumn('author.lastName')->setSafe(false)->manipulateRenderCell(
            function ($value, $row, $router) use ($authorRoutePfx) {
                $route = $router->generate(
                    "{$authorRoutePfx}_show",
                    ['id' => $row->getField('author.id')]
                );

                return "<a href='$route' class='link-show-row'>$value</a>";
            }
        );

        $gridResponse = $this->render(self::GRID_LIST_TPL, [
            'grid'       => $grid,
            'tpl_params' => ['route_name_prefix' => $this->routePfx],
        ]);

        // AJAX
        if ($request->isXmlHttpRequest()) {
            return $gridResponse;
        }

        return [
            'grid'          => $gridResponse->getContent(),
            'content_title' => 'Books index',
        ];
    }

    /**
     * Creates a new Book entity.
     *
     * @Route("/", name="book_create")
     * @Method("POST")
     * @Template("@Library/book/new.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $entity = new Book();
        $form   = $this->createForm(new BookType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('book_show', ['id' => $entity->getId()]));
        }

        return [
            'entity'        => $entity,
            'form'          => $form->createView(),
            'content_title' => 'New book',
        ];
    }

    /**
     * Displays a form to create a new Book entity.
     *
     * @Route("/new", name="book_new")
     * @Method("GET")
     * @Template("@Library/book/new.html.twig")
     */
    public function newAction()
    {
        $entity = new Book();
        $form   = $this->createForm(new BookType(), $entity);

        return [
            'entity'        => $entity,
            'form'          => $form->createView(),
            'content_title' => 'New book',
        ];
    }

    /**
     * Finds and displays a Book entity.
     *
     * @Route("/{id}", name="book_show")
     * @Method("GET")
     * @Template("@Library/book/show.html.twig")
     *
     * @param Book $book
     * @return array
     */
    public function showAction(Book $book)
    {
        $deleteForm = $this->createDeleteForm($book->getId());

        return [
            'content_title' => $book->getTitle(),
            'entity'        => $book,
            'delete_form'   => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Book entity.
     *
     * @Route("/{id}/edit", name="book_edit")
     * @Method("GET")
     * @Template("@Library/book/edit.html.twig")
     * @param $id
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:Book')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        $editForm   = $this->createForm(new BookType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity'        => $entity,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'content_title' => $entity->getTitle(),
        ];
    }

    /**
     * Edits an existing Book entity.
     *
     * @Route("/{id}", name="book_update")
     * @Method("PUT")
     * @Template("@Library/book/edit.html.twig")
     * @param Request $request
     * @param         $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:Book')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new BookType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('book_edit', ['id' => $id]));
        }
        else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return [
            'entity'        => $entity,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'content_title' => $entity->getTitle(),
        ];
    }

    /**
     * Deletes a Book entity.
     *
     * @Route("/{id}", name="book_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em     = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LibraryBundle:Book')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Book entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        }
        else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('book_list'));
    }

    /**
     * Creates a form to delete a Book entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(['id' => $id])
                    ->add('id', 'hidden')
                    ->getForm();
    }
}