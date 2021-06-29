<?php


namespace App\Controller;


use App\Entity\AdresseLivraison;
use App\Entity\Commandes;
use App\Entity\LigCom;
use App\Entity\Produits;
use App\Entity\Utilisateurs;
use App\Repository\AdresseLivraisonRepository;
use App\Repository\CommandesRepository;
use App\Repository\ModesLivraisonRepository;
use App\Repository\PaysRepository;
use App\Repository\ProduitsRepository;
use App\Repository\UtilisateursRepository;
use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
    public function index(Request $request, PanierService $panierService): Response
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
     * @return RedirectResponse
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
     * @return RedirectResponse
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, PanierService $panierService): RedirectResponse
    {

        $panierService->remove($id);
        return $this->redirectToRoute("panier_index");
    }


    /**
     * @param PanierService $panierService
     * @return RedirectResponse
     * @Route("/panier/removeAll", name="panier_remove_all")
     */
    public function removeAll(PanierService $panierService): RedirectResponse
    {
        $panierService->supprimerPanier();
        return $this->redirectToRoute("panier_index");
    }


    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param PanierService $panierService
     * @param PaysRepository $paysRepository
     * @param AdresseLivraisonRepository $adresseLivraisonRepository
     * @param TokenStorageInterface $tokenStorage
     * @param UtilisateursRepository $utilisateursRepository
     * @return RedirectResponse|Response
     * @Route("/adresse" , name="panier_addr")
     */
    public function validationPanier(AuthenticationUtils $authenticationUtils, PanierService $panierService, PaysRepository $paysRepository, AdresseLivraisonRepository $adresseLivraisonRepository, TokenStorageInterface $tokenStorage, UtilisateursRepository $utilisateursRepository)
    {
        $users = $tokenStorage->getToken() ? $tokenStorage->getToken()->getUser() : null;
        if ($users != null && $users != 'anon.') {
            $user = $utilisateursRepository->findOneBy([
                'mail' => $users->getUsername()
            ]);

            if ($adresseLivraisonRepository->findby([
                'id_utilisateur' => $user->getId()
            ])) {
                return $this->redirectToRoute('finalisation_commande');
            } else {
                return $this->redirectToRoute('autre_adresse');
            }
        } else {
            return $this->redirectToRoute('app_login');
        }

    }


    /**
     * @param PanierService $panierService
     * @param TokenStorageInterface $tokenStorage
     * @param PaysRepository $paysRepository
     * @param AdresseLivraisonRepository $adresseLivraisonRepository
     * @param UtilisateursRepository $utilisateursRepository
     * @return RedirectResponse|Response
     * @Route("/autreaddr", name="autre_adresse")
     */
    public
    function testadresse(PanierService $panierService, TokenStorageInterface $tokenStorage, PaysRepository $paysRepository, AdresseLivraisonRepository $adresseLivraisonRepository, UtilisateursRepository $utilisateursRepository)
    {
        $users = $tokenStorage->getToken() ? $tokenStorage->getToken()->getUser() : null;
        if ($users != null && $users != 'anon.') {
            $user = $utilisateursRepository->findOneBy([
                'mail' => $users->getUsername()
            ]);

            return $this->render('panier/validation.html.twig', [
                'panier' => $panierService->getFullPanier(),
                'total' => $panierService->getTotal(),
                'pays' => $paysRepository->findAll(),
                'adresse' => $adresseLivraisonRepository->findby([
                    'id_utilisateur' => $user->getId()
                ])
            ]);
        } else {
            return $this->redirectToRoute('app_login');
        }

    }


    /**
     * @param Request $request
     * @param UtilisateursRepository $user
     * @param PaysRepository $paysRepository
     * @return Response
     * @Route("/panier/addr", name="panier_adresse")
     */
    public
    function adresseLivraison(Request $request, UtilisateursRepository $user, PaysRepository $paysRepository, PanierService $panierService): Response
    {
        $adresselivraison = new AdresseLivraison();
        $entityManager = $this->getDoctrine()->getManager();
        $adresselivraison->setCodePostalLivr($request->get('codep'));
        $adresselivraison->setIdUtilisateur($user->find($request->get('id')));
        $adresselivraison->setVilleLivr($request->get('ville'));
        $adresselivraison->setAdresseLivraison($request->get('adresse'));
        $adresselivraison->setIdPays($paysRepository->find($request->get('pays')));
        if ($request->get('fact') == 'true') {
            $adresselivraison->setAdrFacturation('1');
        } else {
            $adresselivraison->setAdrFacturation('0');
        }
        $entityManager->persist($adresselivraison);
        $entityManager->flush();
        return $this->render('panier/index.html.twig', [
            'panier' => $panierService->getFullPanier(),
            'total' => $panierService->getTotal()
        ]);

    }


    /**
     * @param AdresseLivraisonRepository $adresseLivraisonRepository
     * @param UserInterface $user
     * @param PaysRepository $paysRepository
     * @param PanierService $panierService
     * @return Response
     * @Route("/choixaddr", name="finalisation_commande")
     */
    public
    function choixAdresse(AdresseLivraisonRepository $adresseLivraisonRepository, ModesLivraisonRepository $modesLivraisonRepository, UserInterface $user, PaysRepository $paysRepository, PanierService $panierService): Response
    {
        return $this->render('panier/fincom.html.twig', [
            'adresse' => $adresseLivraisonRepository->findBy(['id_utilisateur' => $user->getId()]),
            'pays' => $paysRepository->findAll(),
            'panier' => $panierService->getFullPanier(),
            'total' => $panierService->getTotal(),
            'modes' => $modesLivraisonRepository->findAll()
        ]);
    }


    /**
     * @param ProduitsRepository $produitsRepository
     * @param SessionInterface $session
     * @param CommandesRepository $commandesRepository
     * @param Request $request
     * @param AdresseLivraisonRepository $adresseLivraisonRepository
     * @param UserInterface $user
     * @param ModesLivraisonRepository $mode
     * @param PanierService $panier
     * @return RedirectResponse
     * @Route("/paniervalide", name="panier_valide")
     */
    public
    function directionBdd(ProduitsRepository $produitsRepository, SessionInterface $session, CommandesRepository $commandesRepository, Request $request, AdresseLivraisonRepository $adresseLivraisonRepository, UserInterface $user, ModesLivraisonRepository $mode, PanierService $panier): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $commandes = new Commandes();
        $commandes->setIdAddrLivr($adresseLivraisonRepository->findOneBy([
            'id_utilisateur' => $user->getId(),
            'id' => $request->get('id_livr')
        ]));
        $commandes->setIdModeLivr($mode->findOneBy([
            'id' => $request->get('mode')
        ]));
        $commandes->setTotalCommande($panier->getTotal());
        $commandes->setDateCom(new \DateTime());
        $commandes->setAdrFact($adresseLivraisonRepository->findOneBy([
            'id_utilisateur' => $user->getId(),
            'id' => $request->get('fact')
        ]));
        $entityManager->persist($commandes);
        $entityManager->flush();

        $pan = $session->get('panier');
        foreach ($pan as $produit => $qte) {
            $ligcom = new LigCom();
            $ligcom->setIdProduit($produitsRepository->findOneBy([
                'id' => $produit
            ]));
            $ligcom->setQteProduit($qte);
            $ligcom->setComSousTot(($produitsRepository->findOneBy(['id' => $produit])->getPrixProduit() ** $qte));
            $ligcom->setRemise('0');
            $ligcom->setRefCommande($commandesRepository->findOneBy([
                'total_commande' => $panier->getTotal(),
                'id_addr_livr' => $adresseLivraisonRepository->findOneBy([
                    'id_utilisateur' => $user->getId(),
                    'id' => $request->get('id_livr')
                ]),
                'id_mode_livr' => $request->get('mode')
            ]));
            $entityManager->persist($ligcom);
            $entityManager->flush();
        }
        $panier->supprimerPanier();
        return $this->redirectToRoute('home');


    }


}