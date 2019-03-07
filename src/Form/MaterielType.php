<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('stock')
            ->add('categorie', EntityType::class, array(
                'class' => Categorie::class,
                'choice_label' => 'libelle',//permet de mettre le libelle dans le formulaire
           
            ))
            ->add('fournisseur', EntityType::class, array(
                'class' => Fournisseur::class,
                'choice_label' => 'MatriculeF',//permet de mettre le libelle dans le formulaire

            ))
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
