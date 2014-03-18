<?php namespace Moszkva\Angie\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Angie extends Facade
{ 
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{ 
		return 'angie'; 
	}
 
}

?>