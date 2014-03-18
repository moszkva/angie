<?php

namespace Moszkva\Angie\Test;

use Moszkva\Angie\RouteCollection;
use Moszkva\Angie\RouteCollectionItem;

class RouteCollectionTest extends \TestCase
{
	public function testOffsetSet()
	{
		$RouteCollection = new RouteCollection();
		
		$RouteCollection[] = 'test';
		
		$this->assertTrue(isset($RouteCollection[0]));
		
		$RouteCollection['test'] = 'test';
		
		$this->assertTrue(isset($RouteCollection['test']));
		
		unset($RouteCollection['test']);
		
		$this->assertTrue(!isset($RouteCollection['test']));
		
		$RouteCollection['test'] = 'test';
		
		$this->assertEquals('test', $RouteCollection['test']);
	}
}

?>