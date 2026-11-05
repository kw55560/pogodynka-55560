<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => function (Location $location) {
                    return sprintf('%s (%s)', $location->getCity(), $location->getCountry());
                },
                'placeholder' => 'Wybierz lokalizację',
                'label' => 'Lokalizacja',
                'disabled' => $options['is_edit'],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Data pomiaru',
            ])
            ->add('celsius', NumberType::class, [
                'label' => 'Temperatura (°C)',
                'scale' => 1,
            ])
            ->add('humidity', IntegerType::class, [
                'label' => 'Wilgotność (%)',
                'required' => false,
            ])
            ->add('windSpeed', NumberType::class, [
                'label' => 'Prędkość wiatru (m/s)',
                'scale' => 1,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
            'is_edit' => false,
        ]);

        $resolver->setAllowedTypes('is_edit', 'bool');
    }
}
