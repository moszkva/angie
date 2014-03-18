<?php namespace Moszkva\Angie;

class RouteCollectionItem
{
	/**
	 * @var string 
	 */
	private $URI;
	
	/**
	 * @var string 
	 */
	private $templateURL;
	
	/**
	 * @var string
	 */
	private $controller;
	
	/**
	 * @var array
	 */
	private $parameters;
	
	/**
	 * @param string $URI
	 * @param string $templateURL
	 * @param string $controller
	 * @param array $parameters
	 */
	public function __construct($URI, $templateURL, $controller, $parameters = array())
	{
		$this->URI			= $URI;
		$this->templateURL	= $templateURL;
		$this->controller	= $controller;
		$this->parameters	= $parameters;
	}
	
	public function getURI()
	{
		return $this->URI;
	}

	public function getTemplateURL()
	{
		return $this->templateURL;
	}

	public function getController()
	{
		return $this->controller;
	}

	public function getParameters()
	{
		return $this->parameters;
	}
	
}

?>