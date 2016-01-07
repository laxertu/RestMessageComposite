<?php
namespace MessageComposite\Formatter;
use MessageComposite\MessageInterface;

/**
 * Class JsonFormatter
 * @package MessageComposite\Formatter
 * @see MessageComposite\tests\formatters\JsonFormatterTest
 */
class JsonFormatter extends  AbstractFormatter
{

    private function buildHead(MessageInterface $message)
    {
        return '"'.$message->getName().'":';
    }

    public function buildContent(MessageInterface $message)
    {

        $body = $this->buildBody($message);
        $content = $this->buildHead($message).$body;

        # entire message and composites' children are surrounded by {}
        if($message->getChildren() || !$message->getParent()) {
            $content = '{'.$content.'}';
        }
        return $content;
    }

    private function buildBody(MessageInterface $message)
    {

        # a simple value
        if($message->isLeaf()) {
            /** @todo treat numbers */
            $content = '"'.$message->getBody().'"';

        } else {
            $content = [];
            foreach($message->getChildren() as $child) {
                $content[]= $this->buildContent($child);
            }
            $content = implode(',', $content);

        }

        if($message->getChildren()) {
            $content = '{'.$content.'}';
        }

        return $content;
    }
} 