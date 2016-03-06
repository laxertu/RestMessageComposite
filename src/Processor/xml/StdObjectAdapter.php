<?php
namespace laxertu\DataTree\Processor\xml;


use laxertu\DataTree\Processor\AbstractProcessor;
use laxertu\DataTree\Processor\xml\XMLProcessableInterface;

/**
 * Class StdObjectAdapter
 * @package DataTree\Adapter
 * @see DataTree\tests\adapters\StdObjectAdapterTest
 */
class StdObjectAdapter extends AbstractProcessor
{
    final public function toStdObject(XMLProcessableInterface$xmlTree)
    {

        $result = new \StdClass();
        $msgName = $xmlTree->getName();

        if ($this->isLeaf($xmlTree)) {
            $result = $this->leafToStdObject($xmlTree);
        } else {
            $result = $this->compositeToStdObject($xmlTree);
        }

        return $result;
    }


    private function compositeToStdObject(XMLProcessableInterface $xmlTree)
    {

        $result = new \StdClass();
        $msgName = $xmlTree->getName();

        $result->$msgName = new \StdClass();
        foreach ($xmlTree->getChildren() as $child) {
            $childName = $child->getName();
            if (property_exists($result->$msgName, $childName)) {

                $nodeToMove = $result->$msgName->$childName;
                $resultContent = [];
                $resultContent[]=$nodeToMove;
                $leafContent = $this->toStdObject($child);
                $resultContent[]=$leafContent->$childName;

                $result->$msgName->$childName = $resultContent;

            } else {
                $result->$msgName = $this->mergeObjects($result->$msgName, $this->toStdObject($child));
            }
        }

        return $result;
    }

    private function mergeObjects(\StdClass $o1, \StdClass $o2)
    {
        foreach (get_object_vars($o2) as $name => $value) {
            $o1->$name = $value;
        }

        return $o1;
    }

    private function leafToStdObject(XMLProcessableInterface $xmlTree)
    {
        $result = new \StdClass();
        $msgName = $xmlTree->getName();
        $result->$msgName = $xmlTree->getValue();

        return $result;
    }
}
