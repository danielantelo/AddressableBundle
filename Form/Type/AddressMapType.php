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
            ->add($options['country_field'], $options['type'], $options['options'])
            ->add($options['zipcode_field'], $options['type'], $options['options'])
            ->add($options['streetnumber_field'], $options['type'], array_merge($options['options'], $options['streetnumber_options']))
            ->add($options['streetname_field'], $options['type'], $options['options'])
            ->add($options['city_field'], $options['type'], $options['options'])
            ->add($options['lat_field'], $options['latlng_type'], array_merge($options['options'], $options['latlng_options']))
            ->add($options['lng_field'], $options['latlng_type'], array_merge($options['options'], $options['latlng_options']))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'type' => 'text',  // the types to render the lat and lng fields as
            'latlng_type' => 'hidden',  // the types to render the lat and lng fields as
            'options' => array('read_only' => false), // the options for all fields
            'latlng_options' => array('read_only' => true),   // the options for just the lat field
            'error_bubbling' => false,
            'map_width' => '100%',  // the width of the map
            'map_height' => 300,     // the height of the map
            'default_lat' => 51.5,    // the starting position on the map
            'default_lng' => -0.1245, // the starting position on the map
            'include_jquery' => false,   // jquery needs to be included above the field (ie not at the bottom of the page)
            'include_gmaps_js' => true,     // is this the best place to include the google maps javascript?
            'include_current_pos_link' => false,
            'country_field' => 'country',
            'zipcode_field' => 'zipCode',
            'streetnumber_field' => 'streetNumber',
            'streetname_field' => 'streetName',
            'city_field' => 'city',
            'lat_field' => 'latitude',
            'lng_field' => 'longitude',
            'streetnumber_options' => array('required' => false)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // fields
        $view->vars['lat_field'] = $options['lat_field'];
        $view->vars['lng_field'] = $options['lng_field'];
        $view->vars['country_field'] = $options['country_field'];
        $view->vars['zipcode_field'] = $options['zipcode_field'];
        $view->vars['streetnumber_field'] = $options['streetnumber_field'];
        $view->vars['streetname_field'] = $options['streetname_field'];
        $view->vars['city_field'] = $options['city_field'];
        // conf
        $view->vars['map_width'] = $options['map_width'];
        $view->vars['map_height'] = $options['map_height'];
        $view->vars['default_lat'] = $options['default_lat'];
        $view->vars['default_lng'] = $options['default_lng'];
        $view->vars['include_jquery'] = $options['include_jquery'];
        $view->vars['include_gmaps_js'] = $options['include_gmaps_js'];
        $view->vars['include_current_pos_link'] = $options['include_current_pos_link'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'address_map_type';
    }
}
