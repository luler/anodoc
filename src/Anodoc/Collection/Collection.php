<?php

namespace Anodoc\Collection;

class Collection implements \ArrayAccess, \Countable, \SeekableIterator
{

    private $store = array();

    function __construct(array $array = array())
    {
        $this->store = array_merge($this->store, $array);
    }

    #[\ReturnTypeWillChange]
    function offsetExists($key): bool
    {
        return isset($this->store[$key]);
    }

    #[\ReturnTypeWillChange]
    function offsetGet($key)
    {
        return $this->store[$key];
    }

    #[\ReturnTypeWillChange]
    function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->store[] = $value;
        } else {
            $this->store[$key] = $value;
        }
    }

    function isKeySet($key)
    {
        return $this->offsetExists($key);
    }

    #[\ReturnTypeWillChange]
    function offsetUnset($key)
    {
        unset($this->store[$key]);
    }

    #[\ReturnTypeWillChange]
    function seek($position)
    {
        if (isset($this->store[$position])) {
            return $this->store[$position];
        }
        throw new \OutOfBoundsException("Invalid seek position ($position)");
    }

    function length()
    {
        return $this->count();
    }

    function get($key)
    {
        return $this->offsetGet($key);
    }

    #[\ReturnTypeWillChange]
    function count()
    {
        return count($this->store);
    }

    #[\ReturnTypeWillChange]
    function rewind()
    {
        reset($this->store);
    }

    #[\ReturnTypeWillChange]
    function current()
    {
        return current($this->store);
    }

    #[\ReturnTypeWillChange]
    function key()
    {
        return key($this->store);
    }

    #[\ReturnTypeWillChange]
    function next()
    {
        next($this->store);
    }

    #[\ReturnTypeWillChange]
    function valid()
    {
        return key($this->store) !== null;
    }

    function isEmpty()
    {
        return empty($this->store);
    }

}