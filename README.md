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
         'map_width' => '100%',    // the width of the map
         'map_height' => 300,      // the height of the map
         'default_lat' => 51.5,    // the starting position on the map
         'default_lng' => -0.1245, // the starting position on the map
         'include_jquery' => false,      // whether to include jquery
         'include_gmaps_js' => true,     // whether to include maps script
         'include_current_position_action' => false, // whether to include the set current position button
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
     )
);
```


Screenshot
----------

Sonata implementation:

![View screenshot](https://raw.githubusercontent.com/danielanteloagra/AddressableBundle/master/screenshot.png)
