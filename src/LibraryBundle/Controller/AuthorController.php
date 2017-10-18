<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Author;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use LibraryBundle\Form\AuthorType;

/**
 * @Route("/author")
 */
class AuthorController extends BaseController
{
    const GRID_LIST_TPL = '@Library/common/grid.html.twig';
    private $routePfx = 'author';

    /**
     * @Route("/list", name="author_list")
     * @Template("@Library/page/author.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $routePfx = $this->routePfx;
        $grid     = $this->buildGruid('LibraryBundle:Author', $this->routePfx);

        if ($grid->isReadyForRedirect()) {
            if ($grid->isReadyForExport()) {
                return $grid->getExportResponse();
            }
        }

        $phpCanInFunc = function ($value, $row, $router) use ($routePfx) {
            $route = $router->generate(
                "{$routePfx}_show",
                ['id' => $row->getField('id')]
            );

            return "<a href='$route' class='link-show-row'>$value</a>";
        };

        $grid->getColumn('firstName')->setSafe(false)->manipulateRenderCell($phpCanInFunc);
        $grid->getColumn('lastName')->setSafe(false)->manipulateRenderCell($phpCanInFunc);

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
            'content_title' => 'Author index',
        ];
    }

    /**
     * Creates a new Author entity.
     *
     * @Route("/", name="author_create")
     * @Method("POST")
     * @Template("@Library/author/new.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $entity = new Author();
        $form   = $this->createForm(new AuthorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('author_show', ['id' => $entity->getId()]));
        }

        return [
            'entity'        => $entity,
            'form'          => $form->createView(),
            'content_title' => 'New author',
        ];
    }

    /**
     * Displays a form to create a new Author entity.
     *
     * @Route("/new", name="author_new")
     * @Method("GET")
     * @Template("@Library/author/new.html.twig")
     */
    public function newAction()
    {
        $entity = new Author();
        $form   = $this->createForm(new AuthorType(), $entity);

        return [
            'entity'        => $entity,
            'form'          => $form->createView(),
            'content_title' => 'New author',
        ];
    }

    /**
     * Finds and displays a Author entity.
     *
     * @Route("/{id}", name="author_show")
     * @Method("GET")
     * @Template("@Library/author/show.html.twig")
     *
     * @param Author $author
     * @return array
     */
    public function showAction(Author $author)
    {
        $deleteForm = $this->createDeleteForm($author->getId());

        return [
            'content_title' => $author->getShortenedName(),
            'entity'        => $author,
            'delete_form'   => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Author entity.
     *
     * @Route("/{id}/edit", name="author_edit")
     * @Method("GET")
     * @Template("@Library/author/edit.html.twig")
     * @param Author $entity
     * @return array
     */
    public function editAction(Author $entity)
    {
        $editForm   = $this->createForm(new AuthorType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return [
            'entity'        => $entity,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'content_title' => $entity->getShortenedName(),
        ];
    }

    /**
     * Edits an existing Author entity.
     *
     * @Route("/{id}", name="author_update")
     * @Method("PUT")
     * @Template("@Library/author/edit.html.twig")
     * @param Request $request
     * @param         $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LibraryBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Author entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new AuthorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('author_edit', ['id' => $id]));
        }
        else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return [
            'entity'        => $entity,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'content_title' => $entity->getShortenedName(),
        ];
    }

    /**
     * Deletes a Author entity.
     *
     * @Route("/{id}", name="author_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param         $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em     = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LibraryBundle:Author')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Author entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        }
        else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('author_list'));
    }

    /**
     * Creates a form to delete a Author entity by id.
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
