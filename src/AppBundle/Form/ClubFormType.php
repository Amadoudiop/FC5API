<?php

namespace AppBundle\Form;

//use AppBundle\Entity\Stadium;
//use AppBundle\Entity\Jersey;
//use AppBundle\Form\JerseyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Count;

class ClubFormType extends SimpleFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => '2', 'max' => '50']),
                    ],
                ]
            )
            ->add(
                'shortName',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => '2', 'max' => '3']),
                    ],
                ]
            )
            ->add('owner', TextType::class)
            ->add(
                'blazon',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'jerseys',
                CollectionType::class,
                [
                    'entry_type' => JerseyType::class,
                    'allow_add' => true,
                    'by_reference' => false,
                    'constraints' => [
                        new Count(['min' => 2]),
                    ],
                ]
            )
            ->add(
                'stadium',
                StadiumType::class,
                [
                    'constraints' => [
                        new NotBlank()
                    ],
                ]
            )
            ->add(
                'user',
                null,
                [
                    'constraints' => [

                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Club',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_club';
    }
}
