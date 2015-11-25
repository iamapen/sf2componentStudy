<?php
namespace com\studiopoppy\sfEventDispatcherStudy\Subscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use com\studiopoppy\sfEventDispatcherStudy\Event\Events;

/**
 * サブスクライバ
 *
 * リスナと比較すると、監視するイベントの種類を自身でdispatcherに通知できる点が異なる。
 */
class MySubscriber implements EventSubscriberInterface {
    static public function getSubscribedEvents() {
        return [
            Events::LOG_WARN     => 'onLogWarn',
            Events::STORE_ORDER => 'onStoreOrder',
        ];
    }

    public function onLogWarn(\Symfony\Component\EventDispatcher\Event $ev) {
        error_log('warn');
    }

    public function onStoreOrder(\com\studiopoppy\sfEventDispatcherStudy\Event\OrderEvent $ev) {
        error_log("注文されました:" . $ev->getOrder()->getName());
    }
}