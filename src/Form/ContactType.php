<?php

namespace App\Form;

use App\Entity\FicheContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class)
            ->add('Prenom',TextType::class,[
                'label'=> 'Prénom',
            ])
            ->add('Email',MailType::class)
            ->add('Message',TextAreaType::class)
            ->add('Departement',EntityType::class, [
                'label'=> 'Départements',
                'class'=> Departements::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheContact::class,
        ]);
    }
}
