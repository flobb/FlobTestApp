<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function listAction()
    {
        $lastAddedMovies = $this->getDoctrine()->getRepository('AppBundle:Movie')->getLast();
        $lastPublishedArticles = $this->getDoctrine()->getRepository('AppBundle:Article')->getLast();

        return $this->render(
            'AppBundle:Homepage:list.html.twig',
            [
                'lastAddedMovies' => $lastAddedMovies,
                'lastPublishedArticles' => $lastPublishedArticles,
            ]
        );
    }
}
