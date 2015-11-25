<?php
namespace com\studiopoppy\sfEventDispatcherStudy;

/**
 * dispatcherをstaticに持つだけのもの
 */
class DispatcherHolder {
    /** @var \Symfony\Component\EventDispatcher\EventDispatcher */
    static private $dispatcher = null;

    /**
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    static public function getDispatcher() {
        if(!isset(self::$dispatcher)) {
            self::$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
        }
        return self::$dispatcher;
    }
}