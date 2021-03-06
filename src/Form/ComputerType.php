<?php

namespace App\Form;

use App\Entity\Component;
use App\Entity\Computer;
use App\Entity\Device;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComputerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('price', MoneyType::class, [
                'currency' => 'EUR',
                'divisor' => 100,
            ])
            ->add('type', ChoiceType::class, [
                'choices' => Computer::AVAILABLE_TYPES,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('devices', EntityType::class, [
                'class' => Device::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('components', EntityType::class, [
                'class' => Component::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Computer::class,
        ]);
    }
}
