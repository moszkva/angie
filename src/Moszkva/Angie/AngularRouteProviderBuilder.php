<?php namespace Moszkva\Angie;

class AngularRouteProviderBuilder
{
	private $appName;
	private $container = array('when' => array(), 'otherwise' => array());
	
	public function __construct($appName)
	{
		$this->appName = $appName;
	}
	
	public static function create($appName)
	{
		return new static($appName);
	}
	
	public function whenStatement(RouteCollectionItem $route)
	{
		$this->container['when'][] = array('uri' => $route->getURI(), 'templateUrl' => $route->getTemplateURL(), 'controller' => $route->getController()); 
		
		return $this;
	}
	
	public function otherwiseStatement($redirectURL)
	{
		$this->container['otherwise'][] = array('uri' => $redirectURL); 		
		
		return $this;
	}
	
	public function render()
	{
		$data = array('whenStatments' => array(), 'otherwise' => '', 'appName' => $this->appName);
		
		foreach($this->container['when'] as $statement)
		{
			$data['whenStatements'][] = \View::make('angie::AngularWhenStatement', $statement);
		}
		
		if(isset($this->container['otherwise'][0]))
		{
			$data['otherwise'] = \View::make('angie::AngularOtherwiseStatement', $this->container['otherwise'][0]);
		}
		
		return \View::make('angie::AngularRouteProvider', $data);
	}
}

?>