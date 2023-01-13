<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Referent;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomSession', TextType::class)
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('nbPlacesTotal', TextType::class)
            ->add('referent', EntityType::class, [
                    'class' => Referent::class,
                    'choice_label' => 'prenom'
                ])
            ->add('formation', EntityType::class, [
                    'class' => Formation::class,
                    'choice_label' => 'nom_formation'
                ])
            // ->add('stagiaires', TextType::class)
            // ->add('programme', TextType::class)
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
