<?php

namespace Addressable\Bundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Form type for adding a map to select a full address.
 */
class AddressMapType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add($options['street_number_field']['name'], $options['street_number_field']['type'], $options['street_number_field']['options'])
            ->add($options['street_name_field']['name'], $options['street_name_field']['type'], $options['street_name_field']['options'])
            ->add($options['city_field']['name'], $options['city_field']['type'], $options['city_field']['options'])
            ->add($options['country_field']['name'], $options['country_field']['type'], $options['country_field']['options'])
            ->add($options['zipcode_field']['name'], $options['zipcode_field']['type'], $options['zipcode_field']['options'])
            ->add($options['latitude_field']['name'], $options['latitude_field']['type'], $options['latitude_field']['options'])
            ->add($options['longitude_field']['name'], $options['longitude_field']['type'], $options['longitude_field']['options'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'map_width' => '100%',    // the width of the map
            'map_height' => 300,      // the height of the map
            'default_lat' => 51.5,    // the starting position on the map
            'default_lng' => -0.1245, // the starting position on the map
            'include_jquery' => false,      // whether to include jquery
            'include_gmaps_js' => true,     // whether to include maps script
            'include_current_position_action' => false, // whether to include the current position button
            'street_number_field' => array(
                'name' => 'streetNumber',
                'type' => 'text',
                'options' => array(
                    'required' => true
                )
            ),
            'street_name_field' => array(
                'name' => 'streetName',
                'type' => 'text',
                'options' => array(
                    'required' => true
                )
            ),
            'city_field' => array(
                'name' => 'city',
                'type' => 'text',
                'options' => array(
                    'required' => true
                )
            ),
            'zipcode_field' => array(
                'name' => 'zipCode',
                'type' => 'text',
                'options' => array(
                    'required' => true
                )
            ),
            'country_field' => array(
                'name' => 'country',
                'type' => 'text',
                'options' => array(
                    'required' => true
                )
            ),
            'latitude_field' => array(
                'name' => 'latitude',
                'type' => 'hidden',
                'options' => array(
                    'required' => false
                )
            ),
            'longitude_field' => array(
                'name' => 'longitude',
                'type' => 'hidden',
                'options' => array(
                    'required' => false
                )
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // fields
        $view->vars['lat_field'] = $options['latitude_field']['name'];
        $view->vars['lng_field'] = $options['longitude_field']['name'];
        $view->vars['country_field'] = $options['country_field']['name'];
        $view->vars['zipcode_field'] = $options['zipcode_field']['name'];
        $view->vars['streetnumber_field'] = $options['street_number_field']['name'];
        $view->vars['streetname_field'] = $options['street_name_field']['name'];
        $view->vars['city_field'] = $options['city_field']['name'];
        // conf
        $view->vars['map_width'] = $options['map_width'];
        $view->vars['map_height'] = $options['map_height'];
        $view->vars['default_lat'] = $options['default_lat'];
        $view->vars['default_lng'] = $options['default_lng'];
        $view->vars['include_jquery'] = $options['include_jquery'];
        $view->vars['include_gmaps_js'] = $options['include_gmaps_js'];
        $view->vars['include_current_position_action'] = $options['include_current_position_action'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'address_map_type';
    }
}
