<?php

namespace App\Form;

use App\Entity\Appartements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifAppartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('numappart')
            ->add('typappart')
            ->add('loyer')
            ->add('etage')
            ->add('ascenceur')
            ->add('preavis')
            ->add('date_libre', null, [
                'widget' => 'single_text',
            ])
            ->add('rue')
            ->add('codeville')
            ->add('arrondissement')
            //->add('idLoc')
            //->add('idPro')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appartements::class,
        ]);
    }
}
