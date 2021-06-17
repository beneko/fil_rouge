<?php

namespace App\Form;

use App\Entity\LigCom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigComType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qte_produit')
            ->add('remise')
            ->add('com_sous_tot')
            ->add('id_produit')
            ->add('id_commande')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigCom::class,
        ]);
    }
}
