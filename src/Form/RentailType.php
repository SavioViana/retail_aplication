<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Rentail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RentailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_rentail')
            ->add('date_devolution')
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Locado' => 0,
                    'Devolvido' => 1,
                ],
                'expanded' => true
            ])
            ->add('car',  EntityType::class, [
                'class' => Car::class,
                'choice_label' => 'name',
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name',
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
