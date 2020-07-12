<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Rentail;
use App\Repository\CarRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RentailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_rentail',  DateType::class, [
                'label' => 'Data de Locação',
               'widget' => 'single_text',
            ])
            ->add('date_devolution',  DateType::class, [
                'label' => 'Data de devolução',
                'widget' => 'single_text',
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Locado' => true,
                    'Devolvido' => false,
                ],
                'expanded' => true
            ])
            ->add('car',  EntityType::class, [
                'class' => Car::class,
                'choice_label' => function ($car) {
                    return  $car->getBrand()->getName() . ' ' . $car->getModel() . ' - ' . $car->getYear();
                },
                'label' => 'Carro'
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name',
                'label' => 'Cliente'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rentail::class,
        ]);
    }
}
