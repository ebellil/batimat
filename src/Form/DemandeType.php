<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\Materiel;
use App\Entity\Detaildemande;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class DemandeType extends AbstractType
{
    private $materiels;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('demandeecrite')

            ->add('detaildemandes', CollectionType::class, [
                'entry_type' => DetaildemandeType::class,
                'entry_options' => [
                'label' => false
               ],
               'by_reference' => false,
               // this allows the creation of new forms and the prototype too
               'allow_add' => true,
               // self explanatory, this one allows the form to be removed
               'allow_delete' => true
              ])
                  // just a regular save button to persist the changes
          ->add('Valider les demandes', SubmitType::class, [
                'attr' => [
                'class' => 'btn btn-success'
                ]
               ])
          ;
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
