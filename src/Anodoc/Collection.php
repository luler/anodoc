<?php

namespace Anodoc;

class Collection implements \ArrayAccess, \Countable, \Iterator {

  private $store = array();

  function __construct(array $array = array()) {
    $this->store = array_merge($this->store, $array);
  }

  function offsetExists($key) {
    return isset($this->store[$key]);
  }

  function offsetGet($key) {
    return $this->store[$key];
  }

  function offsetSet($key, $value) {
    if (is_null($key)) {
      $this->store[] = $value;
    } else {
      $this->store[$key] = $value;
    }
  }

  function isKeySet($key) {
    return $this->offsetExists($key);
  }

  function offsetUnset($key) {
    unset($this->store[$key]);
  }

  function length() {
    return $this->count();
  }

  function get($key) {
    return $this->offsetGet($key);
  }

  function count() {
    return count($this->store);
  }

  function rewind() {
    reset($this->store);
  }

  function current() {
    return current($this->store);
  }

  function key() {
    return key($this->store);
  }

  function next() {
    next($this->store);
  }

  function valid() {
    return key($this->store) !== null;
  }

}