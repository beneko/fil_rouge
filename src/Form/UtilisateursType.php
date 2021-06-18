<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail')
            ->add('mot_de_passe')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('code_postal')
            ->add('ville')
            ->add('adresse')
            ->add('date_naissance')
            ->add('id_role_id')
            ->add('id_pays_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}