<?php


namespace App\Service\Panier;


use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{

    protected $session;
    protected $produitRpository;

    public function __construct(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $this->session = $session;
        $this->produitRpository = $produitsRepository;

    }


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

    public function remove(int $id)
    {

        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);

    }

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


    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getFullPanier() as $item) {
            $total += $item['produit']->getPrixProduit() * $item['quantite'];

        }
        return $total;
    }
}