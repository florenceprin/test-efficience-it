<?php

namespace App\Form;

use App\Entity\Departements;
use App\Entity\FicheContact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=> 'Nom',
            ])
            ->add('prenom',TextType::class,[
                'label'=> 'Prénom',
            ])
            ->add('email',EmailType::class,[
                'label'=> 'Email',
            ])
            ->add('message',TextAreaType::class,[
                'label'=> 'Message',
            ])
            ->add('departement',EntityType::class, [
                'label'=> 'Départements',
                'class'=> Departements::class,
            ])
            ->add('Envoyer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheContact::class,
        ]);
    }
}
