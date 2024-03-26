<?php

namespace App\Form;

use App\Entity\Appartements;
use App\Entity\Locataires;
use App\Entity\Proprietaires;
use App\Entity\Visiter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DATE_VISITE',DateTimeType::class)
            ->add('idPro', EntityType::class, [
                'class' => Proprietaires::class,
                'choice_label' => 'id',
            ])
            ->add('numappart', EntityType::class, [
                'class' => Appartements::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Visiter::class,
        ]);
    }
}
