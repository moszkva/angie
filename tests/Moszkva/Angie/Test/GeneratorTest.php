<?php 
namespace Moszkva\Angie\Test;

use \Moszkva\Angie\Generator;
use \Moszkva\Angie\AngieServiceProvider;
use \Moszkva\Angie\LaravelRouteParser;

class GeneratorTest extends \TestCase
{
	public function setUp()
	{
		parent::setUp();
		
		$AngieServiceProvider = new AngieServiceProvider($this->app);
		
		$AngieServiceProvider->boot();
		
		\Route::resource('/test', 'AngieTestController1');
		\Route::resource('/test2', 'AngieTest2Controller', array('only' => array('index', 'show', 'store')));
		\Route::get('/test3', 'AngieTestController3@someGetMethod');
		\Route::get('/test/test3', 'AngieTestController3@someShowMethod');
		\Route::put('/test3/{id}/edit', 'AngieTestController3@somePutMethod');
	}
	
	public function testrenderRouterProviderStatment()
	{
		$generator = new Generator();
		
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication'), 'testApplication.')!==FALSE);
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication'), 'when("/test"')!==FALSE);
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication'), 'when("/test/:test"')!==FALSE);
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication'), 'when("/test/test3"')!==FALSE);
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication', 'someWhere'), 'otherwise(')!==FALSE);
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication', 'someWhere'), '"redirectTo":"someWhere"')!==FALSE);		
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication'), 'when("/test3/:id/edit"')===FALSE);
		$this->assertTrue(strpos($generator->renderRouterProviderStatment('testApplication'), 'when("/test/test3",{"controller":"AngieTestController3","templateUrl":"test/test3"})')!==FALSE);
	}
	
	public function testRenderServices()
	{
		$generator	= new Generator();		
		$parser		= new LaravelRouteParser();
		
		$this->assertContains('GET', $parser->getMethodsByController('AngieTest2Controller'));
		$this->assertContains('POST', $parser->getMethodsByController('AngieTest2Controller'));	
		
		$this->assertTrue(strpos($generator->renderServices('testApplication'), 'testApplicationServices')!==FALSE);
		$this->assertTrue(strpos($generator->renderServices('testApplication'), 'testApplicationServices')!==FALSE);
		$this->assertTrue(strpos($generator->renderServices('testApplication'), 'var postURL="test"')!==FALSE);		
		$this->assertTrue(strpos($generator->renderServices('testApplication'), 'AngieTest2ControllerService')!==FALSE);		
		$this->assertTrue(strpos($generator->renderServices('testApplication'), 'var postURL="test2"')!==FALSE);
		
		$this->assertContains('GET', $parser->getMethodsByController('AngieTestController1'));
		$this->assertContains('POST', $parser->getMethodsByController('AngieTestController1'));
		$this->assertContains('DELETE', $parser->getMethodsByController('AngieTestController1'));
		$this->assertContains('PUT', $parser->getMethodsByController('AngieTestController1'));
	}
	
	
}

?>