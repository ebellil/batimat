<?php
namespace App\Form;
use App\Entity\Admingeneachat;
use App\Form\AgentType;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class AgentAffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('adresse', TextType::class,  array('mapped' => false))
            ->add('matriculeag', TextType::class,  array('mapped' => false))
            ->add('agence', TextType::class,  array('mapped' => false))
            ->add('villeagence', TextType::class,  array('mapped' => false))

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}