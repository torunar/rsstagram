<?php

/**
 * Class RsstagramBridge overrides titles provided by the InstagramBridge
 */
class RsstagramBridge extends \InstagramBridge
{
    public function collectData()
    {
        parent::collectData();

        array_walk($this->items, function (&$item) {
            $item['title'] = '@' . $item['author'];
        });
    }
}
