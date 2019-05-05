<?php

namespace App\Form;

use App\Entity\Fournisseur;
use App\Entity\FournisseurRapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FournisseurRapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fournisseur', EntityType::class, array(
                'class' => Fournisseur::class,
                'choice_label' => 'MatriculeF',//permet de mettre le libelle dans le formulaire
            ))
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
