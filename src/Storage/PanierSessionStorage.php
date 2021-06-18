<?php


namespace App\Storage;


use App\Entity\Commandes;
use App\Repository\CommandesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/**
 * Class PanierSessionStorage
 * @package App\Storage
 */
class PanierSessionStorage
{
    /**
     * le stockage de session
     *
     * @var SessionInterface
     */
    private $session;

    /**
     * le repository du panier
     *
     *
     * @var CommandesRepository
     */
    private $panierRepository;


    /**
     * @var string
     */
    const NOM_CLEF_PANIER = 'panier_id';


    /**
     * PanierSessionStorage constructor.
     * @param SessionInterface $session
     * @param CommandesRepository $panierRepository
     */
    public function __construct(SessionInterface $session,CommandesRepository $panierRepository)
    {

        $this->session=$session;
        $this->panierRepository=$panierRepository;



    }


    /**
     * @return Commandes|null
     */
    public function getPanier(): ?Commandes
    {
        return $this->panierRepository->findOneBy([
            'id'=>$this->getPanierId(),
            'statut'=>Commandes::STATUT_PANIER
        ]);
    }


    /**
     * set le panier en session
     *
     *
     * @param Commandes $panier
     */
    public function setPanier(Commandes $panier): void
    {
        $this->session->set(self::NOM_CLEF_PANIER,$panier->getId());
    }






    private function getPanierId(): ?int
    {
        return $this->session->get(self::NOM_CLEF_PANIER);
    }








}