<?php
namespace com\studiopoppy\sfEventDispatcherStudy\Listener;

/**
 * イベントリスナ
 */
class MyListener {
    public function onLogWarn(\Symfony\Component\EventDispatcher\Event $ev) {
        error_log('warn');
    }

    public function onStoreOrder(\com\studiopoppy\sfEventDispatcherStudy\Event\OrderEvent $ev) {
        error_log("注文されました:" . $ev->getOrder()->getName());
    }
}