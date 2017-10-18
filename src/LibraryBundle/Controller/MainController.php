<?php

namespace LibraryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
    const LAST_BOOKS_AMOUNT = 8;

    /**
     * @Route("/", name="home")
     * @Template("@Library/page/home.html.twig")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('LibraryBundle:Book');

        return [
            'content_title' => 'Home',
            'sub_header'    => 'Last books',
            'last_books'    => $repo->getLastBooks(self::LAST_BOOKS_AMOUNT),
        ];
    }

    /**
     * @Route("/about", name="about")
     * @Template("@Library/page/about.html.twig")
     */
    public function aboutAction()
    {
        return [
            'content_title' => 'About',
        ];
    }
}
