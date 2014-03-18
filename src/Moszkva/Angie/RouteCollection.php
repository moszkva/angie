<?php namespace Moszkva\Angie;

class RouteCollection  implements \IteratorAggregate, \ArrayAccess
{
	private $container;
	
	public function getIterator()
	{
		return new \ArrayIterator($this->container);
	}
	
    public function offsetSet($offset, $value) 
	{
        if (is_null($offset))
		{
            $this->container[] = $value;
        } 
		else 
		{
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset) 
	{
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) 
	{
        unset($this->container[$offset]);
    }
    public function offsetGet($offset)
	{
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

	
}

?>