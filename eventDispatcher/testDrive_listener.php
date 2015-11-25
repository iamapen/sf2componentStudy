<?php
/**
 * リスナをdispatcherに登録するパターンの例
 * 監視するイベントとそれに対するリスナを利用側で対応付ける
 */

namespace com\studiopoppy\sfEventDispatcherStudy;

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('com\studiopoppy\sfEventDispatcherStudy\\', __DIR__.'/lib');

// リスナを登録
$dispatcher = DispatcherHolder::getDispatcher();
$listener = new Listener\MyListener();
$dispatcher->addListener(Event\Events::LOG_WARN, [$listener, 'onLogWarn']);
$dispatcher->addListener(Event\Events::STORE_ORDER, [$listener, 'onStoreOrder']);

$someClass = new SomeClass();
$someClass->simpleMethod();

$someClass->order();