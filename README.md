GmapFormTypeBundle
==================

This is a Symfony2 bundle which facilitates making entities addressable and geo location aware.

It includes a map form type to set address by searching  in a google map.


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

Register the bundle in your app/AppKernel.php:

```php
new Daa\AddressableBundle\DaaAddressableBundle(),
```

Add the bundle to assetic in your config file:

```yaml
# app/config/config.yml
  
# Assetic Configuration
assetic:
    bundles: [ 'DaaAddressableBundle' ]
```

Include the twig template for the type layout.

```yaml
# app/config/config.yml

twig:
    form:
        resources:
            - 'DaaAddressableBundle:Form:fields.html.twig'
```


Usage
-----

Now make the entity you want to make addressable implement the included AddressableInterface and use the relevant trait (ORM or PHPCR version) or manually implement the specified fields in your entity.

```php
    namespace Your\Project;

    use Daa\AddressableBundle\Model\AddressableInterface;
    use Daa\AddressableBundle\Model\ORM\AddressableTrait;

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
            ->add('address', 'addressable_type', array())
        ->end()
        ...
}

// if you are using standard symfony form type
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('address', 'addressable_type', array())
    ...
}

```

![View screenshot](https://raw.githubusercontent.com/danielanteloagra/addressable-bundle/master/screenshot.png)