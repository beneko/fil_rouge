<?php


namespace App\Controller;


use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PanierController
 * @package App\Controller
 */
class PanierController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/panier", name="panier_index")
     */
    public function index(PanierService $panierService)
    {
//        dd($panierAvecDonnee);
        return $this->render('panier/index.html.twig', [
            'objets' => $panierService->getFullPanier(),
            'total' => $panierService->getTotal()
        ]);
    }

    /**
     * @Route("/panier/ajouter/{id}", name="panier_add")
     */
    public function add($id, PanierService $panierService)
    {
        $panierService->add($id);


        return $this->redirectToRoute("panier_index");
//        dd($session->get('panier'));

    }


    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, PanierService $panierService)
    {

        $panierService->remove($id);
        return $this->redirectToRoute("panier_index");
    }


}