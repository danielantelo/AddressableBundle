GmapFormTypeBundle
==================

This is a Symfony2 bundle which facilitates making entities addressable.

It includes a google map form type to set address (including lat/lng) by searching.


Status
------

Under development.

Next steps:

- Add Bing map option/alternative
- GeoLocation awareness (search by radius, distance calculator, route mapping, etc)


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

Now make the entity you want to make addressable implement the included AddressableInterface and use the relevant trait (ORM or PHPCR version) or manually implement the specified fields in your entity.

```php
    namespace Your\Project;

    use Addressable\Bundle\Model\AddressableInterface;
    use Addressable\Bundle\Model\ORM\AddressableTrait;

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
