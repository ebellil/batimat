<?php

namespace App\Form;

use App\Entity\Detaildemande;
use App\Entity\Demande;
use App\Entity\Materiel;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DetaildemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite', IntegerType::class)
            //->add('note')
            //->add('commentaire',TextType::class)
            //->add('idmat')
            //->add('numcommande')
            //->add('demande')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Detaildemande::class,
        ]);
    }
}
