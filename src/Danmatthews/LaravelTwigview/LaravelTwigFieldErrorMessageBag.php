<?php namespace Danmatthews\LaravelTwigview;

class LaravelTwigFieldErrorMessageBag implements \ArrayAccess, \Iterator {

	/**
	 * Holds the error messages for this field.
	 */
	protected $messages;

	protected $position = 0;

	public function __construct(array $errors)
	{
		$this->messages = $errors;
		$this->position = 0;
	}

	/**
	 * Return the first message from the bag.
	 */
	public function __toString()
	{
		return $this->messages[0];
	}

	/**
	 * ArrayAccess methods.
	 */
	public function offsetSet($offset, $value) {
	    if (is_null($offset)) {
	        $this->messages[] = $value;
	    } else {
	        $this->messages[$offset] = $value;
	    }
	}
	public function offsetExists($offset) {
	    return isset($this->messages[$offset]);
	}
	public function offsetUnset($offset) {
	    unset($this->messages[$offset]);
	}

	public function offsetGet($offset) {
	    return isset($this->messages[$offset]) ? $this->messages[$offset] : null;
	}

	/**
	 * Iterator methods
	 */
	public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->messages[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->messages[$this->position]);
    }

}
