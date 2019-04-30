<?php
namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminGeneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('adresse', TextType::class,  array('mapped' => false))
            ->add('matriculead', TextType::class,  array('mapped' => false))
        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}