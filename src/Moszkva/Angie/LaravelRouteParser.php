<?php 

namespace Moszkva\Angie;

class LaravelRouteParser
{
	/**
	 * @return \Moszkva\Angie\RouteCollection
	 */
	public function getRouteCollection($onlyGetMethod = false)
	{
		$routeCollection	= new RouteCollection();
		
		foreach(\Route::getRoutes() as $route)
		{
			$action = $route->getAction();

			if(($onlyGetMethod || in_array('GET', $route->methods())) && isset($action['controller']))
			{
				$method			 = current($route->methods());
				$params			 = $route->parameterNames();
				$URI			 = $this->getURIbyParams($route->getUri(), $params);
				$templateURL	 = $this->getTemplateURLFromURI($URI, $params);

				$routeCollection[]	= new RouteCollectionItem($URI, $templateURL, $this->getControllerNameByAction($action['controller']), $this->getActionNameByAction($action['controller']), $method,$params);
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
				
				if( $this->getControllerNameByAction($action['controller'])==$controller)
				{					
					$methods = array_merge($methods, $route->methods());
				}
			}
		}
		
		return $methods;
	}
	
	private function getControllerNameByAction($action)
	{
		$controllerParts = explode('@', $action);
		
		return trim(str_replace('\\', '', $controllerParts[0]));
	}
	
	private function getActionNameByAction($action)
	{
		$controllerParts = explode('@', $action);
		
		return $controllerParts[1];
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
			$uri	 = str_replace(':'.$param, '" + params.'.$param.' + "', $uri);
		}
		
		return $uri; 
	}
}

?>