<?php 

namespace Moszkva\Angie;

class AngularServiceBuilder
{
	private $appName;
	private $container	= array('service' => array());
	
	public function __construct($appName)
	{
		$this->appName = $appName;
	}
	
	public static function create($appName)
	{
		return new static($appName);
	}
	
	public function addService(RouteCollectionItem $route)
	{
		$uri	= $route->getURI();
		$method	= $route->getMethod();
		
		if($route->getURI()=='/')
		{
			$uri = '';
		}
		
		if($route->getMethod()=='GET' && $route->getAction()=='show')
		{
			$method = "SHOW";
		}	

		$this->container['service'][$route->getController()][] = array(	'URL'		=> $uri,
																		'method'	=> $method); 
		
		return $this;
	}

	public function render()
	{
		$data = array('services' => array(), 'appName' => $this->appName);
		
		foreach($this->container['service'] as $key => $service)
		{
			$datas = array('appName' => $this->appName, 'controller' => $key);
			
			foreach($service as $url)
			{
				$datas[strtolower($url['method']).'URL'] = $url['URL'];
			}
			
			$data['services'][] = \View::make('angie::AngularService', $datas).PHP_EOL;
	
		}
		
		return \View::make('angie::AngularServices', $data);
	}
}

?>