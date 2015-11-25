<?php
/**
 * サブスクライバをdispatcherに登録するパターンの例
 * サブスクライバは監視するイベントの種類を自分で知っている
 */

namespace com\studiopoppy\sfEventDispatcherStudy;

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('com\studiopoppy\sfEventDispatcherStudy\\', __DIR__.'/lib');

// サブスクライバを登録
$dispatcher = DispatcherHolder::getDispatcher();
$subscriber = new Subscriber\MySubscriber();
$dispatcher->addSubscriber($subscriber);

$someClass = new SomeClass();
$someClass->simpleMethod();

$someClass->order();