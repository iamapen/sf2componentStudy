<?php
namespace com\studiopoppy\sfEventDispatcherStudy;

/**
 * 「注文」オブジェクト
 */
class Order {
    protected $name;

    public function __construct($name) {
        $this->name =$name;
    }

    public function getName() {
        return $this->name;
    }
}