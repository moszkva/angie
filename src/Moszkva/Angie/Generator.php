<?php namespace Moszkva\Angie;

class Generator
{
	public function renderRouterProviderStatment($appName, $otherwise = '')
	{
		$routerParser	= new LaravelRouteParser();		
		$builder		= new AngularRouteProviderBuilder($appName);
		
		foreach($routerParser->getRouteCollection() as $route)
		{
			$builder->whenStatement($route);
		}
		
		if($otherwise!='')
		{
			$builder->otherwiseStatement($otherwise);
		}
		
		return $builder->render();
	}
	
	public function renderServices($appName)
	{
		$routerParser	= new LaravelRouteParser();		
		$builder		= new AngularServiceBuilder($appName);

		foreach($routerParser->getRouteCollection(true) as $route)
		{
			$builder->addService($route);
		}
		
		return $builder->render();
	}
}

?>