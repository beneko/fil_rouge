<?php


namespace App\Manager;

use App\Entity\Commandes;
use App\Factory\UsineCommande;
use App\Storage\PanierSessionStorage;
use Doctrine\ORM\EntityManagerInterface;


/**
 * Class PanierManager
 * @package App\Manager
 */
class PanierManager
{

    /**
     * @var PanierSessionStorage
     */
    private $panierSessionStorage;

    /**
     * @var UsineCommande
     */
    private $panierUsine;


    /**
     * PanierManager constructor.
     *
     * @param PanierSessionStorage $panierStorage
     * @param UsineCommande $usineCommande
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PanierSessionStorage $panierStorage, UsineCommande $usineCommande, EntityManagerInterface $entityManager)
    {
        $this->panierSessionStorage = $panierStorage;
        $this->panierUsine = $usineCommande;
        $this->entityManager = $entityManager;
    }

    public function getCurrentPanier(): Commandes
    {
        $panier = $this->panierSessionStorage->getPanier();
        if (!$panier) {
            $panier = $this->panierUsine->create();
        }
        return $panier;
    }

    public function save(Commandes $panier) :void
    {
        // sauvegarder en bdd
        $this->entityManager->persist($panier);;
        $this->entityManager->flush();
        // sauvegarder en session
        $this->panierSessionStorage->setPanier($panier);
    }





}