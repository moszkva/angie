<?php

use Moszkva\Angie\Generator;

Route::get('angie/get/routing', function()
{
    $generator	= new Generator();
	
	$generator->renderRouterProviderStatment($appName);
});

Route::get('angie/get/services', function()
{
    $generator	= new Generator();
	
	$generator->renderRouterProviderStatment($appName);
});

?>