<?php

namespace Addressable\Bundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for adding a map to select a full address.
 */
class ContactDetailsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                $options['email_field']['name'],
                $options['email_field']['type'],
                $options['email_field']['options']
            )
            ->add(
                $options['phone_field']['name'],
                $options['phone_field']['type'],
                $options['phone_field']['options']
            )
            ->add(
                $options['fax_field']['name'],
                $options['fax_field']['type'],
                $options['fax_field']['options']
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'email_field' => array(
                'name' => 'email',
                'type' => TextType::class,
                'options' => array(
                    'required' => false
                )
            ),
            'phone_field' => array(
                'name' => 'phoneNumber',
                'type' => TextType::class,
                'options' => array(
                    'required' => false
                )
            ),
            'fax_field' => array(
                'name' => 'fax',
                'type' => TextType::class,
                'options' => array(
                    'required' => false
                )
            ),
        ));
    }

    public function getBlockPrefix()
    {
        return $this->getName();
    }

    public function getName()
    {
        return '';
    }
}
