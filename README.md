Angie
=====

Laravel-Angular routing manager. Generates angular routing rules from serverside routing rules and services.

https://packagist.org/packages/moszkva/angie

#Features#

- Generates angular routing rules from serverside routing rules
- Generates angular services for basic data transfer.


##Installation##

Installation via composer

```json
{
   "require-dev": {
        "moszkva/angie": "dev-master"
   }
}
```


##Usage##

After installation you must register AngieServiceProvider in your config/app.php:

```php

'providers' => array(....,
                     ....,
                     'Moszkva\Angie\AngieServiceProvider'),
'aliases' => array(.....,
                   .....,
                    'Angie'	=> 'Moszkva\Angie\Facades\Angie'));

```

and you must register routing rules for angie:

```php

// Angie BEGIN

Route::get('angie/get/routing', function()
{
	return Angie::renderRouterProviderStatment('BrainMachineApp', '/angie/test');
});

Route::get('angie/get/services', function()
{
	return Angie::renderServices('BrainMachineApp');
});

// Optional for testing

Route::resource('angie/test', 'AngieTestController');

// Angie END


```






