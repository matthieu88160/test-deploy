<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Brand;
use App\Entity\Seat;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('color', TextType::class)
            ->add('model', TextType::class)
            ->add(
                'brand',
                EntityType::class,
                [
                    'class' => Brand::class,
                    'choice_label' => 'name'
                ]
            )->add(
                'seats',
                EntityType::class,
                [
                    'class' => Seat::class,
                    'choice_label' => 'label',
                    'multiple' => true,
                    'expanded' => true
                ]
            );

        if ($options['standalone']) {
            $builder->add('submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Car::class,
                'standalone' => false
            ]
        );
    }
}
