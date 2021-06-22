<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 * Class HomeController
 * @package App\Controller
 */

    class HomeController extends AbstractController {
        /**
         * @Route("/", name="home")
         */
        public function index():Response
        {
            return $this->render('home/index.html.twig');  // affichage de la page d'accueil
        }

    }