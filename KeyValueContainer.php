<?php

namespace Burgov\Bundle\KeyValueFormBundle;

class KeyValueContainer implements \ArrayAccess, \Countable, \Serializable
{
    private $data;

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        $data = $this->toArray();
        $out = '';
        foreach ($data as $k => $v){
            $out .= $k . '=' . $v . ';';
        }
        return $out;
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        $this->data = [];
        $data = explode(';', $serialized);
        foreach ($data as $v){
            $k = explode('=', $v);

                $this->data[$k[0]] = count($k) === 2 ? $k[1] : '';
        }
    }

    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    public function toArray()
    {
        return $this->data;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function count()
    {
        return count($this->data);
    }
}
 