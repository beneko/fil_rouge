<?php


namespace App\Controller;


use App\Entity\AdresseLivraison;
use App\Entity\Utilisateurs;
use App\Repository\AdresseLivraisonRepository;
use App\Repository\PaysRepository;
use App\Repository\UtilisateursRepository;
use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
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
     * @param PanierService $panierService
     * @param PaysRepository $paysRepository
     * @param AdresseLivraisonRepository $adresseLivraisonRepository
     * @param UserInterface $user
     * @return Response
     * @Route("/panier/test" , name="testpanier")
     */
    public function validationPanier(AuthenticationUtils $authenticationUtils, PanierService $panierService, PaysRepository $paysRepository,AdresseLivraisonRepository $adresseLivraisonRepository, UserInterface $user)
    {
        if($this->getUser()){


            if($adresseLivraisonRepository->findby([
                'id_utilisateur'=>$user->getId()
            ])){
                return $this->redirectToRoute('finalisation_commande');
//                return $this->render('panier/validation.html.twig',[
//                    'panier'=>$panierService->getFullPanier(),
//                    'total'=>$panierService->getTotal(),
//                    'pays'=>$paysRepository->findAll(),
//                    'adresse'=>$adresseLivraisonRepository->findBy([
//                        'id_utilisateur'=>$user->getId()
//                    ])
//                ]);
            }
            return $this->render('panier/validation.html.twig',[
                'panier'=>$panierService->getFullPanier(),
                'total'=>$panierService->getTotal(),
                'pays'=>$paysRepository->findAll()
            ]);
        }
        else{
            return $this->render('security/login.html.twig',[
                'error'=>$authenticationUtils->getLastAuthenticationError(),
                'last_username' => $authenticationUtils->getLastUsername()
            ]);
        }


    }


    /**
     * @param Request $request
     * @Route("/panier/addr", name="panier_adresse")
     */
    public function adresseLivraison(Request $request,UtilisateursRepository $user,PaysRepository $paysRepository)
    {
        $adresselivraison = new AdresseLivraison();
        $entityManager=$this->getDoctrine()->getManager();
        $pays=$paysRepository->find($request->get('pays'));
        $adresselivraison->setCodePostalLivr($request->get('codep'));
        $adresselivraison->setIdUtilisateur($user->find($request->get('id')));
        $adresselivraison->setVilleLivr($request->get('ville'));
        $adresselivraison->setAdresseLivraison('adresse');
        $adresselivraison->setIdPays($pays);
        $entityManager->persist($adresselivraison);
        $entityManager->flush();
        return $this->render('home/index.html.twig');

    }


    /**
     * @param AdresseLivraisonRepository $adresseLivraisonRepository
     * @param UserInterface $user
     * @return Response
     * @Route("/putain", name="finalisation_commande")
     */
    public function choixAdresse(AdresseLivraisonRepository $adresseLivraisonRepository, UserInterface $user,PaysRepository $paysRepository, PanierService $panierService)
    {




        return $this->render('panier/fincom.html.twig',[
            'adresse'=>$adresseLivraisonRepository->findBy(['id_utilisateur'=>$user->getId()]),
            'pays'=>$paysRepository->findAll(),
            'panier'=>$panierService->getFullPanier(),
            'total'=>$panierService->getTotal()
        ]);
    }




}