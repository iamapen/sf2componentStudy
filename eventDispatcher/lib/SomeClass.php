<?php
namespace com\studiopoppy\sfEventDispatcherStudy;
use com\studiopoppy\sfEventDispatcherStudy\Event\Events;
use com\studiopoppy\sfEventDispatcherStudy\Event\OrderEvent;
use com\studiopoppy\sfEventDispatcherStudy\Order;

/**
 * 何らかのクラス
 */
class SomeClass {

    /**
     * イベントに付加情報を与える必要のない、シンプルなイベントが起きるメソッドの例
     */
    public function simpleMethod() {
        $ev = new \Symfony\Component\EventDispatcher\Event();
        DispatcherHolder::getDispatcher()->dispatch(Events::LOG_WARN, $ev);
    }

    /**
     * 付加情報を持つイベントが起きるメソッドの例
     */
    public function order() {
        // 何らかの注文があったとする
        $order = new Order('productA');

        // イベントを作成、dispatch
        $ev = new OrderEvent($order);
        DispatcherHolder::getDispatcher()->dispatch(Events::STORE_ORDER, $ev);
    }
}