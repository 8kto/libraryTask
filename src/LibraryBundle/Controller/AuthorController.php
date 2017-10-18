<?php

namespace LibraryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $grid = $this->buildGruid('LibraryBundle:Author');

        if ($grid->isReadyForRedirect()) {
            if ($grid->isReadyForExport()) {
                return $grid->getExportResponse();
            }
        }

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
     * @Route("/new", name="author_new")
     */
    public function newAction()
    {

    }
}
