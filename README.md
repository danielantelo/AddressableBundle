Symfony2 Addressable Bundle
===========================

This is a Symfony2 bundle which facilitates making entities addressable and geo location aware.

It includes a google map form type to search and set addresses (including lat/lng), and a service helper to ease
calculating distances, sorting and filtering within a radius, objects with latitude and longitude.


Installation
------------

Add the following to composer.json:

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

Include the twig template for the type layout.

```yaml
# app/config/config.yml

twig:
    form_themes:
          - AddressableBundle:Form:fields.html.twig
```

Now your entity or document must:
1. implement the included AddressableInterface 
2. use the relevant trait (ORM or PHPCR version) or manually reproduce the required fields, getters and setters

```php
    namespace Your\Project\Entity;

    use Addressable\Bundle\Model\AddressableInterface;
    use Addressable\Bundle\Model\Traits\ORM\AddressableTrait;

    class YourEntity implements AddressableInterface
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

// if you are using standard symfony form type
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('address', AddressMapType::class, array(
            'google_api_key' => 'yourKeyHere'
        ))
    ...
}

// if you are using Sonata Admin
protected function configureFormFields(FormMapper $formMapper)
{
    $formMapper
        ->with('Location')
            ->add('address', AddressMapType::class, array(
                'google_api_key' => 'yourKeyHere'
            ))
        ->end()
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
     AddressMapType::class,
     array(
        'google_api_key' => 'yourKeyHere',
         'map_width' => '100%',    // the width of the map
         'map_height' => '300px',  // the height of the map
         'default_lat' => 51.5,    // the starting position on the map
         'default_lng' => -0.1245, // the starting position on the map
         'include_current_position_action' => true, // whether to include the set current position button
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

Further Customization
---------------------

If you don't want the bundle to use it's own script you can override the *address_map_scripts* block to be empty; and
then simply copy and paste the javascript in vendor/daa/addressable-bundle/Resources/public/js/address_map.js
to your own js files.

To add additional functionality after address updates, simply override the block *address_map_callback* and extend to add
the additional functionality (or make it empty and define var gmap_callback in your js code).

```
    {% block address_map_callback %}
        <script>
            var gmap_callback = function(location, gmap){
                // your callback code here
            }
        </script>
    {% endblock %}

```


Screenshot
----------

Sonata implementation:

![View screenshot](https://raw.githubusercontent.com/danielanteloagra/AddressableBundle/master/screenshot.png)


Geospatial Helper Service
-------------------------

From your controller you can get the the *addressable_bundle.geospatial_helper* service; from anywhere else you
can instantiate the GeospatialHelper class directly.

Examples:

```
  public function symfonyControllerAction()
  {
      $helper = $this->get('addressable_bundle.geospatial_helper');

      $centerPoint = new YourEntity(); // must implement AddressableInterface or GeoPointInterface
      $point1 = new YourEntity(); // must implement AddressableInterface or GeoPointInterface
      $point2 = new YourEntity(); // must implement AddressableInterface or GeoPointInterface
      $points = array($point1, $point2);

      // getting distance in KM between two points
      $distanceInKm = $helper->getDistanceBetweenPoints($point1, $point2);

      // filtering an array of points by radius from a center point
      $pointsWithinRadius = $helper->filterPointsWithinRadius($centerPoint, $points, $radius);

      // sort an array of addressable objects to be ordered by distance from a center point
      $orderedPoints = $helper->sortAroundCenterPoint($centerPoint, $points);
  }
```
