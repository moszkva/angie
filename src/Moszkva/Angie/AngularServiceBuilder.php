<?php 

namespace Moszkva\Angie;

class AngularServiceBuilder
{
	private $appName;
	private $container	= array('service' => array());
	private $methods	= array('POST', 'PUT', 'DELETE', 'GET');
	
	public function __construct($appName)
	{
		$this->appName = $appName;
	}
	
	public static function create($appName)
	{
		return new static($appName);
	}
	
	public function addService(RouteCollectionItem $route, $methods = array('GET'))
	{
		$uri = $route->getURI();
		
		if($route->getURI()=='/')
		{
			$uri = '';
		}
		
		$data = array('uri' => $uri, 'controller' => $route->getController(), 'methods' => array());
		
		foreach($this->methods as $method)
		{
			if(in_array($method, $methods))
			{
				$data['methods'][$method] = TRUE;
			}
			else
			{
				$data['methods'][$method] = FALSE;
			}
		}
		
		$this->container['service'][] = $data; 
		
		return $this;
	}

	public function render()
	{
		$data = array('services' => array(), 'appName' => $this->appName);
		
		foreach($this->container['service'] as $service)
		{
			$data['services'][] = \View::make('angie::AngularService', array('appName' => $this->appName, 'url' => $service['uri'], 'controller' => $service['controller'], 'methods' => $service['methods'])).PHP_EOL;
		}
		
		return \View::make('angie::AngularServices', $data);
	}
}

?>