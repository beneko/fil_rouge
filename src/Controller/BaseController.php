<?php


namespace App\Controller;


use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BaseController
 * @package App\Controller
 * @Route ("/navbar")
 */
class BaseController extends AbstractController
{
    /**
     * @param CategoriesRepository $categoriesRepository
     * @return Response
     */
    public function affichecat(CategoriesRepository $categoriesRepository): Response
    {
        $affsoucat=$categoriesRepository->getsubcategorie();

        return $this->render('home/navbar.html.twig',[
            'categorie'=>$categoriesRepository->getCategorie(),
            'souscat'=>$affsoucat
        ]);

    }

}