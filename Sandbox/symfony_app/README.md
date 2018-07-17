symfony_app
===========

A fresh install of symfony using `symfony new my_project_name 3.4`

Instead of installing the bundle with composer, we link it in using the PSR loader conf:

```
    "psr-4": {
        "AppBundle\\": "src/AppBundle",
        "Addressable\\Bundle\\": "../../",
        "Daa\\Addressable\\Bundle\\": "../../"
    },
```

Run application:
    1. Execute the php bin/console server:run command.
    2. Browse to the http://localhost:8000 URL.
