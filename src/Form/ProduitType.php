<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProduit')
            ->add('libelleProduit')
            ->add('prixProduit')
            ->add('stockProduit')
            ->add('tauxTva')
            ->add('pdsProduit')
            ->add('image')
            ->add('idCat')
            ->add('idMarque')
            ->add('idCommande')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
