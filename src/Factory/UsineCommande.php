<?php


namespace App\Factory;

use App\Entity\Commandes;
use App\Entity\LigCom;
use App\Entity\Produits;


/**
 * Class UsineCommande
 * @package App\Factory
 */
class UsineCommande
{
    /**
     * @return Commandes
     */
    public function create(): Commandes
    {
        $commande = new Commandes();
        $commande
            ->setStatut(Commandes::STATUT_PANIER)
            ->setDateCom(new \DateTime());

        return $commande;
    }


    /**
     * Creates an item for a product.
     *
     * @param Produits $product
     *
     * @return LigCom
     */
    public function createItem(Produits $product): LigCom
    {
        $item = new LigCom();
        $item->setIdProduit($product);
        $item->setQteProduit(1);

        return $item;
    }










}