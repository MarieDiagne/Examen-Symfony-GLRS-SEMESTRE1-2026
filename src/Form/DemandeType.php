<?php

namespace App\Form;

use App\Entity\DemandeRendezVous;
use App\Enum\Specialite;
use App\Enum\TypePrestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateSouhaitee', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date souhaitée',
                'attr' => ['class' => 'form-control']
            ])
            ->add('typePrestation', EnumType::class, [
                'class' => TypePrestation::class,
                'expanded' => true, 
                'multiple' => false,
                'label' => 'Type de prestation'
            ])
            ->add('specialite', EnumType::class, [
                'class' => Specialite::class,
                'label' => 'Spécialité',
                'placeholder' => 'Choisir une spécialité',
                'attr' => ['class' => 'form-select']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeRendezVous::class,
        ]);
    }
}