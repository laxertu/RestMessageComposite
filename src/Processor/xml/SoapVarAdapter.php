<?php
namespace laxertu\DataTree\Processor\xml;


use laxertu\DataTree\Processor\xml\XMLProcessableInterface;

/**
 * Class SoapVarAdapter
 * @package DataTree\Adapter
 * @see DataTree\tests\adapters\SoapVarAdapterTest
 */
class SoapVarAdapter
{

    final public function toSoapVar(XMLProcessableInterface $message)
    {
        $stdObjectAdapter = new StdObjectAdapter();
        $soapVar = new \SoapVar($stdObjectAdapter->toStdObject($message), SOAP_ENC_OBJECT);

        return $soapVar;
    }

}
