<?php

namespace App\Form;
use App\Entity\Demande;
use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;



class DemandeType extends AbstractType
{
    private $materiels;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('demandeecrite')
            ->add('quantite')
/*             ->add('materiel', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'libelle',//permet de mettre le libelle dans le formulaire
           
            ]) */
            ->add('idmat')
            ->add('idagentaff');
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
            //array('data_class' => Materiel::class),
        ]);
    }
}
