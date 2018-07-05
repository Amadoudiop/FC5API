<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;

class StadiumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add('currentCapacity',
                IntegerType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add('maximumCapacity',
                IntegerType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add('costPerGame',
                IntegerType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stadium'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_stadium';
    }
}
