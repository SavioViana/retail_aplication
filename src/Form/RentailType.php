<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Rentail;
use App\Repository\CarRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RentailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('date_rentail',  DateType::class, [
        //         'label' => 'Data de Locação',
        //        'widget' => 'single_text',
        //     ])
        //     ->add('car',  EntityType::class, [
        //         'class' => Car::class,
        //         'query_builder' => function (CarRepository $er) {
        //             return $er->createQueryBuilder('c')
        //                 ->where('c.status = 0');
        //         },
        //         'choice_label' => function ($car) {
        //             return  $car->getBrand()->getName() . ' ' . $car->getModel() . ' - ' . $car->getYear();
        //         },
        //         'label' => 'Carro'
        //     ])
        //     ->add('client', EntityType::class, [
        //         'class' => Client::class,
        //         'choice_label' => 'name',
        //         'label' => 'Cliente'
        //     ])
        // ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $rentail = $event->getData();
            $form = $event->getForm();

        
    
            // // checks if the Product object is "new"
            // // If no data is passed to the form, the data is "null".
            // // This should be considered a new "Product"
            if ($rentail && $rentail->getId()) {

                $form->add('date_devolution',  DateType::class, [
                'label' => 'Data de devolução',
                'widget' => 'single_text',
                'constraints' => [ new NotBlank()]
                ]);
            }  else {
                $form->add('date_rentail',  DateType::class, [
                    'label' => 'Data de Locação',
                   'widget' => 'single_text',
                ])
                ->add('car',  EntityType::class, [
                    'class' => Car::class,
                    'query_builder' => function (CarRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->where('c.status = 0');
                    },
                    'choice_label' => function ($car) {
                        return  $car->getBrand()->getName() . ' ' . $car->getModel() . ' - ' . $car->getYear();
                    },
                    'label' => 'Carro'
                ])
                ->add('client', EntityType::class, [
                    'class' => Client::class,
                    'choice_label' => 'name',
                    'label' => 'Cliente'
                ]);

            }

          
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rentail::class,
        ]);
    }
}
