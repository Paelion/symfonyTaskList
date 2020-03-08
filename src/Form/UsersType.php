<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => ["placeholder" => "Nom"]
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => ["placeholder" => "Prenom"]
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => ["placeholder" => "Email"]
            ])
            ->add('date_insc', DateTimeType::class, array(
                "data" => new \DateTime('now')
            ))
            ->add('submit', SubmitType::class, [
                'attr' => ["class" => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
