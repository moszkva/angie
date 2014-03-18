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
		
		$controllers = array();
		
		foreach($routerParser->getRouteCollection() as $route)
		{
			if(!in_array($route->getController(), $controllers))
			{
				$builder->addService($route, $routerParser->getMethodsByController($route->getController()));
			}
			
			$controllers[] = $route->getController();
		}
		
		return $builder->render();
	}
}

?>