Angie
=====

Laravel-Angular routing manager. Generates angular routing rules from serverside routing rules and services.

https://packagist.org/packages/moszkva/angie

#Features#

- Generates angular routing rules from serverside routing rules
- Generates angular services for basic data transfer.
- Namespace resolving in controller's name.


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
	return Angie::renderRouterProviderStatment('<YourAppName>', '/angie/test');
});

Route::get('angie/get/services', function()
{
	return Angie::renderServices('<YourAppName>');
});


// Angie END


```

and you must place these in your index.html after each other angular scripts:

```html
<!--Angie BEGIN-->
<script src="angie/get/routing"></script>
<script src="angie/get/services"></script>
<!--Angie END-->
```

##How works the angie?##

- Generates angular routeprovider statment. Above example:
```javascript
<YourAppName>.config(['$routeProvider',
    function($routeProvider) {
            $routeProvider
			.when("/angie/test",{"controller":"AngieTestController","templateUrl":"angie/test"})
			.when("/angie/test/create",{"controller":"AngieTestController","templateUrl":"angie/test/create"})
			.when("/angie/test/:test",{"controller":"AngieTestController","templateUrl":"angie/test/' + $routeParams.test + '"})
			.when("/angie/test/:test/edit",{"controller":"AngieTestController","templateUrl":"angie/test/' + $routeParams.test + '/edit"})
			.when("//",{"controller":"TestController","templateUrl":"/"})
			.otherwise({"redirectTo":"/angie/test"})}]);

```

- Generates angular services for basic data transfer:
```javascript
var <YourAppName>Services= angular.module('<YourAppName>Services', ['ngResource']);

AngieTestControllerService.insert;		
AngieTestControllerService.update(properties);
AngieTestControllerService.delete(id);
AngieTestControllerService.show(id);

```

Very important constraint for valid service generation:
- Laravel routing rules by controller must be unique.
Example:

Valid configuration (AnotherAngieTestController is subclass of AngieTestController):
```php
Route::resource('angie/test', 'AngieTestController');
Route::resource('angie/test2', 'AnotherAngieTestController');

```
Invalid configuration:

```php
Route::resource('angie/test', 'AngieTestController');
Route::resource('angie/test2', 'AngieTestController');

```

Namespace resolving:


	Laravel route rule:

		Route::resource('/test', 'Test\Angie\TestController')
		
	Controller name in generated routprovider statement:
	
		TestAngieTestController
		
	Service name in generated service statement:
	
		TestAngieTestControllerService
	
		
		
		
	

	





