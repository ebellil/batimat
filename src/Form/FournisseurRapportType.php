<?php

namespace App\Form;

use App\Entity\FournisseurRapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FournisseurRapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rapport',TextareaType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       /* $resolver->setDefaults([
            'data_class' => FournisseurRapport::class,
        ]);*/
    }
}
