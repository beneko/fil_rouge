<?php


namespace App\Controller;


use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Class PanierController
 * @package App\Controller
 */
class PanierController extends AbstractController
{

    /**
     * @param PanierService $panierService
     * @return Response
     * @Route("/panier", name="panier_index")
     */
    public function index(Request $request, PanierService $panierService)
    {


        if ($request->getMethod() === "POST") {
            $panierService->updateNumber($request);
            return $this->redirectToRoute("panier_index");
        }
//        dd($panierAvecDonnee);
        return $this->render('panier/index.html.twig', [
            'panier' => $panierService->getFullPanier(),
            'total' => $panierService->getTotal()
        ]);
    }

    /**
     * @param $id
     * @param PanierService $panierService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/panier/ajouter/{id}", name="panier_add")
     */
    public function add($id, PanierService $panierService)
    {
        $panierService->add($id);


        return $this->redirectToRoute("panier_index");


    }

    /**
     * @param $id
     * @param PanierService $panierService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, PanierService $panierService)
    {

        $panierService->remove($id);
        return $this->redirectToRoute("panier_index");
    }


//    /**
//     * @param $id
//     * @param PanierService $panierService
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     * @Route("/panier/removeUn/{id}", name="panier_remove_un")
//     */
//    public function removeUn($id, PanierService $panierService): Response
//    {
//        $panierService->removeOne($id);
//        return $this->redirectToRoute("panier_index");
//
//    }

    /**
     * @param PanierService $panierService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/panier/removeAll", name="panier_remove_all")
     */
    public function removeAll(PanierService $panierService)
    {
        $panierService->supprimerPanier();
        return $this->redirectToRoute("panier_index");
    }


    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @Route("/panier/test" , name="testpanier")
     */
    public function validationPanier(AuthenticationUtils $authenticationUtils)
    {
        $verif=false;
        if($this->getUser()){
            $verif=true;
            return $this->render('home/index.html.twig',[
                'verif'=>$verif
            ]);
        }
        else{
            return $this->render('home/index.html.twig',[
                'verif'=>$verif,
            ]);
        }


    }




}