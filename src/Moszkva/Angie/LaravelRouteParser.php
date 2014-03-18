<?php 

namespace Moszkva\Angie;

class LaravelRouteParser
{
	/**
	 * @return \Moszkva\Angie\RouteCollection
	 */
	public function getRouteCollection()
	{
		$routeCollection	= new RouteCollection();
		
		foreach(\Route::getRoutes() as $route)
		{
			$action = $route->getAction();
			
			if(in_array('GET', $route->methods()) && isset($action['controller']))
			{
				$params			 = $route->parameterNames();
				$controllerParts = explode('@', $action['controller']);
				$URI			 = $this->getURIbyParams($route->getUri(), $params);
				$templateURL	 = $this->getTemplateURLFromURI($URI, $params);

				$routeCollection[]	= new RouteCollectionItem($URI, $templateURL, $controllerParts[0], $params);
			}
		}
		
		return $routeCollection;
	}
	
	/**
	 * @param string $controller
	 * @return array
	 */
	public function getMethodsByController($controller)
	{
		$methods = array('GET');
		
		foreach(\Route::getRoutes() as $route)
		{
			if((!in_array('GET', $route->methods())))
			{
				$action = $route->getAction();
				
				$controllerParts = explode('@', $action['controller']);
				
				if($controllerParts[0]==$controller)
				{					
					$methods = array_merge($methods, $route->methods());
				}
			}
		}
		
		return $methods;
	}
	
	/**
	 * @param string $uri
	 * @param array $params
	 * @return type
	 */
	private function getURIbyParams($uri, array $params = array())
	{
		foreach($params as $param)
		{
			$uri = str_replace('{'.$param.'}', ':'.$param, $uri);
		}		
		
		return $uri;
	}
	
	/**
	 * @param string $uri
	 * @param array $params
	 * @return type
	 */
	private function getTemplateURLFromURI($uri, array $params = array())
	{
		foreach($params as $param)
		{
			$uri	 = str_replace(':'.$param, '\' + $routeParams.'.$param.' + \'', $uri);
		}
		
		return $uri; 
	}
}

?>