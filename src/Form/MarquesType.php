<?php

namespace App\Form;

use App\Entity\Marques;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extention\Core\Type\SubmitType;

class MarquesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_marque')
            ->add('libelle_marque')
//            ->add('logo_marque')
            ->add('logo_marque', FileType::class,[
                'label' =>'Picture (fichier image)',
                // non mappé pour ne pas l'associé a une entité
                'mapped' => false,
                //pour ne pas re-telecharger le fichier à chaque fois que l'on modifie les details
                'required' =>false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' =>[
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/tiff'
                        ],
                        'mimeTypesMessage' => 'SVP telecharger un fichier valide',
                    ])
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Marques::class,
        ]);
    }
}
