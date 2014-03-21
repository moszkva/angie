<?php 
namespace Moszkva\Angie\Test;

use \Moszkva\Angie\LaravelRouteParser;

class LaravelRouteParserTest extends \TestCase
{
	public function setUp()
	{
		parent::setUp();

		\Route::resource('/test', 'AngieTestController');
		\Route::resource('/test2', 'AngieTest2Controller', array('only' => array('index', 'show', 'post')));
		\Route::get('/test3', 'AngieTestController3@someGetMethod');
		\Route::get('/test/test3', 'AngieTestController3@someShowMethod');
		\Route::put('/test3/{id}/edit', 'AngieTestController3@somePutMethod');
		
		
		\Route::get('/test4/{id}/edit', array('prefix' => 'testprefix', 'uses' => 'AngieTestController4@someGetMethod'));
	}
	
	public function testGetRouteCollection()
	{
		$parser = new LaravelRouteParser();
		
		$routeCollection = $parser->getRouteCollection();
		
		$controllersURLs = array();
		
		foreach($routeCollection as $route)
		{
			$controllersURLs[$route->getController()][] = $route->getURI();
		}
		
		// URL test
		
		$this->assertContains('test/:test/edit', $controllersURLs['AngieTestController']);
		$this->assertContains('test', $controllersURLs['AngieTestController']);
		$this->assertContains('test3', $controllersURLs['AngieTestController3']);
		$this->assertContains('test/test3', $controllersURLs['AngieTestController3']);
		
		$this->assertNotContains('/test3/:id/edit', $controllersURLs['AngieTestController3']);
		$this->assertNotContains('/test2/:test2', $controllersURLs['AngieTest2Controller']);
		
		$this->assertContains('testprefix/test4/:id/edit', $controllersURLs['AngieTestController4']);
	}
	
	public function testGetMethodsByController()
	{
		$parser = new LaravelRouteParser();
		
		$this->assertContains('GET', $parser->getMethodsByController('AngieTestController'));
		$this->assertContains('POST', $parser->getMethodsByController('AngieTestController'));
		$this->assertContains('DELETE', $parser->getMethodsByController('AngieTestController'));
		$this->assertContains('PUT', $parser->getMethodsByController('AngieTestController'));
	}
}

?>