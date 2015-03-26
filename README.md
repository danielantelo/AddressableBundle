Symfony2 Addressable Bundle
===========================

This is a Symfony2 bundle which facilitates making entities addressable and geo location aware.

It includes a google map form type to search and set addresses (including lat/lng).


Status
------

Under development.

Next steps:

- Add Bing map option/alternative
- Geo-location awareness (search by radius, distance calculator, route mapping, etc)


Installation
------------

Add the following to ``:

```yaml
#composer.json

"require": {
    ...
    "daa/addressable-bundle": "dev-master"
}
```

Register the bundle in your `app/AppKernel.php`:

```php
new Addressable\Bundle\AddressableBundle(),
```

Add the bundle to assetic in your config file:

```yaml
# app/config/config.yml
  
# Assetic Configuration
assetic:
    bundles: [ 'AddressableBundle' ]
```

Include the twig template for the type layout.

```yaml
# app/config/config.yml

twig:
    form:
        resources:
            - 'AddressableBundle:Form:fields.html.twig'
```

Now your entity or document must:
1. implement the included AddressableInterface 
2. use the relevant trait (ORM or PHPCR version) or manually reproduce the required fields, getters and setters

```php
    namespace Your\Project\Entity;

    use Addressable\Bundle\Model\AddressableInterface;
    use Addressable\Bundle\Model\Traits\ORM\AddressableTrait;

    class YourEntity implementes AddressableInterface 
    {

        use AddressableTrait;
        
        /**
         * @ORM\Column(type="text")
         */
        protected $yourOtherField;
        
        ...
        
    }
```

Note, if you are using an older version of PHP which does not support traits, then you are forced to copy the trait code manually into your entity.

Once your entity is setup, we can add the address map selector to your forms in the following ways:

```php

// if you are using Sonata Admin
protected function configureFormFields(FormMapper $formMapper)
{
    $formMapper
        ->with('Location')
            ->add('address', 'address_map_type', array())
        ->end()
        ...
}

// if you are using standard symfony form type
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('address', 'address_map_type', array())
    ...
}

```

Note: if using address as a child or relation remember to set the 'data_class' options pointing to the Address object.

Options
-------

We can override several options:

```php
->add(
    'address',
    'addressable_type',
    array(
        'type' => 'text',  // the types to render the lat and lng fields as
        'latlng_type' => 'hidden',  // the types to render the lat and lng fields as
        'options' => array('read_only' => true), // default options for all fields
        'streetnumber_options' => array(),   // the options for just the street number field
        'streetname_options' => array(),   // the options for just the street name field
        'city_options' => array(),   // the options for just the city field
        'country_options' => array(),   // the options for just the country field
        'zipcode_options' => array(),   // the options for just the zip code field
        'lat_options' => array(),   // the options for just the lat field
        'lng_options' => array(),    // the options for just the lng field
        'error_bubbling' => false,
        'map_width' => '100%',  // the width of the map
        'map_height' => 300,     // the height of the map
        'default_lat' => 51.5,    // the starting position on the map
        'default_lng' => -0.1245, // the starting position on the map
        'include_jquery' => false,   // include jquery if needed
        'include_gmaps_js' => true,     // include google maps js if needed
        'include_current_pos_link' => false, // show use my current location button
        'country_field' => 'country', // country field name to use
        'zipcode_field' => 'zipCode', // zipcode field name to use
        'streetnumber_field' => 'streetNumber', // country field name to use
        'streetname_field' => 'streetName', // street name field name to use
        'city_field' => 'city', // city field name to use
        'lat_field' => 'latitude', // lat field name to use
        'lng_field' => 'longitude' // lng field name to use
    )
)
```


Screenshot
----------

Sonata implementation:

![View screenshot](https://raw.githubusercontent.com/danielanteloagra/AddressableBundle/master/screenshot.png)
