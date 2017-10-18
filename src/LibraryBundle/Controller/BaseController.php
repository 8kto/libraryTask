<?php

namespace LibraryBundle\Controller;

use APY\DataGridBundle\Grid\Column\ActionsColumn;
use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function buildGruid($entityName)
    {
        $source = new Entity($entityName);

        // Get a Grid instance
        $grid = $this->get('grid');

        // Attach the source to the grid
        $grid->setSource($source);
        // $grid->setMaxResults(0);

        // Action
        $actionsColumn = new ActionsColumn('actions_column', 'Actions');
        $actionsColumn->setSize(-1);
        $actionsColumn->setClass('cell-actions-column');
        $grid->addColumn($actionsColumn, 1);

        // Edit
        // $rowActionEdit = new RowAction('Edit', "{$routePfx}_edit");
        // $rowActionEdit->setRouteParameters(['id']);
        // $rowActionEdit->setColumn('actions_column');
        // $rowActionEdit->setAttributes(['linkClass' => 'edit-link', 'dataIcon' => 'edit']);
        // $grid->addRowAction($rowActionEdit);

        // Просмотр для каждой строки
        // $rowActionShow = new RowAction('Show', "{$routePfx}_show");
        // $rowActionShow->setRouteParameters(['id']);
        // $rowActionShow->setColumn('actions_column');
        // $rowActionShow->setAttributes(['linkClass' => 'show-link', 'dataIcon' => 'eye', 'hide' => false]);
        // $grid->addRowAction($rowActionShow);

        // $grid->addMassAction(new DeleteMassAction(true));

        if ($grid->hasColumn('id')) {
            // $grid->getColumn('id')->setSafe(false)->manipulateRenderCell(
            //     function ($value, $row, $router) use ($routePfx) {
            //         $route = $router->generate(
            //             "{$routePfx}_show",
            //             ['id' => $row->getField('id')]
            //         );
            //
            //         return "<a href='$route' class='link-show-row'>$value</a>";
            //     }
            // );
        }

        return $grid;
    }
}