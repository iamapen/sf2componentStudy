<?php
namespace com\studiopoppy\sfEventDispatcherStudy\Event;
use Symfony\Component\EventDispatcher\Event;
use com\studiopoppy\sfEventDispatcherStudy\Order;

/**
 * "注文" イベント
 *
 * 注文情報をフィールドに持つイベント
 */
class OrderEvent extends Event {
    protected $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function getOrder() {
        return $this->order;
    }
}