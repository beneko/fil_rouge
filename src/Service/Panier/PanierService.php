<?php


namespace App\Service\Panier;


use App\Entity\Panier;
use App\Entity\Utilisateurs;
use App\Repository\ProduitsRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Class PanierService
 * @package App\Service\Panier
 */
class PanierService extends AbstractType
{

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var ProduitsRepository
     */
    protected $produitRpository;

    /**
     * @var RequestStack
     */
    protected $request;

//    /**
//     * @var TokenStorageInterface
//     */
//    private $tokenStorage;
//
//    /**
//     * @var UtilisateursRepository
//     */
//private $utilisateursRepository;

    /**
     * PanierService constructor.
     * @param SessionInterface $session
     * @param ProduitsRepository $produitsRepository
     * @param RequestStack $requestStack
     * @param TokenStorageInterface $tokenStorage
     * @param UtilisateursRepository $utilisateursRepository
     */
    public function __construct(SessionInterface $session, ProduitsRepository $produitsRepository, RequestStack $requestStack)
    {
        $this->session = $session;
        $this->produitRpository = $produitsRepository;
        $this->request=$requestStack;

    }


    /**
     * @param int $id
     */
    public function add(int $id)
    {


        // si panier, le récupère, sinon crée un panier (tableau) vide
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);

    }

    /**
     * @param int $id
     */
    public function remove(int $id)
    {

        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);

    }

    /**
     * @return array
     */
    public function getFullPanier(): array
    {
        $panier = $this->session->get('panier', []);
        $panierAvecDonnee = [];

        foreach ($panier as $id => $quantite) {
            $panierAvecDonnee[] = [
                'produit' => $this->produitRpository->find($id),
                'quantite' => $quantite
            ];
        }
        return $panierAvecDonnee;
    }


    /**
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getFullPanier() as $item) {
            $total += $item['produit']->getPrixProduit() * $item['quantite'];

        }
        return $total;
    }


    public function removeOne(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);

    }


    public function updateNumber($request)
    {
        $panier=$this->session->get('panier');
        $tableau = $request->get('quantite');
//        dd($tableau);
        foreach ($tableau as $idp => $quantite) {
            if(!empty($tableau[$idp])){
                $panier[$idp]=$quantite;
            }

        }

//        dd($panier);
        $this->session->set('panier',$panier);
    }

    public function supprimerPanier()
    {
        $this->session->set('panier',[]);
    }


}