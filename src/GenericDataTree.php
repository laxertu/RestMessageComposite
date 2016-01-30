<?php
namespace MessageComposite;

/**
 * This class is intended for those who wants a 100% composite implementation. It just opens setter methods to clients
 *
 * Class GenericMessage
 * @package MessageComposite
 * @see MessageComposite\tests\GenericMessageTest
 */
class GenericDataTree extends DataTree
{

    public function __construct($name)
    {
        $this->setName($name);
    }

    final public function setChild(MessageInterface $element, $pos)
    {
        return parent::setChild($element, $pos);
    }

    final public function removeChild($pos)
    {
        return parent::removeChild($pos);
    }
}
