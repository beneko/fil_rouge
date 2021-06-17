<?php

namespace App\Form;

use App\Entity\LigCom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class AjouterAuPanierType
 * @package App\Form
 */
class AjouterAuPanierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qte_produit')
            ->add('remise')
            ->add('com_sous_tot')
            ->add('id_produit')
            ->add('id_commande')
            ->add('refCommande')
        ;
        $builder->add('add',SubmitType::class,[
           'label'=>'Ajouter au panier'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigCom::class,
        ]);
    }
}
