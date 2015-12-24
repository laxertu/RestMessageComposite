<?php
namespace MessageComposite;

/**
 * Leaf classes.
 *
 * Class MessageElement
 * @package MessageComposite
 */
class MessageElement extends Message
{

    protected $name, $value;
    protected $isLeaf = true;

    public function __construct($name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getBody()
    {
        return $this;
    }

} 